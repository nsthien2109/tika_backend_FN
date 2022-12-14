<?php

namespace App\Http\Controllers\Seller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
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
        $subCategories = SubCategory::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('seller.product.add_product',
        ['categories' => $categories, 'brands' => $brands,'sizes' => $sizes, 'colors' => $colors, 'subCategories' => $subCategories]);
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
        $product->id_sub_category = $request->id_sub;
        $product->discount = $request->discount ?? 0;
        $nextID = $this->getNextID();

        /** Update number category */
        $category = Category::find($request->id_category)->first();
        $currentProduct = $category->numProducts;
        $category->update(['numProducts' => $currentProduct + 1]);

        /** Size and color */
        if(isset($request->id_size) && isset($request->id_color)){
            foreach($request->id_size as $id_size) {
                $release = new ProductRelease();
                $release->id_product = $nextID;
                $release->id_size = $id_size;
                $release->save();       
            }
            foreach($request->id_color as $id_color) {  
                $release = new ProductRelease();
                $release->id_product = $nextID;
                $release->id_color = $id_color;
                $release->save();       
            } 
        }elseif(isset($request->id_size) && !isset($request->id_color)){
            foreach($request->id_size as $id_size) {
                    $release = new ProductRelease();
                    $release->id_product = $nextID;
                    $release->id_size = $id_size;
                    $release->save();       
                }
        }elseif(!isset($request->id_size) && isset($request->id_color)){
            foreach($request->id_color as $id_color) {  
                $release = new ProductRelease();
                $release->id_product = $nextID;
                $release->id_color = $id_color;
                $release->save();       
            }
        }else{
            $release = new ProductRelease();
            $release->id_product = $nextID;
            $release->id_size = NULL;
            $release->id_color = NULL;
            $release->save(); 
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
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'a', $str);
		$str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'e', $str);
		$str = preg_replace("/(??|??|???|???|??)/", 'i', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'o', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'u', $str);
		$str = preg_replace("/(???|??|???|???|???)/", 'y', $str);
		$str = preg_replace("/(??)/", 'd', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'A', $str);
		$str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'E', $str);
		$str = preg_replace("/(??|??|???|???|??)/", 'I', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'O', $str);
		$str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'U', $str);
		$str = preg_replace("/(???|??|???|???|???)/", 'Y', $str);
		$str = preg_replace("/(??)/", 'D', $str);
		$str = preg_replace("/(\???|\???|\???|\???|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
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

    public function select_subcategory(Request $request)
    {
      $data = $request->all();
      if ($data['action']) {
        $out_put ='';
        if ($data['action'] == "category") {
          $sub_category = SubCategory::where('id_category', $data['id_category'])->get();
          $out_put .= '<option value="">Select sub category</option>';
          foreach ($sub_category as $key => $sub) {
          $out_put .= '<option value="'.$sub->id_sub_category.'">'.$sub->subCategoryName.'</option>';
        }
        }
    }
    echo $out_put;
}
}
