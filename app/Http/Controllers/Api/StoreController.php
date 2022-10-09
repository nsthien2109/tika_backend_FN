<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\File;

class StoreController extends Controller
{
    public function index(){
        $stores = Store::all();
        if(!$stores) return response()->json(['message' => 'There are no stores']);

        return response()->json([
            'message' => 'Success',
            'data' => $stores
        ]);
    }

    public function checkStore(Request $request){
        $user = $request->user();
        if(!$user) return response()->json(['message' => 'Login required']);
        $store = Store::where('id_user', $user->id)->get();
        return response()->json([
            'message' => 'Success',
            'user' => $user->id,
            'store' => $store,
        ]);
    }

    public function create(){}

    public function store(Request $request){
        $user = $request->user();
        if(!$user) return response()->json(['message' => 'You are not login'], 200);

        $this->validate($request, [
            'storeName' => 'required|min:1|max:10',
            'storeDescription' => 'required|min:5',
            'storeAddress' => 'required',
            'storeCity' => 'required',
            'storeCountry' => 'required',
            'storePhone' => 'required',
            'storeEmail' => 'required',
            'id_category' => 'required'
        ]);

        $checkStore = Store::where('storeName', $request->storeName)->first();
        if($checkStore) return response()->json(['message' => 'This store name is already existed.']);

        $checkUser = Store::where('id_user', $user['id'])->first();
        if($checkUser) return response()->json(['message' => 'You already have an store.']);


        $store = new Store();
        $store->storeName = $request->storeName;
        $store->storeWebsite = $request->storeWebsite;
        $store->storeDescription = $request->storeDescription;
        $store->storeEmail = $request->storeEmail;
        $store->storeAddress = $request->storeAddress;
        $store->storeCity = $request->storeCity;
        $store->storeCountry = $request->storeCountry;
        $store->storePhone = $request->storePhone;
        $store->id_category = $request->id_category;
        if ($user['role'] == 'admin') $store->id_user = $request->id_user;
        if ($user['role'] != 'admin') $store->id_user = $user['id'];

        $avatar = $request->file('storeAvatar');
        if($avatar){
            $imageName = $request->storeName.'-'."store-".date('d-m-Y-H-i').'.'.$avatar->getClientOriginalExtension();
            $avatar->store($imageName);
            $avatar->move('Images/Store/', $imageName);
            $store->storeAvatar = $imageName;
            $store->save();
            return response()->json([
                'message' => 'Success',
                'data' => $store
            ]);
        }

        $store->save();
        return response()->json([
            'message' => 'Success',
            'data' => $store
        ], 200);

    }

    public function show($id){
        $store = Store::find($id);
        if(!$store) return response()->json(['message' => 'This store does not exist.']);
        return response()->json(['message' => 'Success', 'data' => $store]);
    }

    public function edit($id){}

    public function update(Request $request, $id){
        $user = $request->user();
        if(!$user) return response()->json(['message' => 'You are not login'], 200);

        $store = Store::find($id);
        if(!$store) return response()->json(['message' => 'This store does not exist.']);

        if ($user['id'] != $store['id_user']) return response()->json(['message' => 'You are not owner this store'], 200);

        $store->storeName = $request->storeName;
        $store->storeWebsite = $request->storeWebsite;
        $store->storeDescription = $request->storeDescription;
        $store->storeEmail = $request->storeEmail;
        $store->storeAddress = $request->storeAddress;
        $store->storeCity = $request->storeCity;
        $store->storeCountry = $request->storeCountry;
        $store->storePhone = $request->storePhone;
        $store->id_category = $request->id_category;

        $image = $request->file('storeAvatar');
        if($image){
            File::delete(public_path("Images/Store/".$store->storeAvatar));
            $imageName = $request->storeName.'-'."store-".date('d-m-Y-H-i').'.'.$avatar->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Store/', $imageName);
            $store->storeAvatar = $imageName;
            $store->save();
            return response()->json([
                'message' => 'Success',
                'data' => $store
            ]);
        }

        $store->update($request->all());
        return response()->json([
            'message' => 'Success',
            'data' => $store
        ]);

    }

    public function destroy(Request $request, $id){
        $user = $request->user();
        if(!$user) return response()->json(['message' => 'You are not login'], 200);
        
        $store = Store::find($id);

        if ($user['id'] != $store['id_user']) return response()->json(['message' => 'You are not owner this store'], 200);

        File::delete(public_path("Images/Store/".$store->storeAvatar));
        $store->delete();

        return response()->json(['message' => 'Success'], 200);
    }


    function convert_name($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
		return $str;
	}
}
