<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\StoreController;
use App\Http\Controllers\Api\ProductController;

Route::middleware('auth:sanctum')->group(function (){
    /** AUTHENTICATION */
    Route::get('/user', [AuthController::class, 'user']);
    Route::resource('users', UserController::class);
    Route::get('/logout', [AuthController::class, 'logout']);
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
});

/** Public route */
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/banners',[BannerController::class,'index']);
Route::get('/stores',[StoreController::class, 'index']);
Route::get('/store/{id}',[StoreController::class, 'show']);
Route::get('/products',[ProductController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);