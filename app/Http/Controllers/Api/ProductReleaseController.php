<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductRelease;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Color;

class ProductReleaseController extends Controller
{
    public function index()
    {
        $dataSize = ProductRelease::join('size','product_release.id_size', '=', 'size.id_size')->get();
        $dataColor = ProductRelease::join('color','product_release.id_color', '=', 'color.id_color')->get();
        return response()->json([
            'message' => 'Success',
            'data' => ['sizes' => $dataSize,'colors' => $dataColor]
        ], 200);
    }
 
    public function show($id) // this is id of product
    {
        $dataSize = ProductRelease::where('id_product',$id)->join('size','product_release.id_size', '=', 'size.id_size')->get();
        $dataColor = ProductRelease::where('id_product',$id)->join('color','product_release.id_color', '=', 'color.id_color')->get();
        return response()->json([
            'message' => 'Success',
            'data' => ['sizes' => $dataSize,'colors' => $dataColor]
        ], 200);
    }

    public function destroy($id)
    {
        //
    }
}
