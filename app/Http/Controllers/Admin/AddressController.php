<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Address;
use App\Models\User;
use Redirect;

class AddressController extends Controller
{
    public function index(){
        $address = Address::join('users','address.id_user', '=' , 'users.id')->get();
        return view('pages.address.address',['address' => $address]);
    }

    public function create(){
        $users = User::where('role',2)->get();
        return view('pages.address.add_address',['users' => $users]);
    }

    public function store(Request $request){
        $checkAddress = Address::where('id_user',$request->id_user)->first();
        if(isset($checkAddress)) {
            \Session::put('message','This user had a address.');
            return Redirect::to('admin/add-address-page');
        }
        $address = new Address();
        $address->addressProvince = $request->addressProvince;
        $address->addressDistrict = $request->addressDistrict;
        $address->addressCommune = $request->addressCommune;
        $address->addressSpecific = $request->addressSpecific;
        $address->id_user = $request->id_user;
        $address->save();
        \Session::put('message','Create Address Success.');
        return Redirect::to('admin/address');
    }

    public function show($id)
    {
        $address = Address::find($id);
        return view('pages.address.edit_address', ['address' => $address]);
    }

    public function update(Request $request){
        $addressID = $request->id_address;
        $address = Address::find($addressID);

        $address->addressProvince = $request->addressProvince;
        $address->addressDistrict = $request->addressDistrict;
        $address->addressCommune = $request->addressCommune;
        $address->addressSpecific = $request->addressSpecific;
        $address->update($request->all());
        \Session::put('message','Update Address Success.');
        return Redirect::to('admin/address');
    }

    public function destroy($id){
        $address = Address::find($id);
        $address->delete();
        \Session::put('message','Delete Address Successfully');
        return Redirect::to('admin/address');
    }
}
