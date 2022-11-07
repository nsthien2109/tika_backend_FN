<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Store;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function check_coupon(Request $request){
        $coupon = Coupon::where('couponCode', $request->couponCode)->first();
        if(isset($coupon)){
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            if($coupon->start_time > $now){
                return response()->json(['message' => 'The discount code is not valid yet'],404); 
            }
            if($coupon->end_time < $now){
                return response()->json([
                    'message' => 'This discount code has expired',
                ],404); 
            }
            return response()->json([
                'message' => 'Success',
                'data' => $coupon
            ]);
        }else{
            return response()->json(['message' => 'Discount code does not exist'],404);
        }
    }
}
