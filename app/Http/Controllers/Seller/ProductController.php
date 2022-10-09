<?php

namespace App\Http\Controllers\Seller;
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

class ProductController extends Controller
{

    public function index(){
        $userID = \Session::get('sellerID');
        $store = Store::where('id_user', $userID)->first();
        $products = Product::where('id_store', $store->id_store)
        ->join('category', 'products.id_category', '=', 'category.id_category')
        ->join('brand', 'products.id_brand', '=', 'brand.id_brand')->get();
        return view('seller.product.products',['products' => $products]);
    }
    public function create(){
        $brands = Brand::all();
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('seller.product.add_product',['categories' => $categories, 'brands' => $brands,'sizes' => $sizes, 'colors' => $colors]);
    }

    public function store(Request $request){

        $userID = $request->session()->get('sellerID');
        $store = Store::where('id_user', $userID)->first();
        if(empty($store->id_store)){
            \Session::put('message',"Your store does not exist !");
            return Redirect::to('/seller/add-product-page');
        }
        /** Check name product exits in store */
        $products = Product::where('id_store',$store->id_store)->get();
        foreach ($products as $key => $product) {
            if($product->productName == $request->productName){
                \Session::put('message',"This name product exist in your store !");
                return Redirect::to('/seller/add-product-page'); 
            }
        }
        /** Get product data */
        $product = new Product();
        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->productPrice = $request->productPrice;
        $product->productAmount = $request->productAmount;
        $product->purchases = 0;
        $product->likes = 0;
        $product->comments = 0;
        $product->productStatus = $request->productStatus;
        $product->id_store = $store->id_store;
        $product->id_brand = $request->id_brand;
        $product->id_category = $request->id_category;
        $product->discount = $request->discount ?? 0;
        $nextID = $this->getNextID();

        /** Update number category */
        $category = Category::find($request->id_category)->first();
        $currentProduct = $category->numProducts;
        $category->update(['numProducts' => $currentProduct + 1]);


        /** Size and color */
        if(sizeof($request->id_size) > 0 && sizeof($request->id_color) > 0){
            foreach($request->id_size as $id_size) {
                foreach($request->id_color as $id_color) {  
                    $release = new ProductRelease();
                    $release->id_product = $nextID;
                    $release->id_size = $id_size;
                    $release->id_color = $id_color;
                    $release->save();       
                }
            } 
        }elseif(sizeof($request->id_size) > 0 && sizeof($request->id_color) == 0){
            \Session::put('message',"Please select image for this product !");
            return Redirect::to('/seller/add-product-page');
        }elseif(sizeof($request->id_size) == 0 && sizeof($request->id_color) > 0){
            \Session::put('message',"Please select image for this product !");
            return Redirect::to('/seller/add-product-page');
        }else{
            \Session::put('message','Something went wrong.');
        }
        /** End size and color */

        $mainImage = '';
        $imageProduct = $request->file('productImages');
        if($imageProduct){
            foreach($request->file('productImages') as $key => $imagefile){
                $image = new Images();
                $nameProduct = $this->convert_name($request->productName);
                $nameStore = $this->convert_name($store->storeName);
                $imageName = "product-".$nameProduct.'--'.$key.'--'.date('d-m-Y-H-i').'.'.$imagefile->getClientOriginalExtension();
                $imagefile->store($imageName);
                $imagefile->move("Images/Store/$nameStore/Product/$nameProduct/", $imageName);
                $path = "Images/Store/$nameStore/Product/$nameProduct/$imageName";
                $image->url = $path;
                $image->id_product = $nextID;
                if($key == 0){
                    $mainImage = $path;
                    $image->save();
                }
                $image->save();
            }
            $product->productImage = $mainImage;
        }else{
            \Session::put('message',"Please select image for this product !");
             return Redirect::to('/seller/add-product-page');
        }
        $product->save();
        return Redirect::to('seller/products');
    }


