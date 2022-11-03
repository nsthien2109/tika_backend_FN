<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Store;

class AuthController extends Controller
{
    public function register(Request $request){
        /** Validation form register */
        $this->validate($request, [
            'firstName' => 'required|min:2|max:50',
            'lastName' => 'required|min:2|max:50',
            'email' => 'required|email',
            'phone' => 'min:9|max:13|required',
            'password' => 'required|min:6|max:50',
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
            'role' => 2, // 2 is role of the user
        ]);
        return response()->json(['message' => 'Register Successfully'], 200);
    }

    public function login(Request $request){
        /** Validation form login */
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6|max:50',
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user) return response()->json(['message' => 'User Not Found'], 404);
        if(!Hash::check($request->password, $user->password)) return response()->json(['message' => "Opps Wrong password"], 404);
        if($user->role != 2) return response()->json(['message' => "Your information is not valid"]);
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'message' => 'Login Successfully',
            'data' => $user,
            'accessToken' => $token,
            'type' => 'Bearer'
        ], 200);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        if($user['role'] != 2) return response()->json(['message' => 'You are not allowed to this action.']);
        $user = User::find($user->id);
        if($user){
            if(isset($request->currentPassword) && isset($request->newPassword)){
                if (Hash::check($request->currentPassword, $user->password)) {
                    $user->update([
                        'password'=> Hash::make($request->newPassword),
                    ]); 
                }
            }
            $user->update($request->all());
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'message' => 'Success',
                'data' => $user,
                'accessToken' => $token,
                'type' => 'Bearer'
            ], 200);
        }
    }

    public function user(Request $request){
        $user = $request->user();
        $store = Store::where('id_user', $user->id)->first();
        return response()->json([
            "user" => $user,
            "store" => $store
        ]);

    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logouted'], 200);
    }
}
