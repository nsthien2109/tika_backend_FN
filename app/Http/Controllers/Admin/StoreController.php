<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Store;
use App\Models\User;
use Redirect;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('pages.store.stores',['stores' => $stores]);
    }
    public function create()
    {
        $users = User::where('role',2)->get();
        return view('pages.store.add_store',['users' => $users]);
    }
    public function store(Request $request){
        
        $checkStore = Store::where('storeName',$request->storeName)->first();
        if($checkStore){
            \Session::put('message','This store name is already exists.');
            return Redirect::to('admin/add-store-page');
        }

        if ($request->id_user == "-1") {
            \Session::put('message','Please choose owner store !.');
            return Redirect::to('admin/add-store-page');
        }

        

        $store = new Store();
        $store->storeName = $request->storeName;
        $store->storeWebsite = $request->storeWebsite;
        $store->storeDescription = $request->storeDescription;
        $store->storeEmail = $request->storeEmail;
        $store->storeAddress = $request->storeAddress;
        $store->storeCity = $request->storeCity;
        $store->storeCountry = $request->storeCountry;
        $store->storePhone = $request->storePhone;
        $store->storeStatus = $request->storeStatus;
        $store->id_user = $request->id_user;

        $imageAvatar = $request->file('storeAvatar');
        if($imageAvatar){
            $nameStore = $this->convert_name($request->storeName);
            $imageName = "store-".$nameStore.'-'.date('d-m-Y-H-i').'.'.$imageAvatar->getClientOriginalExtension();
            $imageAvatar->store($imageName);
            $imageAvatar->move("Images/Store/$nameStore/Avatar/", $imageName);
            $path = "Images/Store/$nameStore/Avatar/$imageName";
            $store->storeAvatar = $path;
        }

        $imageBackground = $request->file('storeBackgroundImage');
        if($imageBackground){
            $nameStore = $this->convert_name($request->storeName);
            $imageName = "store-".$nameStore.'-'.date('d-m-Y-H-i').'.'.$imageBackground->getClientOriginalExtension();
            $imageBackground->store($imageName);
            $imageBackground->move("Images/Store/$nameStore/Background/", $imageName);
            $path = "Images/Store/$nameStore/Background/$imageName";
            $store->storeBackgroundImage = $path;
        }

        $user = User::find($request->id_user);
        $user->update(['role' => 1]);
        $store->save();
        \Session::put('message','Create Store Success.');
        return Redirect::to('admin/stores');
    }

    public function show($id){
        $store = Store::find($id);
        return view('pages.store.edit_store', ['store' => $store]);
    }

    public function edit($id){
        //
    }

    public function changeStatus($id){
        $store = Store::find($id);
        if($store->storeStatus == 0){
            $store->update(['storeStatus'=>1]);
        }else{
            $store->update(['storeStatus'=>0]);
        }
        \Session::put('message','Update brand Success.');
        return Redirect::to('admin/stores');
    }

    public function update(Request $request){
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
            return Redirect::to('admin/stores');       
    }

    public function destroy($id){
        $store = Store::find($id);
        File::delete(public_path($store->storeAvatar));
        File::delete(public_path($store->storeBackgroundImage));
        $user = User::find($store->id_user);
        $user->update(['role' => 2]); // 1 to 2 -> seller to user
        $store->delete();
        \Session::put('message','Delete '.$store->storeName.' store Successfully');
         return Redirect::to('admin/stores');
    }

    public function convert_name($str) {
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'a', $str);
		$str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'e', $str);
		$str = preg_replace("/(??|??|???|???|??)/", 'i', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'o', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'u', $str);
		$str = preg_replace("/(???|??|???|???|???)/", 'y', $str);
		$str = preg_replace("/(??)/", 'd', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'A', $str);
		$str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'E', $str);
		$str = preg_replace("/(??|??|???|???|??)/", 'I', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'O', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'U', $str);
		$str = preg_replace("/(???|??|???|???|???)/", 'Y', $str);
		$str = preg_replace("/(??)/", 'D', $str);
		$str = preg_replace("/(\???|\???|\???|\???|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
		return $str;
	}
    
}
