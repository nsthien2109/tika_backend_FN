<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\Store;
use Redirect;

class InfomationController extends Controller
{

    public function index()
    {
        $userId = \Session::get('sellerID');
        $storeId = \Session::get('storeID');
        $user = User::find($userId);
        $store = Store::find($storeId);
        return view('seller.infomation.infomation',['user' => $user, 'store' => $store]);
    }

    public function updateProfile(Request $request){
        $user = User::find($request->idUser);
        $user->update($request->all());
        \Session::put('message','Update User Successfully');
         return Redirect::to('seller/infomation');
    }

    public function updateStore(Request $request){
        $checkStore = Store::where('storeName',$request->storeName)->first();
        if($checkStore && $checkStore->id_store != $request->storeId){
            \Session::put('message','This store name is already exists.');
            return Redirect::back();
        }

        $storeId = $request->storeId;
        $store = Store::find($storeId);

        $store->storeName = $request->storeName;
        $store->storeWebsite = $request->storeWebsite;
        $store->storeDescription = $request->storeDescription;
        $store->storeEmail = $request->storeEmail;
        $store->storeAddress = $request->storeAddress;
        $store->storeCity = $request->storeCity;
        $store->storeCountry = $request->storeCountry;
        $store->storePhone = $request->storePhone;

        $imageAvatar = $request->file('storeAvatar');
        if($imageAvatar){
            File::delete(public_path($store->storeAvatar));
            $nameStore = $this->convert_name($request->storeName);
            $imageName = "store-".$nameStore.'-'.date('d-m-Y-H-i').'.'.$imageAvatar->getClientOriginalExtension();
            $imageAvatar->store($imageName);
            $imageAvatar->move("Images/Store/$nameStore/Avatar/", $imageName);
            $path = "Images/Store/$nameStore/Avatar/$imageName";
            $store->storeAvatar = $path;
        }

        $imageBackground = $request->file('storeBackgroundImage');
        if($imageBackground){
            File::delete(public_path($store->storeBackgroundImage));
            $nameStore = $this->convert_name($request->storeName);
            $imageName = "store-".$nameStore.'-'.date('d-m-Y-H-i').'.'.$imageBackground->getClientOriginalExtension();
            $imageBackground->store($imageName);
            $imageBackground->move("Images/Store/'.$nameStore.'/Background/", $imageName);
            $path = "Images/Store/$nameStore/Background/$imageName";
            $store->storeBackgroundImage = $path;
        }

        $store->save();
            \Session::put('message','Update store Success.');
            return Redirect::to('seller/infomation');       
    }

   
}
