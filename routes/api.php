<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ProductReleaseController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\FlashSaleController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CommentController;


Route::middleware('auth:sanctum')->group(function (){
    /** AUTHENTICATION */
    Route::get('/user', [AuthController::class, 'user']);
    Route::resource('users', UserController::class);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/user-update', [AuthController::class, 'update']);
    /** CATEGORY */
    Route::post('/category', [CategoryController::class, 'store']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
    Route::post('/category/{id}',[CategoryController::class , 'update']);

    /** BANNER  */
    Route::post('/banner', [BannerController::class , 'store']);
    Route::delete('/banner/{id}',[BannerController::class, 'destroy']);
    Route::post('/banner/{id}',[BannerController::class, 'update']);

    /** SHOP */
    Route::post('/store', [StoreController::class, 'store']);
    Route::delete('/store/{id}',[StoreController::class, 'destroy']);
    Route::post('/store/{id}',[StoreController::class, 'update']);
    Route::get('/store-check',[StoreController::class, 'checkStore']);

    /** PRODUCT */
    Route::post('/product', [ProductController::class, 'store']);

    /** FAVORITE */
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::get('/favorite/{id}',[FavoriteController::class, 'show']);
    Route::delete('/favorite/{id}',[FavoriteController::class, 'destroy']);
    Route::post('/favorite',[FavoriteController::class, 'store']);

    /** Cart */
    Route::get('/cart',[CartController::class,'index']);
    Route::post('/cart',[CartController::class,'store']);
    Route::delete('/remove-cart/{id}',[CartController::class,'destroy']);

    /** Address */
    Route::get('/address',[AddressController::class,'index']);
    Route::post('/address',[AddressController::class,'store']);

    /** Coupon */
    Route::post('/check-coupon',[CouponController::class,'check_coupon']);

    /** Checkout - Order */
    Route::get('/order',[OrderController::class,'index']);
    Route::post('/order',[OrderController::class,'store']);

    /** Comment */
    Route::post('/comment',[CommentController::class,'store']);

});

/** Public route */
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/banners',[BannerController::class,'index']);
Route::get('/stores',[StoreController::class, 'index']);
Route::get('/store/{id}',[StoreController::class, 'show']);
Route::get('/products',[ProductController::class, 'index']);
Route::get('/product/{id}',[ProductController::class, 'show']);
// Get size and colors of products
Route::get('/release',[ProductReleaseController::class, 'index']);
Route::get('/release/{id}',[ProductReleaseController::class, 'show']); // id product not id product release

// Flash sale
Route::get('/flashsale',[FlashSaleController::class, 'index']);

Route::get('/comments/{id}', [CommentController::class, 'show']);


Route::get('/sub_categories', [SubCategoryController::class, 'index']);


Route::get('/images',[ImageController::class, 'index']);
Route::get('/images/{id}',[ImageController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);