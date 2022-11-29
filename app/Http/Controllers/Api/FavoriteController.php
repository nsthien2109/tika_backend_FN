<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorite = Favorite::all();
        if (!isset($favorite)) return response()->json(['message' => 'Favorite not found']);
        return response()->json([
            'message' => 'Success',
            'data' => $favorite
        ]);
    }

    public function create(){}

    public function store(Request $request)
    {
        $user = $request->user();
        if($user['role'] != 2) return response()->json(['message' => 'You are not allowed to this action.']);
        $checkExits = Favorite::where('id_product','=', $request->id_product)->where('id_user','=', $user->id)->first();
        if($checkExits) return response()->json(['message' => "Failure"],404);

        $favorite = new Favorite();
        $favorite->id_user = $user->id;
        $favorite->id_product = $request->id_product;
        $favorite->save();
        $favoriteData = Favorite::where('id_favorite', '=',$favorite->id_favorite)->join('products', 'products.id_product' , '=' , 'favorite.id_product')->first();
        return response()->json([
            'message' => 'Success',
            'data' => $favoriteData
        ]);
    }

    public function show( Request $request ,$id){ 
        $user = $request->user();
        $favorite = Favorite::where('id_user', $user->id)->join('products', 'products.id_product' , '=' , 'favorite.id_product')->get();
        return response()->json([
            'message' => 'Success',
            'data' => $favorite
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $favorite = Favorite::where('id_favorite','=',$id)->where('id_user',$user->id)->first();
        $favorite->delete();
        return response()->json(['message' => 'Success', 'data' => $favorite], 200);
    }
}
