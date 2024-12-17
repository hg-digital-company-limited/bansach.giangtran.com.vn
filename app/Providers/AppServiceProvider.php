<?php
namespace App\Providers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Truyền dữ liệu cho header ở tất cả trang
        view()->composer('user.layout.header', function ($view) {
            $categories = DB::table('category')
                ->select('CategoryID', 'CategoryName')
                ->take(5)
                ->get();

            $formattedCategories = [];

            foreach ($categories as $category) {
                $categoryId = $category->CategoryID;
                $categoryName = $category->CategoryName;

                $genres = DB::table('genre')
                    ->where('CategoryID', $categoryId)
                    ->select('GenreID', 'GenreName')
                    ->take(5)
                    ->get();

                $formattedCategories[] = [
                    'id' => $categoryId,
                    'name' => $categoryName,
                    'genres' => $genres,
                ];
            }
            $view->with('formattedCategories', $formattedCategories);
        });

        view()->composer('user.product-category', function ($view) {
            $categories = DB::table('category')
                ->select('CategoryID', 'CategoryName')
                ->take(5)
                ->get();

            $formattedCategories = [];

            foreach ($categories as $category) {
                $categoryId = $category->CategoryID;
                $categoryName = $category->CategoryName;

                $genres = DB::table('genre')
                    ->where('CategoryID', $categoryId)
                    ->select('GenreID', 'GenreName')
                    ->take(5)
                    ->get();

                $formattedCategories[] = [
                    'id' => $categoryId,
                    'name' => $categoryName,
                    'genres' => $genres,
                ];
            }
            $view->with('formattedCategories', $formattedCategories);
        });

        view()->composer('user.product-category', function ($view) {
            $authors = DB::table('book')
                ->select('Author')
                ->distinct()
                ->take(5)
                ->get();
            $view->with('authors', $authors);
        });

        view()->composer('user.product-category', function ($view) {
            $publishers = DB::table('book')
                ->join('publisher', 'book.PublisherID', '=', 'publisher.PublisherID')
                ->select('publisher.PublisherID', 'PublisherName')
                ->distinct()
                ->take(5)
                ->get();

            $view->with('publishers', $publishers);
        });

        view()->composer('user.layout.header', function ($view) {
            if (Auth::check()) {
                $userID = Auth::id();
                $cart = ShoppingCart::firstOrNew(['UserID' => $userID]); // Sửa đổi ở đây
                if (!$cart->CartID) {
                    $cart->save();
                }
                $cartID = $cart->CartID;
            } else {
                $cartID = session()->get('cart_id');
                if (!$cartID) {
                    $cart = new ShoppingCart();
                    $cart->save();
                    session(['cart_id' => $cart->CartID]); // Sửa đổi ở đây
                    $cartID = $cart->CartID; // Sửa đổi ở đây
                }
            }

            $cartItems = ShoppingCartDetail::with('book')->where('CartID', $cartID)->get(); // Sửa đổi ở đây
            $totalPrice = 0;
            $totalBook = $cartItems->unique('book_id')->count();
            foreach ($cartItems as $cartItem) {
                $totalPrice += $cartItem->Quantity * $cartItem->book?->cost_price; // Sửa đổi ở đây
            }

            $view->with('cartItems', $cartItems);
            $view->with('totalPrice', $totalPrice + 5);
            $view->with('totalBook', $totalBook);
        });

        view()->composer('user.cart-page', function ($view) {
            if (Auth::check()) {
                $userID = Auth::id();
                $cart = ShoppingCart::firstOrNew(['UserID' => $userID]); // Sửa đổi ở đây
                if (!$cart->CartID) {
                    $cart->save();
                }
                $cartID = $cart->CartID; // Sửa đổi ở đây
            } else {
                $cartID = session()->get('cart_id');
                if (!$cartID) {
                    $cart = new ShoppingCart();
                    $cart->save();
                    session(['cart_id' => $cart->CartID]); // Sửa đổi ở đây
                    $cartID = $cart->CartID; // Sửa đổi ở đây
                }
            }
            $cartItems = ShoppingCartDetail::with('book')->where('CartID', $cartID)->get(); // Sửa đổi ở đây

            $totalPrice = 0;
            foreach ($cartItems as $cartItem) {
                $totalPrice += $cartItem->Quantity * $cartItem->book?->cost_price; // Sửa đổi ở đây
            }
            $view->with('cartItems', $cartItems);
            $view->with('bookPrice', $totalPrice);
            $view->with('shipPrice', 5);
            $view->with('totalPrice', $totalPrice + 5);
        });

        view()->composer('user.checkout-page', function ($view) {
            $userID = Auth::id();
            if ($userID) {
                $cart = ShoppingCart::firstOrNew(['UserID' => $userID]); // Sửa đổi ở đây
                if (!$cart->CartID) {
                    $cart->save();
                }
                $cartID = $cart->CartID; // Sửa đổi ở đây
                $cartItems = ShoppingCartDetail::with('book')->where('CartID', $cartID)->get(); // Sửa đổi ở đây

                $totalPrice = 0;
                foreach ($cartItems as $cartItem) {
                    $totalPrice += $cartItem->Quantity * $cartItem->book?->cost_price; // Sửa đổi ở đây
                }
                $view->with('cartItems', $cartItems);
                $view->with('bookPrice', $totalPrice);
                $view->with('shipPrice', 5);
                $view->with('totalPrice', $totalPrice + 5);
            }
        });
    }
}
