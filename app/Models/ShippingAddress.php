<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $table = 'shippingaddress'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = [
        'UserID',
        'FullName',
        'City',
        'District',
        'Ward',
        'Address',
        'PhoneNumber',
        'IsDefault',
    ];

    // Nếu bạn muốn giá trị mặc định cho một số cột, có thể dùng $attributes
    protected $attributes = [
        'IsDefault' => false, // Giả sử IsDefault là false khi không chọn
    ];
}
