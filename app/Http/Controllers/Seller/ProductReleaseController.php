<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductRelease;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Color;
use App\Models\Category;
use Redirect;

class ProductReleaseController extends Controller
{
    public function index(){
        $userID = \Session::get('sellerID');
        $store = Store::where('id_user', $userID)->first();
        $products_release = ProductRelease::join('products', 'product_release.id_product', '=', 'products.id_product')->
        join('size','product_release.id_size', '=', 'size.id_size')->join('color','product_release.id_color', '=' ,'color.id_color')->
        where('products.id_store', '=', $store->id_store)->get();
        return view('seller.product_release.products_release',['products_release' => $products_release]);
    }
    
    public function destroy($id){
        $release = ProductRelease::find($id);
        $release->delete();
        \Session::put('message','Delete Product release Successfully');
         return Redirect::to('seller/products-release');
    }
}
