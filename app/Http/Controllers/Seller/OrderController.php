<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Redirect;

class OrderController extends Controller
{
    public function index(){
        $id_store = \Session::get('storeID');
        $orders = Order::join('order_detail', 'order.id_order', '=','order_detail.id_order')
        ->join('products', 'products.id_product' , '=' , 'order_detail.id_product')
        ->where('products.id_store', $id_store)->select('order.*', 'order_detail.*', 'products.productImage','products.productName')
        ->get();
        
        return view('seller.order.orders',['orders'=>$orders]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update($id)
    {
        $order = OrderDetail::find($id);
        if(isset($order)){
            if($order->status == 0){
                $order->update(['status' => 1, 'statusType' => 'Pending']);
            }elseif($order->status == 1){
                $order->update(['status' => 2, 'statusType' => 'Confirmed']);
            }elseif($order->status == 2){
                $order->update(['status' => 3, 'statusType' => 'Deliveried']);
            }elseif($order->status == 3){
                $order->update(['status' => 4, 'statusType' => 'Refund']);
            }elseif($order->status == 4){
                $order->update(['status' => 0, 'statusType' => 'Cancelled']);
            }
        }
        \Session::put('message','Update Status success.');
        return Redirect::to('seller/orders');
    }

    public function destroy($id)
    {
        $order = OrderDetail::find($id);
        if(isset($order)){
            $order->delete();
            \Session::put('message','Update Status success.');
            return Redirect::to('seller/orders');   
        }else{
            \Session::put('message','Order not found.');
            return Redirect::to('seller/orders');
        }
    }
}
