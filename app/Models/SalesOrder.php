<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $table = "salesorder";

    protected $primaryKey = 'OrderID';

    public $timestamps = false;

    public function salesOrderDetails()
    {
        return $this->hasMany(SalesOrderDetail::class, 'OrderID');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    protected $fillable = [
        'OrderDate',
        'UserID',
        'OrderStatus',
        'ShippingAddressID',
        'ShippingFee',
        'OrderNote',
        'Discount',
        'TotalPrice',
    ];
}
