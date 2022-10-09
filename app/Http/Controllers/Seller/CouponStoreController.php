<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Store;
use Redirect;

class CouponStoreController extends Controller
{
    public function index(){
        $storeID = \Session::get('storeID');
        $store_coupons = Coupon::where('id_store', $storeID)->get();
        return view('seller.coupons.coupons',['store_coupons' => $store_coupons]);
    }

    public function create(){
        return view('seller.coupons.add_coupon');
    }

    public function store(Request $request){
        $checkCode = Coupon::where('couponCode',$request->couponCode)->first();
        if(isset($checkCode)) {
            \Session::put('message','This code already exits.');
            return Redirect::to('seller/add-coupon-page');
        }
        $coupon = new Coupon();
        $coupon->id_store = \Session::get('storeID');
        $coupon->couponType = 'store';
        $coupon->couponName = $request->couponName;
        $coupon->couponCode = $request->couponCode;
        $coupon->couponPercent = $request->couponPercent;
        $coupon->couponTurns = $request->couponTurns;
        $coupon->start_time = $request->start_time;
        $coupon->end_time = $request->end_time;
        $coupon->couponDescription = $request->couponDescription;
        $coupon->save();
        \Session::put('message','Create Coupon Success.');
        return Redirect::to('seller/coupons');
    }

    public function show($id){
        $coupon = Coupon::find($id);
        return view('seller.coupons.edit_coupon', ['coupon' => $coupon]);
    }

    public function update(Request $request){
        $checkCode = Coupon::where('couponCode',$request->couponCode)->first();
        if(isset($checkCode) && $checkCode->id_coupon != $request->id_coupon) {
            \Session::put('message','This code already exits.');
            return Redirect::to('seller/edit-coupon-page');
        }
        $coupon = Coupon::find($request->id_coupon);

        $coupon->id_store = \Session::get('storeID');
        $coupon->couponType = 'store';
        $coupon->couponName = $request->couponName;
        $coupon->couponCode = $request->couponCode;
        $coupon->couponPercent = $request->couponPercent;
        $coupon->couponTurns = $request->couponTurns;
        $coupon->start_time = $request->start_time;
        $coupon->end_time = $request->end_time;
        $coupon->couponDescription = $request->couponDescription;
        $coupon->update($request->all());
       \Session::put('message','Update Coupon Success.');
        return Redirect::to('seller/coupons');
    }

    public function destroy($id){
        $coupon = Coupon::find($id);
        $coupon->delete();
        \Session::put('message','Delete '.$coupon->couponName.' coupon Successfully');
         return Redirect::to('seller/coupons');
    }

}
