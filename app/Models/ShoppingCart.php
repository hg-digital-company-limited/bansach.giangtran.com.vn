<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = "ShoppingCart"; // Tên bảng

    protected $primaryKey = 'CartID'; // Khóa chính

    public $timestamps = false; // Không sử dụng timestamps

    protected $fillable = [
        'UserID' // Đảm bảo thuộc tính này khớp với tên cột trong bảng
    ];

    // Thêm quan hệ với người dùng nếu cần
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
}
