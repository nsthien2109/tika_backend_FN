<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\Images;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /** Show items  */
    public function index(){
        $products = Product::join('category','products.id_category', '=', 'category.id_category')
        ->join('brand','products.id_brand', '=', 'brand.id_brand')
        ->join('sub_category','products.id_sub_category', '=', 'sub_category.id_sub_category')
        ->paginate(15);
        if (!$products) return response()->json(['message' => 'Product not found']);
        return response()->json([
            'message' => 'Success',
            'data' => $products
        ]);
    }

    /** Create a new item logic  */
    public function store(Request $request){
        $user = $request->user();
        $store = Store::where('id_user', $user->id)->first();

        if($store->id_store == null) return response()->json(['message' => 'You don\'t have a store'], 404);

        $this->validate($request, [
            'productName' => 'required|min:3|max:25',
            'productDescription' => 'required|min:3',
            'productPrice' => 'required',
            'productAmount' => 'required',
            'productImages' => 'required|array',
            'productImages.*' => 'mimes:jpg,jpeg,png'
        ]);

        $images = $request->file('productImages');

        $product = new Product();
        $product->productName = $request->productName;
        $product->productDescription = $request->productDescription;
        $product->productPrice = $request->productPrice;
        $product->productAmount = $request->productAmount;
        $product->id_store = $store->id_store;
        $product->purchases = 0;
        $product->likes = 0;
        $product->discount = $request->discount ?? 0;
        $nextID = $this->getNextID();

        if($images){
            foreach($request->file('productImages') as $imagefile){
                $image = new Images();
                $key = random_int(15,9999);
                $imageName = "product-".$request->productName.date('d-m-Y-H-i').$key.'.'.$imagefile->getClientOriginalExtension();
                $imagefile->store($imageName);
                $imagefile->move('Images/Products/', $imageName);
                $image->url = $imageName;
                $image->id_product = $nextID;
                $image->save();
            }
        }

        $product->save();

        
        return response()->json([
            'message' => 'Success',
            'images' => $images,
            'data' => $product->id_product
        ]);
    }

    /** Show item by id */
    public function show($id){
        $product = Product::where('id_product', $id)
        ->join('category','products.id_category', '=', 'category.id_category')
        ->join('brand','products.id_brand', '=', 'brand.id_brand')
        ->join('sub_category','products.id_sub_category', '=', 'sub_category.id_sub_category')
        ->first();
        if (!$product) return response()->json(['message' => 'Product not found']);
        return response()->json([
            'message' => 'Success',
            'data' => $product
        ]);
    }

    /** Redirect to update page (apply in webserver not for api) */
    public function edit($id){}

    /** Update item logic by id */
    public function update(Request $request, $id){}

    /** Delete item logic*/
    public function destroy($id){}

    public function getNextID(){
        $latest = Product::latest()->get();
        return $latest->id_product;
    }
}
