<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $order = Order::where('id_user', $user->id)->get();
        return response()->json([
            'message' => 'Success',
            'data' => $order
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user['role'] != 2) return response()->json(['message' => 'You are not allowed to this action.',400]);
        $cart = Cart::where('id_user',$user->id)->join('products','products.id_product','=','cart.id_product')->get();
        if(sizeof($cart) <= 0) return response()->json(['message' => 'Your cart is empty',404]);
        $order = new Order();
        $order->id_user = $user->id;
        $order->addressProvince = $request->addressProvince;
        $order->addressDistrict = $request->addressDistrict;
        $order->addressCommune = $request->addressCommune;
        $order->addressSpecific = $request->addressSpecific;
        $order->feeship = $request->feeship;
        $order->orderTotal = $request->orderTotal;
        $order->orderName = $request->orderName;
        $order->orderEmail = $request->orderEmail;
        $order->orderPhone = $request->orderPhone;
        $order->orderCoupon = $request->orderCoupon;
        $order->orderDiscount = $request->orderDiscount;
        $order->paymentMethod = $request->paymentMethod;
        $order->orderNotes = $request->orderNotes;
        $order->save();

        $coupon = Coupon::where('couponCode','=', $request->orderCoupon)->first();

        foreach ($cart as $key => $item) {
            $product = Product::find($item->id_product); // lấy ra cái product này từ database để so sánh
            $detail = new OrderDetail(); // khởi tạo một cái detail
            $price = $product->productPrice - $product->productPrice * ($product->discount / 100); 

            $detail->id_order = $order->id_order;
            $detail->id_product = $item->id_product;
            $detail->id_size = $item->id_size;
            $detail->id_color = $item->id_color;
            $detail->quantity = $item->quantity;
            if(isset($coupon)){
                $salePrice = $price - $price * ($coupon->couponPercent / 100);
                if($coupon->couponType == 'global'){
                    $detail->total = $item->quantity * $salePrice;
                    $detail->orderCoupon = $request->orderCoupon;
                    $detail->orderDiscount = $coupon->couponPercent;
                }elseif($coupon->couponType == 'store'){
                    if($product->id_store == $coupon->id_store){
                        $detail->total = $item->quantity * $salePrice;
                        $detail->orderCoupon = $request->orderCoupon;
                        $detail->orderDiscount = $coupon->couponPercent;
                    }else{
                        $detail->total = $item->quantity * $price;
                        $detail->orderCoupon = NULL;
                        $detail->orderDiscount = NULL;
                    }
                }
            }else{
                $detail->total = $item->quantity * $price;
                $detail->orderCoupon = NULL;
                $detail->orderDiscount = NULL;
            }
            $detail->status = 1; //0 Cancelled - 1 Pending - 2 Confirmed - 3 Deliveried - 4 Refund
            $detail->statusType = 'Pending';
            $detail->save();
            $item->delete();
        }
        return response()->json([
            'message' => 'Success',
            'data' => $order
        ]);
    }

    public function show(Request $request,$id)
    {
        $user = $request->user();
        $orders = OrderDetail::join('order', 'order.id_order', '=','order_detail.id_order')
        ->join('products', 'products.id_product' , '=' , 'order_detail.id_product')
        ->where('order_detail.id_order','=', $id)
        // ->where('order.id_user','=', $user->id)
        ->select('order.*', 'order_detail.*', 'products.productImage','products.productName')
        ->get();

        return response()->json([
            'message' => 'Success',
            'data' => $orders
        ], 200);
    }

    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $detail = OrderDetail::where('id_order', $order->id_order)->get();
        foreach ($detail as $key => $item) {
            $item->delete();
        }
        $order->delete();
        return response()->json(['message' => 'Success'], 200);
    }
}