    public function show($id){
        $brands = Brand::all();
        $categories = Category::all();
        $product = Product::find($id);
        $images = Images::where('id_product', $id)->get();
        $sizes = Size::all();
        $colors = Color::all();
        $sizeOfProduct = Size::join('product_release','size.id_size', '=' , 'product_release.id_size')->get();
        $colorOfProduct = Color::join('product_release','color.id_color', '=' , 'product_release.id_color')->get();
        $tempSize = [];
        foreach ($sizeOfProduct as $size){
            array_push($tempSize,$size->sizeName);
        }
        $tempColor = [];
        foreach ($colorOfProduct as $color){
            array_push($tempColor,$color->colorHex);
        }
        
        $sizeSelected = array_unique($tempSize);
        $colorSelected = array_unique($tempColor);
        return view('seller.product.edit_product',
        [
            'categories' => $categories, 
            'brands' => $brands, 
            'product' => $product, 
            'images' => $images,
            'sizes' => $sizes, 
            'colors' => $colors,
            'sizeSelected' => $sizeSelected,
            'colorSelected' => $colorSelected
        ]);

    }

    public function update(Request $request){
        $userID = $request->session()->get('sellerID');
        $store = Store::where('id_user', $userID)->first();

        $checkProduct = Product::where('productName',$request->productName)->first();
        if($checkProduct && $checkProduct->id_product != $request->id_product){
            \Session::put('message','This product name is already exists in your store.');
            return Redirect::back();
        }

        $product = Product::find($request->id_product);
        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->productPrice = $request->productPrice;
        $product->productAmount = $request->productAmount;
        $product->id_brand = $request->id_brand;
        $product->id_category = $request->id_category;
        $product->discount = $request->discount ?? 0;


        /** Size and color */
        if(isset($request->id_size) && isset($request->id_color)){
            foreach($request->id_size as $id_size) {
                foreach($request->id_color as $id_color) { 
                    $checkRelease = ProductRelease::where('id_product', $product->id_product)
                    ->where('id_size',$id_size)->where('id_color',$id_color)->first();
                    if(isset($checkRelease)){
                        continue;
                    }
                    $release = new ProductRelease();
                    $release->id_product = $product->id_product;
                    $release->id_size = $id_size;
                    $release->id_color = $id_color;
                    $release->save(); 
                }
            } 
        }elseif(isset($request->id_size)  && !isset($request->id_color)){
            \Session::put('message','You need select size with color.');
        }elseif(!isset($request->id_size) && isset($request->id_color)){
            \Session::put('message','You need select size with color.');
        }else{
            \Session::put('message','Something went wrong.');
        }
        /** End size and color */

        $mainImage = '';
        $imageProduct = $request->file('productImages');
        if($imageProduct){
            $images = Images::where('id_product',$product->id_product)->get();
            /** Delete old image */
            foreach ($images as $key => $image) {
                File::delete(public_path($image->url));
            $image->delete();
            }

            /** Add new image */
            foreach($request->file('productImages') as $key => $imagefile){
                $image = new Images();
                $nameProduct = $this->convert_name($request->productName);
                $nameStore = $this->convert_name($store->storeName);
                $imageName = "product-".$nameProduct.'--'.$key.'--'.date('d-m-Y-H-i').'.'.$imagefile->getClientOriginalExtension();
                $imagefile->store($imageName);
                $imagefile->move("Images/Store/$nameStore/Product/$nameProduct/", $imageName);
                $path = "Images/Store/$nameStore/Product/$nameProduct/$imageName";
                $image->url = $path;
                $image->id_product = $request->id_product;
                if($key == 0){
                    $mainImage = $path;
                    $image->save();
                }
                $image->save();
            }
            $product->productImage = $mainImage;
        }
        $product->save();
        return Redirect::to('seller/products');
    }





    public function changeStatus($id){
        $product = Product::find($id);
        if($product->productStatus == 0){
            $product->update(['productStatus'=>1]);
        }else{
            $product->update(['productStatus'=>0]);
        }
        \Session::put('message','Update status Success.');
        return Redirect::to('seller/products');
    }


    public function destroy($id){
        $product = Product::find($id);
        $release = ProductRelease::where('id_product', $product->id_product)->get();
        $images = Images::where('id_product',$product->id_product)->get();
        /** Update number category */
        $category = Category::find($product->id_category)->first();
        $currentProduct = $category->numProducts;
        $category->update(['numProducts' => $currentProduct - 1]);



        foreach ($images as $key => $image) {
            File::delete(public_path($image->url));
            $image->delete();
        }
        foreach ($release as $key => $reProduct) {
            $reProduct->delete();
        }

        $product->delete();
        \Session::put('message','Delete '.$product->productName.' product Successfully');
        return Redirect::to('seller/products');
    }




    public function convert_name($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
		return $str;
	}

    public function getNextID(){
        $latest = Product::latest()->first();
        if(empty($latest->id_product)){
            return 1;
        }
        return $latest->id_product + 1;
    }
}
