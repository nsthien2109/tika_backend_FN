<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Comment;

class HomeController extends Controller
{

    public function index()
    {
        $id_store = \Session::get('storeID');
        $orders = Order::join('order_detail', 'order.id_order', '=','order_detail.id_order')
        ->join('products', 'products.id_product' , '=' , 'order_detail.id_product')
        ->where('products.id_store', $id_store)->select('order.*', 'order_detail.*', 'products.productImage','products.productName')
        ->get();
        $products = Product::where('id_store', $id_store)->get();
        $coupons = Coupon::where('id_store', $id_store)->get();
        $comments = Comment::join('products', 'products.id_product', '=', 'comment.id_product')
        ->where('id_store', $id_store)
        ->get();
        $totalMoney = Order::join('order_detail', 'order.id_order', '=','order_detail.id_order')
        ->join('products', 'products.id_product' , '=' , 'order_detail.id_product')
        ->where('products.id_store', $id_store)->max('total');
        $countOrders = count($orders);
        $countProducts = count($products);
        $countCoupons = count($coupons);
        $countComments = count($comments);

        return view('seller.home.home',[
            'orders'=>$orders,
            'countOrders' => $countOrders,
            'countProducts' => $countProducts,
            'countCoupons' => $countCoupons,
            'countComments' => $countComments,
            'totalMoney' => $totalMoney,
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
