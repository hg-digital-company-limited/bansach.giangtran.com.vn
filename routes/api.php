<?php

use App\Http\Controllers\user\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route người dùng
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route sản phẩm
Route::get('/category/{genreID}', [\App\Http\Controllers\user\ProductController::class, 'getProductsByCategory']);
Route::get('/product/{productID}', [\App\Http\Controllers\user\ProductController::class, 'getProductByID']);
Route::get('/product/search', [\App\Http\Controllers\user\ProductController::class, 'searchProduct']);
Route::post('/product/searchByFilter', [\App\Http\Controllers\user\ProductController::class, 'searchByFilter']);
Route::post('/review', [\App\Http\Controllers\user\ProductController::class, 'reviewProduct'])->name('review.store');
Route::delete('/delete-review/{reviewID}', [\App\Http\Controllers\user\ProductController::class, 'deleteReview']);
Route::get('/product/all/{condition}', [\App\Http\Controllers\user\ProductController::class, 'getAllProduct']);

// Route giỏ hàng
Route::POST('/cart/coupon', [\App\Http\Controllers\user\CouponController::class, 'applyCoupon']);

// Route quản trị viên
Route::get('/user/all', [\App\Http\Controllers\admin\UserController::class, 'getAll']);
Route::get('/admin/all', [\App\Http\Controllers\admin\AdminController::class, 'getAll']);
Route::get('/book/all', [\App\Http\Controllers\admin\BookController::class, 'getAll']);
Route::get('/bookset/all', [\App\Http\Controllers\admin\BooksetController::class, 'getAll']);
Route::get('/publisher/all', [\App\Http\Controllers\admin\PublisherController::class, 'getAll']);
Route::get('/supplier/all', [\App\Http\Controllers\admin\SupplierController::class, 'getAll']);
Route::get('/coupon/all', [\App\Http\Controllers\admin\CouponController::class, 'getAll']);
Route::get('/categoryy/all', [\App\Http\Controllers\admin\CategoryController::class, 'getAll']);
Route::get('/genre/all', [\App\Http\Controllers\admin\GenreController::class, 'getAll']);
Route::get('/sales-order/all', [\App\Http\Controllers\admin\SalesOrderController::class, 'getAll']);
Route::get('/purchase-order/all', [\App\Http\Controllers\admin\PurchaseOrderController::class, 'getAll']);
Route::get('/book/search/{searchText}', [\App\Http\Controllers\admin\BookController::class, 'searchBook']);
Route::get('/book/{id}', [\App\Http\Controllers\admin\BookController::class, 'getById']);

// Route quản lý địa chỉ
Route::post('/account/addressnew', [AccountController::class, 'AddNewAddress']);
Route::get('/account/address/{addressID}', [AccountController::class, 'getAddressByID']);
Route::post('/account/update-address', [AccountController::class, 'updateAddress']);
