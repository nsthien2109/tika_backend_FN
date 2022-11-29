<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $address = Address::where('id_user', $user->id)
        ->join('users','users.id','=','address.id_user')
        ->select('address.*','users.firstName','users.lastName', 'users.phone')
        ->first();
        return response()->json([
            'message' => 'Success',
            'data' => $address
        ],200);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user['role'] != 2) return response()->json(['message' => 'You are not allowed to this action.']);
        $addressExit = Address::where('id_user', $user->id)->first();
        if($addressExit){
            $addressExit->update([
                'addressProvince'=> $request->addressProvince,
                'addressDistrict'=> $request->addressDistrict,
                'addressCommune'=> $request->addressCommune,
                'addressSpecific'=> $request->addressSpecific,
            ]);
            return response()->json(['message' => 'Success', 'data' => $addressExit]);
        }else{
            $address = new Address();
            $address->id_user = $user->id;
            $address->addressProvince = $request->addressProvince;
            $address->addressDistrict = $request->addressDistrict;
            $address->addressCommune = $request->addressCommune;
            $address->addressSpecific = $request->addressSpecific;
            $address->save();
            $addressData = Address::where('id_address', '=',$address->id_address)->first();
            return response()->json([
                'message' => 'Success',
                'data' => $addressData
            ]);
        }
    }
}
