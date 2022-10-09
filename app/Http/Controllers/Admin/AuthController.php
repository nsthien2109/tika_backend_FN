<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use Redirect;


class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }
    
    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if(!$user){
            \Session::put('message',"Please enter all field !");
            return Redirect::to('/login-page');
        }

        if($user == null){
            \Session::put('message',"Your email doesn't exist !");
            return Redirect::to('/login-page');
        }
            
        if(!Hash::check($request->password, $user->password)){
            \Session::put('message',"Wrong Password !");
            return Redirect::to('/login-page');
        } 

        if($user->role == 2){
            \Session::put('message',"Your account is not invalid to this website !");
            return Redirect::to('/login-page');
        }elseif($user->role == 1){
            \Session::put('sellerSystem',true);
            \Session::put('adminSystem',false);
            \Session::put('sellerName',$user->firstName.' '.$user->lastName);
            \Session::put('sellerID',$user->id);
            $store = Store::where('id_user',$user->id)->first();
            \Session::put('storeID',$store->id_store);
            return Redirect::to('/seller');
        }
        \Session::put('sellerSystem',false);
        \Session::put('adminSystem',true);
        \Session::put('adminName',$user->firstName.' '.$user->lastName);
        \Session::put('adminId',$user->id);
        return Redirect::to('/admin');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return Redirect::to('/login-page');
    }
}
