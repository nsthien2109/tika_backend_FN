<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Store;
use Redirect;

class CouponController extends Controller
{
    public function index(){
        $global_coupons = Coupon::where('id_store', )->get();
        $store_coupons = Coupon::join('store', 'coupon.id_store', '=' ,'store.id_store')->get();
        return view('pages.coupons.coupons',['global_coupons' => $global_coupons, 'store_coupons' => $store_coupons]);
    }

    public function create(){
        $stores = Store::all();
        $coupons = Coupon::all();
        return view('pages.coupons.add_coupon',['stores' => $stores]);
    }

    public function store(Request $request){
        $checkCode = Coupon::where('couponCode',$request->couponCode)->first();
        if(isset($checkCode)) {
            \Session::put('message','This code already exits.');
            return Redirect::to('admin/add-coupon-page');
        }
        $coupon = new Coupon();
        if(empty($request->id_store)){
            $coupon->couponType = 'global';
        }else{
            $coupon->id_store = $request->id_store;
            $coupon->couponType = 'store';
        }
        $coupon->couponName = $request->couponName;
        $coupon->couponCode = $request->couponCode;
        $coupon->couponPercent = $request->couponPercent;
        $coupon->couponTurns = $request->couponTurns;
        $coupon->start_time = $request->start_time;
        $coupon->end_time = $request->end_time;
        $coupon->couponDescription = $request->couponDescription;
        $coupon->save();
        \Session::put('message','Create Coupon Success.');
        return Redirect::to('admin/coupons');
    }

    public function show($id){
        $coupon = Coupon::find($id);
        $stores = Store::all();
        return view('pages.coupons.edit_coupon', ['coupon' => $coupon,'stores' => $stores]);
    }

    public function update(Request $request){
        $checkCode = Coupon::where('couponCode',$request->couponCode)->first();
        if(isset($checkCode) && $checkCode->id_coupon != $request->id_coupon) {
            \Session::put('message','This code already exits.');
            return Redirect::to('admin/edit-coupon-page');
        }

        $coupon = Coupon::find($request->id_coupon);

        if(empty($request->id_store)){
            $coupon->couponType = 'global';
        }else{
            $coupon->id_store = $request->id_store;
            $coupon->couponType = 'store';
        }
        $coupon->couponName = $request->couponName;
        $coupon->couponCode = $request->couponCode;
        $coupon->couponPercent = $request->couponPercent;
        $coupon->couponTurns = $request->couponTurns;
        $coupon->start_time = $request->start_time;
        $coupon->end_time = $request->end_time;
        $coupon->couponDescription = $request->couponDescription;
        $coupon->update($request->all());
       \Session::put('message','Update Coupon Success.');
        return Redirect::to('admin/coupons');
    }

    public function destroy($id){
        $coupon = Coupon::find($id);
        $coupon->delete();
        \Session::put('message','Delete '.$coupon->couponName.' coupon Successfully');
         return Redirect::to('admin/coupons');
    }


}
