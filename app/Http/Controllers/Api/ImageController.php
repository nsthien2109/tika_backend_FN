<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\Images;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /** Show items  */
    public function index(){
        $images = Images::all();
        if (!$images) return response()->json(['message' => 'Image not found']);
        return response()->json([
            'message' => 'Success',
            'data' => $images
        ]);
    }

    public function show($id){
        $images = Images::where('id_product', $id)->get();
        if (!$images) return response()->json(['message' => 'Image not found']);
        return response()->json([
            'message' => 'Success',
            'data' => $images
        ]);
    }
}
