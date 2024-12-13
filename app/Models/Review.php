<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = "review";
    protected $primaryKey = "ReviewID";
    protected $fillable = ['BookID', 'UserID', 'Content', 'Rating'];
}
