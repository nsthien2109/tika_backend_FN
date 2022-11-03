<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSaleProduct;
use App\Models\FlashSaleFrame;
use App\Models\Store;
use App\Models\Product;
use Carbon\Carbon;
use Redirect;

class FlashSaleProductController extends Controller
{

    public function refresh() {
        $flashsale_all = FlashSaleProduct::join('flashsale_frame', 'flashsale_frame.id_flashsale_frame', '=','flashsale_product.id_flashsale_frame')->get();      
        $now = Carbon::now();
        foreach ($flashsale_all as $key => $flashsale) {
            $dateStart = Carbon::createFromFormat('Y-m-d H:i:s', $flashsale->sale_day.' '.$flashsale->start,'Asia/Ho_Chi_Minh');
            $dateEnd = Carbon::createFromFormat('Y-m-d H:i:s', $flashsale->sale_day.' '.$flashsale->end,'Asia/Ho_Chi_Minh');
            if($dateEnd->lt($now) == true){
                $product_sale = Product::where('id_product', '=', $flashsale->id_product)->first();
                $product_sale->update(['discount' => 0.0]);
                $flashsale->delete();
            }
            if($dateStart->gte($now) == true){
                $product_sale = Product::where('id_product', '=', $flashsale->id_product)->first();
                $product_sale->update(['discount' => $flashsale->salePercent]);
            }
        }
    }
 
    public function index(){
        $id_store = \Session::get('storeID');
        $this->refresh();
        $flashsale_product = FlashSaleProduct::join('flashsale_frame', 'flashsale_frame.id_flashsale_frame', '=','flashsale_product.id_flashsale_frame')
        ->join('products', 'products.id_product' , '=' , 'flashsale_product.id_product')
        ->where('products.id_store', $id_store)
        ->get();
        return view('seller.flashsale.flashsale_product',['flashsale_product'=>$flashsale_product]);
    }


    public function create(){
        $id_store = \Session::get('storeID');
        $products = Product::where('id_store', $id_store)->get();
        $frame = FlashSaleFrame::all();
        return view('seller.flashsale.add_flashsale_product',['products' => $products, 'frame' => $frame]);
    }

    public function store(Request $request){
        $sale_date = Carbon::parse($request->sale_day)->format('Y-m-d'); 
        $id_store = \Session::get('storeID');
        $checkProduct = FlashSaleProduct::where('id_store',$id_store)
        ->where('id_product',$request->id_product)
        ->where('sale_day', $sale_date)
        ->first();
        if(isset($checkProduct)) {
            \Session::put('message','This product already on flashsale this day.');
            return Redirect::to('seller/flashsale_product');
        }
        $flashsale_product = new FlashSaleProduct();
        $flashsale_product->id_flashsale_frame = $request->id_flashsale_frame;
        $flashsale_product->id_store = \Session::get('storeID');
        $flashsale_product->id_product = $request->id_product;
        $flashsale_product->sale_day = $sale_date;
        $flashsale_product->salePercent = $request->salePercent;
        $flashsale_product->amount = $request->amount;
        $flashsale_product->save();
        \Session::put('message','Add flashsale product Success.');
        return Redirect::to('seller/flashsale_product');
    }


    public function show($id){
        $id_store = \Session::get('storeID');
        $products = Product::where('id_store', $id_store)->get();
        $frame = FlashSaleFrame::all();
        $flashsale_product = FlashSaleProduct::find($id);
        return view('seller.flashsale.edit_flashsale_product', ['products' => $products,'flashsale_product' => $flashsale_product, 'frame' => $frame]);
    }

    public function update(Request $request){
        $id_store = \Session::get('storeID');
        $sale_date = Carbon::parse($request->sale_day)->format('Y-m-d');
        $checkProduct = FlashSaleProduct::where('id_store',$id_store)
        ->where('id_product',$request->id_product)
        ->where('sale_day', $sale_date)
        ->first();
        
        if(isset($checkProduct) && $checkProduct->id_flashsale_product  != $request->id_flashsale_product ) {
            \Session::put('message','This product already exits on flashsale this day.');
            return Redirect::to('seller/flashsale_product');
        }
        $flashsale_product = FlashSaleProduct::find($request->id_flashsale_product);
        $flashsale_product->update($request->all());
       \Session::put('message','Update Flashsale product Success.');
        return Redirect::to('seller/flashsale_product');
    }

    public function destroy($id){
        $flashsale_product = FlashSaleProduct::find($id);
        $product_sale = Product::where('id_product', '=', $flashsale_product->id_product)->first();
        $product_sale->update(['discount' => 0.0]);
        $flashsale_product->delete();
        \Session::put('message','Delete flashsale product Successfully');
         return Redirect::to('seller/flashsale_product');
    }
}
