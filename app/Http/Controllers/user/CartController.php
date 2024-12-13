<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Hiển thị trang giỏ hàng
    function cartPage() {
        return view("user.cart-page");
    }

    // Thêm sản phẩm vào giỏ hàng
    function addCart(Request $request) {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Auth::check()) {
            $userID = Auth::id();
            $cart = ShoppingCart::firstOrNew(['UserID' => $userID]);
            $cartID = $cart->CartID;
        } else {
            $cartID = session()->get('cartID');
            $cart = ShoppingCart::find($cartID);
            if (!$cart) {
                // Tạo giỏ hàng mới cho người dùng chưa đăng nhập
                $cart = new ShoppingCart();
                $cart->save();
                session(['cartID' => $cart->CartID]);
            }
        }

        // Lấy thông tin sản phẩm từ request
        $bookID = $request->input('book_id');
        $bookQnt = $request->input('book_quantity', 1); // Số lượng mặc định là 1 nếu không có thông tin

        // Tìm sản phẩm trong giỏ hàng
        $cartItem = ShoppingCartDetail::where('CartID', $cartID)
            ->where('BookID', $bookID)
            ->first();

        if ($cartItem) {
            // Cập nhật số lượng nếu sản phẩm đã có trong giỏ
            $cartItem->Quantity += $bookQnt; // Cập nhật số lượng
            $cartItem->save();
        } else {
            // Thêm sản phẩm mới vào giỏ
            $cartItem = new ShoppingCartDetail([
                'CartID' => $cartID,
                'BookID' => $bookID,
                'Quantity' => $bookQnt,
            ]);
            $cartItem->save();
        }

        // Tính toán tổng số lượng và tổng giá trị giỏ hàng
        $cartItems = ShoppingCartDetail::with('book')->where('CartID', $cartID)->get();
        $totalPrice = 0;
        $totalBook = $cartItems->unique('BookID')->count();

        foreach ($cartItems as $item) {
            $totalPrice += $item->Quantity * $item->book?->CostPrice;
        }

        // Trả về thông tin tổng số lượng và tổng giá trị
        return response()->json([
            'message' => 'Item added to the cart',
            'totalBookCount' => $totalBook,
            'totalPrice' => $totalPrice,
        ]);
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart(Request $request) {
        if (Auth::check()) {
            $userID = Auth::id();
            $cart = ShoppingCart::firstOrNew(['UserID' => $userID]);
        } else {
            $cartID = session()->get('cartID');
            $cart = ShoppingCart::find($cartID);
            if (!$cart) {
                // Tạo giỏ hàng mới cho người dùng chưa đăng nhập
                $cart = new ShoppingCart();
                $cart->save();
                session(['cartID' => $cart->CartID]);
            }
        }

        if (!$cart->CartID) {
            $cart->save();
        }

        $cartID = $cart->CartID;
        $bookID = $request->input('book_id');

        // Xóa sản phẩm khỏi giỏ hàng
        ShoppingCartDetail::where('CartID', $cartID)
            ->where('BookID', $bookID)
            ->delete();

        // Cập nhật tổng số lượng và tổng giá trị
        $cartItems = ShoppingCartDetail::with('book')->where('CartID', $cartID)->get();
        $totalPrice = 0;
        $totalBook = $cartItems->unique('BookID')->count();

        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->Quantity * $cartItem->book?->CostPrice;
        }

        return response()->json([
            'message' => 'Item removed from the cart',
            'totalBookCount' => $totalBook,
            'totalPrice' => $totalPrice,
        ]);
    }

    // Cập nhật giỏ hàng
    public function updateCart(Request $request) {
        $request->validate([
            'cart-qty.*' => 'required|numeric',
        ]);

        $cartQuantities = $request->input('cart-qty');

        foreach ($cartQuantities as $cartItemID => $quantity) {
            $cartDetail = ShoppingCartDetail::find($cartItemID);
            if ($cartDetail) {
                $cartDetail->update(['Quantity' => $quantity]);
            }
        }

        // Cập nhật tổng số lượng và tổng giá trị sau khi cập nhật
        $cartID = $request->input('cart_id');
        $cartItems = ShoppingCartDetail::with('book')->where('CartID', $cartID)->get();
        $totalPrice = 0;
        $totalBook = $cartItems->unique('BookID')->count();

        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->Quantity * $cartItem->book?->CostPrice;
        }
    
        // Redirect back with a success message and the updated cart information
        return redirect()->back()->with([
            'message' => 'Cart updated successfully',
            'totalBookCount' => $totalBook,
            'totalPrice' => $totalPrice,
        ]);
    }

}
