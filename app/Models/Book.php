<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = "book"; // Tên bảng nên là số nhiều và chữ thường

    protected $primaryKey = "BookID";

    public $timestamps = false;

    // Các thuộc tính có thể được gán
    protected $fillable = [
        'SetID',
        'BookTitle',
        'Author',
        'Description',
        'CreatedDate',
        'ModifiedDate',
        'PublisherID',
        'CategoryID',
        'GenreID',
        'CostPrice',
        'SellingPrice',
        'PageCount',
        'Weight',
        'CoverStyle',
        'Size',
        'YearPublished',
        'CreatedBy',
        'Avatar',
        'ImagePath',
        'ViewCount',
        'ModifiedBy',
    ];

    // Thiết lập quan hệ với Publisher
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'PublisherID', 'PublisherID');
    }

    // Thiết lập quan hệ với Genre (đổi tên phương thức từ genres thành genre)
    public function genre()
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id');
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
