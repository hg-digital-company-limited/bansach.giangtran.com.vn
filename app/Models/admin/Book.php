<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Book
 *
 * @property int $BookID
 * @property string $BookTitle
 * @property string $Author
 * @property int $PublisherID
 * @property float $CostPrice
 * @property float $SellingPrice
 * @property int $QuantityInStock
 * @property int $PageCount
 * @property float $Weight
 * @property string $Avatar
 * @property string $CoverStyle
 * @property string $Size
 * @property int $YearPublished
 * @property string $Description
 * @property int $SetID
 * @property int $ViewCount
 * @property \Carbon\Carbon $CreatedDate
 * @property string $CreatedBy
 * @property \Carbon\Carbon $ModifiedDate
 * @property string $ModifiedBy
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book'; // Đảm bảo bảng đúng
    protected $primaryKey = 'BookID';

    const CREATED_AT = 'CreatedDate';
    const UPDATED_AT = 'ModifiedDate';

    const WEIGHT_MULTIPLIER = 1000;

    static $rules = [
        'BookTitle' => 'required',
        'Author' => 'required',
        'PublisherID' => 'required',
        'CostPrice' => 'required|numeric',
        'SellingPrice' => 'required|numeric',
        'PageCount' => 'required|integer',
        'Weight' => 'required|numeric',
        'CoverStyle' => 'required',
        'YearPublished' => 'required|integer'
    ];

    protected $fillable = [
        'BookTitle', 'Author', 'PublisherID', 'CostPrice',
        'SellingPrice', 'PageCount', 'Weight', 'Avatar',
        'CoverStyle', 'Size', 'YearPublished', 'Description',
        'SetID', 'CreatedBy', 'ModifiedBy'
    ];

    protected $casts = [
        'CostPrice' => 'float',
        'SellingPrice' => 'float',
        'Weight' => 'float',
        'PageCount' => 'integer',
    ];

    // Mối quan hệ với thể loại
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'bookgenre', 'BookID', 'GenreID');
    }

    // Mối quan hệ với hình ảnh sách
    public function bookimages()
    {
        return $this->hasMany(BookImage::class, 'BookID', 'BookID');
    }

    // Các accessors và mutators cho giá và trọng lượng
    public function getCostPriceAttribute($value)
    {
        return $value * self::WEIGHT_MULTIPLIER;
    }

    public function setCostPriceAttribute($value)
    {
        $this->attributes['CostPrice'] = $value / self::WEIGHT_MULTIPLIER;
    }

    public function getSellingPriceAttribute($value)
    {
        return $value * self::WEIGHT_MULTIPLIER;
    }

    public function setSellingPriceAttribute($value)
    {
        $this->attributes['SellingPrice'] = $value / self::WEIGHT_MULTIPLIER;
    }

    public function getWeightAttribute($value)
    {
        return $value * self::WEIGHT_MULTIPLIER;
    }

    public function setWeightAttribute($value)
    {
        $this->attributes['Weight'] = $value / self::WEIGHT_MULTIPLIER;
    }
}


