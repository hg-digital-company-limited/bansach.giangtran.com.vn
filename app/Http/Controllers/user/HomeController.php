<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Subquery để tính AVGRating
        $avgRatings = DB::table('ratings')
            ->select('BookID', DB::raw('IFNULL(AVG(RatingValue), 0) as AVGRating'))
            ->groupBy('BookID');

        // Lấy 10 sách ngẫu nhiên từ bảng book và kết hợp với AVG ratings
        $randomBooks = DB::table('book')
            ->leftJoinSub($avgRatings, 'avgratings', function ($join) {
                $join->on('book.BookID', '=', 'avgratings.BookID');
            })
            ->select('book.*', 'avgratings.AVGRating')
            ->take(10)
            ->inRandomOrder()
            ->get();

        return view("user.index", compact('randomBooks'));
    }



}
