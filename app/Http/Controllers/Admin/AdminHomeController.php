<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\User;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Brand;
use App\Models\SubCategory;

class AdminHomeController extends Controller
{
    public function index()
    {
        $orders = OrderDetail::all();
        $products = Product::all();
        $users = User::all();
        $comments = Comment::all();
        $stores = Store::all();
        $coupons = Coupon::all();
        $categories = Category::all();
        $subCategories = SubCategory::all();
        $favorites = Favorite::all();
        $brands = Brand::all();

        $countUsers = count($users);
        $countOrders = count($orders);
        $countProducts = count($products);
        $countCoupons = count($coupons);
        $countComments = count($comments);
        $countStores = count($stores);
        $countCategories = count($categories);
        $countSubCategory = count($subCategories);
        $countFavorites = count($favorites);
        $countBrands = count($brands);

        return view('pages.home.home',[
            'countUsers' => $countUsers,
            'countOrders' => $countOrders,
            'countProducts' => $countProducts,
            'countCoupons' => $countCoupons,
            'countComments' => $countComments,
            'countStores' => $countStores,
            'countCategories' => $countCategories,
            'countSubCategory' => $countSubCategory,
            'countFavorites' => $countFavorites,
            'countBrands' => $countBrands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
