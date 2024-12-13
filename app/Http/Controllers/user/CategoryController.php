<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\Category;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function ProductCategory(){
    //     $products = DB::table('Book')
    //         ->join('avgRatingBook', 'Book.BookID', '=', 'avgRatingBook.BookID')->paginate(9);
    //     return view("user.product-category", compact('products'));
    // }
    public function ListCategory(string $id){
        $formattedCategories = Category::findOrFail($id);
        // $formattedCategories = Category::all();
        return dd($formattedCategories);
        // return view("user.product-category", compact('formattedCategories'));
    }


    public function ProductCategory() {
        $products = Book::paginate(9);
        return view("user.product-category", compact('products'));
    }
}
