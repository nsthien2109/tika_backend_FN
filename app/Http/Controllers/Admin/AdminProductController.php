<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Product;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;
use App\Models\Images;
use App\Models\ProductRelease;
use Redirect;

class AdminProductController extends Controller
{
    public function index(){
        $products = Product::join('category', 'products.id_category', '=', 'category.id_category')
        ->join('brand', 'products.id_brand', '=', 'brand.id_brand')
        ->join('store', 'products.id_store', '=', 'store.id_store')
        ->get();
        return view('pages.product.products',['products' => $products]);
    }

    public function destroy($id){
        $product = Product::find($id);
        $release = ProductRelease::where('id_product', $product->id_product)->get();
        $images = Images::where('id_product',$product->id_product)->get();
        foreach ($images as $key => $image) {
            File::delete(public_path($image->url));
            $image->delete();
        }
        foreach ($release as $key => $reProduct) {
            $reProduct->delete();
        }

        $product->delete();
        \Session::put('message','Delete '.$product->productName.' product Successfully');
        return Redirect::to('admin/products');
    }


    public function changeStatus($id){
        $product = Product::find($id);
        if($product->productStatus == 0){
            $product->update(['productStatus'=>1]);
        }else{
            $product->update(['productStatus'=>0]);
        }
        \Session::put('message','Update status Success.');
        return Redirect::to('admin/products');
    }
}
