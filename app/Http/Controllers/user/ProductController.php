<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Hiển thị chi tiết sản phẩm
    public function ProductDetail(Request $request, $id)
    {
        $book = Book::where('BookID', $id)->first();
        if (!$book) {
            return abort(404); // Nếu không tìm thấy sách, trả về lỗi 404
        }

        // Tăng số lượt xem
        $book->increment('ViewCount');

        // Lấy đánh giá sách
        $reviews = DB::table('review')
            ->join('user', 'user.UserID', '=', 'review.UserID')
            ->where('BookID', $id)
            ->select('review.*', 'user.FirstName', 'user.LastName')
            ->get();

        $totalRv = $reviews->count();
        $author = $book->Author;

        // Lấy sách cùng tác giả
        $sameAuthor = Book::where('Author', $author)
            ->where('BookID', '!=', $id)
            ->inRandomOrder()
            ->take(5) // Giới hạn số lượng sách cùng tác giả
            ->get();

        // Lấy thể loại của sách
        $listGenre = DB::table('bookgenre')
            ->join('genre', 'bookgenre.GenreID', '=', 'genre.GenreID')
            ->where('bookgenre.BookID', $id)
            ->select('genre.*')
            ->get();

        // Tính điểm đánh giá trung bình
        $avgRating = DB::table('review')->where('BookID', $id)->avg('Rating') ?? 0;
        $rounderIntRating = intval(round($avgRating));

        // Kiểm tra xem người dùng đã mua sách chưa
        $isPurchased = DB::table('salesorderdetail')
            ->join('salesorder', 'salesorderdetail.OrderID', '=', 'salesorder.OrderID')
            ->where('salesorder.UserID', Auth::id())
            ->where('salesorderdetail.BookID', $id)
            ->where('salesorder.OrderStatus', 'COMPLETED')
            ->exists();

        // Lấy sách khác cùng thể loại
        $bookAlter = Book::where('GenreID', $book->GenreID)
            ->where('BookID', '!=', $id) // Lấy sách khác cùng thể loại
            ->inRandomOrder()
            ->first(); // Lấy một sách ngẫu nhiên
        $isLogin = Auth::check();
        // Trả về view với tất cả biến cần thiết
        return view("user.product-detail", compact("book", "bookAlter", "reviews", "totalRv", "sameAuthor", "listGenre", "isPurchased", "rounderIntRating", "isLogin"));
    }

    // Lấy tất cả sản phẩm theo điều kiện
    public function getAllProduct($condition)
    {
        $perPage = 12;
        $query = Book::query();

        switch ($condition) {
            case 'newest':
                $query->orderBy("BookID", "desc");
                break;
            case 'most-viewed':
                $query->orderBy("ViewCount", "desc");
                break;
            case 'best-selling':
                $query->join('getListbooksolddesc', 'getListbooksolddesc.BookID', '=', 'book.BookID') // Sửa đổi tên bảng
                ->orderBy('getListbooksolddesc.TotalSold', "desc");
                break;
        }

        $products = $query->paginate($perPage);
        return response()->json(['products' => $products]);
    }

    // Lấy sản phẩm theo ID
    public function getProductByID($productID)
    {
        $product = Book::with('avgratingbook')->find($productID);
        return response()->json(["product" => $product]);
    }

    // Lấy sản phẩm theo thể loại
    public function productsByCategory(Request $request, $genreID)
    {
        $products = DB::table("book")
            ->where("GenreID", $genreID)
            ->orderBy("book.BookID", "asc")
            ->paginate(9);
        $formattedCategories = Category::all();
        return view('user.product-category', compact('products', 'formattedCategories'));
    }

    // Tìm kiếm sản phẩm theo từ khóa
    public function searchProduct(Request $request)
    {
        $textSearch = $request->input('keyWord');

        $products = DB::table("book") // Đổi tên bảng ở đây
        ->leftJoin('avgratingbook', 'book.BookID', '=', 'avgratingbook.BookID')
        ->join('publisher', "book.PublisherID", "=", "publisher.PublisherID") // Đảm bảo dùng đúng tên bảng
            ->where('BookTitle', 'like', '%' . $textSearch . '%')
            ->orWhere('Author', 'like', '%' . $textSearch . '%')
            ->orWhere('PublisherName', 'like', '%' . $textSearch . '%')
            ->orderBy('book.BookTitle', 'asc')
            ->take(10)
            ->get();
        return view('user.product-category', compact('products', 'textSearch'));
    }

    // Tìm kiếm theo bộ lọc
    public function searchByFilter(Request $request)
    {
        $dataRequest = $request->json()->all();
        $data = json_decode(json_encode($dataRequest));
        $textSearch = $data->textSearch ?? '';
        $perPage = $data->perPage ?? 12;
        $conditions = [];

        foreach ($data->checkboxes as $checkbox) {
            $id = $checkbox->id;
            $name = $checkbox->name;

            if (strpos($name, 'group-1') !== false) {
                // Xử lý checkbox thuộc group giá cả
                if ($id === 'price-1') {
                    $conditions[] = ['SellingPrice', '<=', 150000];
                } elseif ($id === 'price-2') {
                    $conditions[] = ['SellingPrice', '>', 150000, 'SellingPrice', '<=', 500000];
                } elseif ($id === 'price-3') {
                    $conditions[] = ['SellingPrice', '>', 500000, 'SellingPrice', '<=', 1000000];
                } elseif ($id === 'price-4') {
                    $conditions[] = ['SellingPrice', '>', 1000000];
                }
            } elseif (strpos($name, 'group-2') !== false) {
                // Xử lý checkbox thuộc group tác giả
                $conditions[] = ['Author', '=', $id];
            } elseif (strpos($name, 'group-3') !== false) {
                // Xử lý checkbox thuộc group nhà xuất bản
                $conditions[] = ['book.PublisherID', '=', $id]; // Đổi tên bảng ở đây
            }
        }

        $query = Book::query()->join('avgratingbook', 'book.BookID', '=', 'avgratingbook.BookID'); // Đổi tên bảng ở đây

        foreach ($conditions as $condition) {
            $query->where($condition[0], $condition[1], $condition[2]);
        }

        if ($textSearch) {
            $query->where(function($q) use ($textSearch) {
                $q->where('BookTitle', 'like', '%' . $textSearch . '%')
                    ->orWhere('Author', 'like', '%' . $textSearch . '%')
                    ->orWhere('PublisherName', 'like', '%' . $textSearch . '%');
            });
        }

        $products = $query->paginate($perPage);
        return response()->json(['products' => $products]);
    }
    public function reviewProduct(Request $request)
{
    try {
    $request->validate([
        'bookID' => 'required|integer|exists:book,BookID',
        'review' => 'required|string|max:1000',
        'Rating' => 'required|integer|between:1,5',
        'userID' => 'required|integer',
    ]);

        $review = new Review();
        $review->BookID = $request->bookID;
        $review->UserID = $request->userID;
        $review->Content = $request->review;
        $review->Rating = $request->Rating;
        $review->save();

        $user = User::find($request->userID);
        return response()->json([
            'message' => 'Review created successfully!',
            'review' => $review,
            'FirstName' => $user->FirstName, // Lấy thông tin từ người dùng
            'LastName' => $user->LastName,  // Lấy thông tin từ người dùng
            'Content' => $review->Content,
            'Rating' => $request->Rating,
            'created_at' => $request->created_at,
        ], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Something went wrong!', 'details' => $e->getMessage()], 500);
    }
}
public function deleteReview($reviewID, Request $request)
{
    try {
        // Tìm kiếm review theo reviewID
        $review = Review::findOrFail($reviewID);

        // Kiểm tra quyền của người dùng (optional)
        if ($review->UserID != $request->userID) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Xóa review
        $review->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Review deleted successfully'
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Review not found', 'details' => $e->getMessage()], 404);
    }
}

}
