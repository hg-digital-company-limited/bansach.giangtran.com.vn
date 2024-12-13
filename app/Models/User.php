<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait; // Kết hợp sử dụng traits

    protected $table = "user"; // Tên bảng trong cơ sở dữ liệu

    protected $primaryKey = 'UserID'; // Khóa chính của bảng

    // Các trường có thể được gán giá trị
    protected $fillable = [
        'UserName',
        'Password', // Đảm bảo mật khẩu được mã hóa trước khi lưu
        'email',
        'FirstName',
        'LastName',
        'Gender',
        'PhoneNumber',
        'DateOfBirth',
        'ModifiedDate',
    ];

    public $timestamps = false; // Không sử dụng timestamps tự động (created_at, updated_at)

    protected static function boot()
    {
        parent::boot();

        // Cập nhật ModifiedDate khi bản ghi được cập nhật
        static::updating(function ($user) {
            $user->ModifiedDate = Carbon::now('Asia/Bangkok');
        });
    }

    // Phương thức để mã hóa mật khẩu trước khi lưu
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password); // Sử dụng bcrypt để mã hóa mật khẩu
    }

    // Phương thức để xác thực người dùng
    public function validatePassword($password)
    {
        return password_verify($password, $this->attributes['password']);
    }
    public function getAuthPassword()
{
    return $this->Password; // Trả về cột 'Password' thay vì 'password'
}

}
