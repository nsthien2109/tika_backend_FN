<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();
        $cart = Cart::where('id_user', $user->id)->join('products', 'products.id_product' , '=' , 'cart.id_product')->get();
        return response()->json([
            'message' => 'Success',
            'data' => $cart
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        if($user['role'] != 2) return response()->json(['message' => 'You are not allowed to this action.']);
        $cartExist = Cart::where('id_product','=', $request->id_product)
        ->where('id_size','=', $request->id_size)
        ->where('id_color','=', $request->id_color)
        ->where('id_user','=', $user->id)
        ->first();
        if($cartExist){
            $cartExist->update(['quantity'=> $cartExist->quantity + $request->quantity]);
        }else{
            $cart = new Cart();
            $cart->id_user = $user->id;
            $cart->id_product = $request->id_product;
            $cart->id_size = $request->id_size;
            $cart->id_color = $request->id_color;
            $cart->quantity = $request->quantity;
            $cart->save();
            $cartData = Cart::where('id_cart', '=',$cart->id_cart)->join('products', 'products.id_product' , '=' , 'cart.id_product')->first();
            return response()->json([
                'message' => 'Success',
                'data' => $cartData
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request ,$id) // id_cart 
    {
        $user = $request->user();
        if($user->role != 2) return response()->json(['message' => 'You are not allowed to delete this favorite.']);
        $cart = Cart::find($id);
        $cart->delete();
        return response()->json(['message' => 'Success'], 200);
    }
}
