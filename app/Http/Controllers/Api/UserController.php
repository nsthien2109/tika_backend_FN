<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function index(Request $request){
        $users = User::all();
        $check = $request->user();
        if($check['role'] == 'admin'){
            if (!$users) return response()->json(['message' => 'User not yet']);
            return response()->json([
                'message' => 'Success',
                'data' => $users
            ]);
        }else{
            return response()->json(['message' => 'You are not allowed to access this page']);
        }
    }

    public function create(){}

    public function store(Request $request){
        $check = $request->user();
        if($check['role'] != 'admin') return response()->json(['message' => 'You are not allowed to access this page']);

        $this->validate($request, [
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'email' => 'required|email',
            'phone' => 'min:9|max:13|required',
            'password' => 'required|min:6|max:50',
            'role' => 'required',
        ]);

        $checkEmail = User::where('email', $request->email)->first();
        if($checkEmail) return response()->json(['message' => 'This email address is already exists.']);

        $checkPhone = User::where('phone', $request->phone)->first();
        if($checkPhone) return response()->json(['message' => 'This phone number is already in use.']);
        
        $newUser = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email'=> $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return response()->json(['message' => 'Create Successfully'], 200);
    }

    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){
        $check = $request->user();
        if($check['role'] == 'admin') {
            $user = User::find($id);
            if (!$user) return response()->json(['message' => 'User not found']);
            $user->update($request->all());
            return response()->json(['message' => 'Success2'], 200);
        }
        return response()->json(['message' => ' You are not allowed to update this page']);
    }

    public function destroy(Request $request,$id){
        $check = $request->user();
        $user = User::find($id);
        if($check['role'] == 'admin'){
            if(!$user) return response()->json(['message' => 'User not found']);
            $user->delete();
            return response()->json(['message' => 'Success']);
        }
        return response()->json(['message' => 'You are not allowed to access this page']);
    }
}