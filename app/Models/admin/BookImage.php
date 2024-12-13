<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookImage
 *
 * @property int $ImageID
 * @property int $BookID
 * @property string $ImagePath
 * @property string $Description
 *
 * @property Book $book
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BookImage extends Model
{
    protected $table = 'bookimage'; // Đổi tên bảng theo quy tắc của Laravel
    protected $primaryKey = 'ImageID';

    static $rules = [
        'ImagePath' => 'required|string',
        'BookID' => 'required|integer',
    ];

    protected $fillable = ['ImagePath', 'Description', 'BookID'];

    public $timestamps = false;

    /**
     * Mối quan hệ với mô hình Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book()
    {
        return $this->belongsTo('App\Models\admin\Book', 'BookID', 'BookID'); // Thay đổi thành belongsTo
    }
}
