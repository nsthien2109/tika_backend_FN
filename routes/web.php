<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SubCategoryController;

use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\ProductReleaseController;
use App\Http\Controllers\Seller\CouponStoreController;

Route::get('/login-page', [AuthController::class,'index']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);


/** ADMIN PANEL */
Route::group([
    'prefix' => 'admin',
    'middleware' => 'adminLoginCheck'
],function () {
    Route::get('/', function () {
        return view('pages.home.home');
    });
        /** User */
    Route::get('users', [UserController::class, 'index']);
    Route::get('add-user-page',[UserController::class, 'create']);
    Route::post('add-user',[UserController::class, 'store']);
    Route::get('delete-user/{id}',[UserController::class, 'destroy']);
    Route::get('profile-page-{id}',[UserController::class, 'show']);
    Route::post('update-user',[UserController::class, 'update']);

    /** Category  */
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('add-category-page',[CategoryController::class, 'create']);
    Route::post('add-category',[CategoryController::class, 'store']);
    Route::get('delete-category/{id}',[CategoryController::class, 'destroy']);
    Route::get('edit-category-page-{id}',[CategoryController::class, 'show']);
    Route::post('update-category',[CategoryController::class, 'update']);


    /** Sub Category  */
    Route::get('sub_categories', [SubCategoryController::class, 'index']);
    Route::get('add-sub-category-page',[SubCategoryController::class, 'create']);
    Route::post('add-sub_category',[SubCategoryController::class, 'store']);
    Route::get('delete-sub-category/{id}',[SubCategoryController::class, 'destroy']);
    Route::get('edit-sub-category-page-{id}',[SubCategoryController::class, 'show']);
    Route::post('update-sub-category',[SubCategoryController::class, 'update']);
    Route::get('change-status-sub-{id}',[SubCategoryController::class, 'changeStatus']);

    /** Banner  */
    Route::get('banners', [BannerController::class, 'index']);
    Route::get('add-banner-page',[BannerController::class, 'create']);
    Route::post('add-banner',[BannerController::class, 'store']);
    Route::get('edit-banner-page-{id}',[BannerController::class, 'show']);
    Route::post('update-banner',[BannerController::class, 'update']);
    Route::get('delete-banner/{id}',[BannerController::class, 'destroy']);

    /** Brand  */
    Route::get('brands', [BrandController::class, 'index']);
    Route::get('add-brand-page',[BrandController::class, 'create']);
    Route::post('add-brand',[BrandController::class, 'store']);
    Route::get('edit-brand-page-{id}',[BrandController::class, 'show']);
    Route::post('update-brand',[BrandController::class, 'update']);
    Route::get('delete-brand/{id}',[BrandController::class, 'destroy']);
    Route::get('change-status-brand-{id}',[BrandController::class, 'changeStatus']);

    /** Store  */
    Route::get('stores', [StoreController::class, 'index']);
    Route::get('add-store-page',[StoreController::class, 'create']);
    Route::post('add-store',[StoreController::class, 'store']);
    Route::get('edit-store-page-{id}',[StoreController::class, 'show']);
    Route::post('update-store',[StoreController::class, 'update']);
    Route::get('delete-store/{id}',[StoreController::class, 'destroy']);
    Route::get('change-status-store-{id}',[StoreController::class, 'changeStatus']);

    /** Unit  */
    Route::get('units', [UnitController::class, 'index']);
    Route::post('add-size',[UnitController::class, 'store_size']);
    Route::post('add-color',[UnitController::class, 'store_color']);
    Route::get('delete-size/{id}',[UnitController::class, 'destroy_size']);
    Route::get('delete-color/{id}',[UnitController::class, 'destroy_color']);


    /** Product  */
    Route::get('products', [AdminProductController::class, 'index']);
    Route::get('delete-product/{id}',[AdminProductController::class, 'destroy']);
    Route::get('change-status-product-{id}',[AdminProductController::class, 'changeStatus']);

    /** Address  */
    Route::get('address', [AddressController::class, 'index']);
    Route::get('add-address-page',[AddressController::class, 'create']);
    Route::post('add-address',[AddressController::class, 'store']);
    Route::get('edit-address-page-{id}',[AddressController::class, 'show']);
    Route::post('update-address',[AddressController::class, 'update']);
    Route::get('delete-address/{id}',[AddressController::class, 'destroy']);

    /** Coupon  */
    Route::get('coupons', [CouponController::class, 'index']);
    Route::get('add-coupon-page',[CouponController::class, 'create']);
    Route::post('add-coupon',[CouponController::class, 'store']);
    Route::get('edit-coupon-page-{id}',[CouponController::class, 'show']);
    Route::post('update-coupon',[CouponController::class, 'update']);
    Route::get('delete-coupon/{id}',[CouponController::class, 'destroy']);
});
























/** SELLER PANEL */
Route::group([
    'prefix' => 'seller',
    'middleware' => 'sellerLoginCheck'
],function () {
    Route::get('/', function () {
        return view('seller.home.home');
    });

    /** Product  */
    Route::get('products', [ProductController::class, 'index']);
    Route::get('add-product-page',[ProductController::class, 'create']);
    Route::post('add-product',[ProductController::class, 'store']);
    Route::get('edit-product-page-{id}',[ProductController::class, 'show']);
    Route::post('update-product',[ProductController::class, 'update']);
    Route::get('delete-product/{id}',[ProductController::class, 'destroy']);
    Route::get('change-status-product-{id}',[ProductController::class, 'changeStatus']);
    Route::post('select_category',[ProductController::class , 'select_subcategory']);

    /** Product release */
    Route::get('products-release', [ProductReleaseController::class, 'index']);
    Route::get('delete-product-release/{id}',[ProductReleaseController::class, 'destroy']);

    /** Coupon */
    Route::get('coupons', [CouponStoreController::class, 'index']);
    Route::get('add-coupon-page',[CouponStoreController::class, 'create']);
    Route::post('add-coupon',[CouponStoreController::class, 'store']);
    Route::get('edit-coupon-page-{id}',[CouponStoreController::class, 'show']);
    Route::post('update-coupon',[CouponStoreController::class, 'update']);
    Route::get('delete-coupon/{id}',[CouponStoreController::class, 'destroy']);
});

?>