<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = "gerne"; // Tên bảng

    protected $primaryKey = "GenreID"; // Nếu cần, thay đổi theo tên cột chính của bạn

    public $timestamps = false; // Nếu bảng không có các cột timestamps

    // Thiết lập quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Thiết lập quan hệ với Book
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_genre', 'genre_id', 'book_id');
    }
}
