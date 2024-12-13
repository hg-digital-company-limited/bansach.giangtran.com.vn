<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Book;
use App\Models\admin\BookGenre;
use App\Models\admin\BookSet;
use App\Models\admin\Genre;
use App\Models\admin\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Hiển thị danh sách sách.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::query();

        // Tìm kiếm sách theo tiêu đề
        if ($request->has('search')) {
            $searchText = $request->input('search');
            $books->where('BookTitle', 'LIKE', "%$searchText%");
        }

        // Sắp xếp theo ngày tạo (mặc định giảm dần)
        $orderBy = $request->input('order', 'desc') === 'asc' ? 'asc' : 'desc';
        $books = $books->orderBy('CreatedDate', $orderBy)->paginate(10)->appends(['order' => $orderBy]);

        return view('admin.book.index', compact('books'))
            ->with('i', ($books->currentPage() - 1) * $books->perPage());
    }

    /**
     * Hiển thị form tạo mới sách.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = new Book();
        $genres = Genre::all(); // Lấy tất cả thể loại
        $publishers = Publisher::all(); // Lấy tất cả nhà xuất bản
        $bookSets = BookSet::all(); // Lấy tất cả bộ sách
        $selectedGenres = []; // Thể loại đã chọn
        $images = []; // Danh sách hình ảnh

        return view('admin.book.create', compact('book', 'publishers', 'genres', 'bookSets', 'selectedGenres', 'images'));
    }

    /**
     * Lưu trữ sách mới vào cơ sở dữ liệu.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate(Book::$rules);

        $input = $request->all();

        // Xử lý lưu tệp tải lên
        $input['Avatar'] = $this->handleImageUpload($request);

        // Ghi thông tin người sửa
        $input['ModifiedBy'] = auth()->check() ? auth()->user()->UserID : null;

        // Tạo mới sách
        $book = Book::create($input);

        // Cập nhật thể loại
        $selectedGenres = $request->input('bookgenre', []);
        $book->genres()->sync($selectedGenres);

        // Xử lý hình ảnh sách
        $this->handleBookImages($request, $book);

        return redirect()->route('book.show', $book->BookID)
            ->with('success', 'Thêm sách thành công!');
    }

    /**
     * Hiển thị chi tiết sách.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $genres = $book->genres;
        $images = $book->bookimages;

        return view('admin.book.show', compact('book', 'genres', 'images'));
    }

    /**
     * Hiển thị form chỉnh sửa sách.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $genres = Genre::all();
        $publishers = Publisher::all();
        $bookSets = BookSet::all();
        $selectedGenres = $book->genres->pluck('GenreID')->toArray();
        $images = $book->bookimages;

        return view('admin.book.edit', compact('book', 'publishers', 'genres', 'bookSets', 'selectedGenres', 'images'));
    }

    /**
     * Cập nhật thông tin sách.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\admin\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // Xác thực dữ liệu
        $request->validate(Book::$rules);

        $input = $request->all();
        $input['Avatar'] = $this->handleImageUpload($request);

        // Thêm thông tin người sửa
        $input['ModifiedBy'] = auth()->check() ? auth()->user()->UserID : null;

        // Cập nhật sách
        $book->update($input);

        // Cập nhật thể loại
        $selectedGenres = $request->input('bookgenre', []);
        $book->genres()->sync($selectedGenres);

        // Xử lý hình ảnh sách
        $this->handleBookImages($request, $book);

        return redirect()->route('book.show', $book->BookID)
            ->with('success', 'Cập nhật thông tin sách thành công!');
    }

    /**
     * Xoá sách khỏi cơ sở dữ liệu.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $title = $book->BookTitle;
        $book->delete();

        return redirect()->route('book.index')
            ->with('success', "Xoá thành công cuốn sách $title với mã sách là $id");
    }

    /**
     * API tìm kiếm sách.
     *
     * @param string $searchText
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchBook($searchText)
    {
        $books = Book::where('BookTitle', 'LIKE', "%$searchText%")->get();
        return response()->json($books);
    }

    /**
     * API lấy sách theo ID.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    /**
     * API lấy tất cả sách.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Xử lý hình ảnh của sách.
     *
     * @param Request $request
     * @param Book $book
     */
    protected function handleBookImages(Request $request, Book $book)
    {
        $newBookImages = [];
        $randomNumber = time();

        // Thêm hình ảnh từ URL
        $newImagesUrl = $request->input('images-url', []);
        foreach ($newImagesUrl as $imageUrl) {
            if (!empty($imageUrl)) {
                $newBookImages[] = [
                    'ImagePath' => $imageUrl,
                    'Description' => "$book->BookTitle-$randomNumber"
                ];
            }
        }

        // Thêm hình ảnh từ tải lên tệp
        if ($request->hasFile('images-file')) {
            foreach ($request->file('images-file') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/book'), $imageName);
                $newBookImages[] = [
                    'ImagePath' => '/images/book/' . $imageName,
                    'Description' => "$book->BookTitle-$randomNumber"
                ];
            }
        }

        // Lưu hình ảnh vào CSDL
        if (!empty($newBookImages)) {
            DB::table('book_images')->insert($newBookImages);
        }
    }

    /**
     * Xử lý hình ảnh đại diện.
     *
     * @param Request $request
     * @return string
     */
    protected function handleImageUpload(Request $request)
    {
        if ($request->hasFile('Avatar')) {
            $image = $request->file('Avatar');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/book'), $imageName);
            return '/images/book/' . $imageName;
        }

        return '/images/book/default.png'; // Hình ảnh mặc định nếu không có hình tải lên
    }
}
