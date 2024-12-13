<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * Class Admin
 *
 * @property $AdminID
 * @property $Email
 * @property $Password
 * @property $FullName
 * @property $PhoneNumber
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Admin extends Model
{
    protected $table = "admin";
    protected $primaryKey = "AdminID";

    public $timestamps = false;

    static $rules = [
        'Email' => 'required|email',
        'FullName' => 'required',
        'PhoneNumber' => 'required'
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Email', 'Password', 'FullName', 'PhoneNumber'];



}
