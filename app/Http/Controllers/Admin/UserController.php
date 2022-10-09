<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Redirect;


class UserController extends Controller
{
 
    public function index()
    {
        $users = User::all();
        return view('pages.user.users',['users' => $users]);
    }
    public function create()
    {
        return view('pages.user.add_user');
    }
    public function store(Request $request){

        $checkValidation = $request->validate([
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'email' => 'required|email',
            'phone' => 'min:9|max:13|required',
            'password' => 'required|min:6|max:50',
            'role' => 'required',
        ]);

        if ($checkValidation == null) {
            \Session::put('message','Please enter all field !');
            dd("PLSS");
            return Redirect::to('admin/add-user-page');
        }

        $checkEmail = User::where('email', $request->email)->first();
        if($checkEmail){
            \Session::put('message','This email address is already exists.');
            return Redirect::to('admin/add-user-page');
        }

        $checkPhone = User::where('phone', $request->phone)->first();
        if($checkPhone){
            \Session::put('message','This phone number is already in use.');
            return Redirect::to('admin/add-user-page');
        }
        
        $newUser = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email'=> $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        \Session::put('message','Create User Successfully');
         return Redirect::to('admin/users');
    }


    public function show($id)
    {
        $user = User::find($id);
        return view('pages.profile.profile',['user' => $user]);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request){
        $user = User::find($request->idUser);
        $user->update($request->all());
        \Session::put('message','Update User Successfully');
         return Redirect::to('admin/users');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        \Session::put('message','Delete User '.$user->firstName.' Successfully');
         return Redirect::to('admin/users');
    }
}
