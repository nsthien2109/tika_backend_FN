<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSaleProduct;
use App\Models\FlashSaleFrame;
use App\Models\Store;
use App\Models\Product;
use Carbon\Carbon;

class FlashSaleController extends Controller
{
    public function index(){
        
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

        $flashsale_product = FlashSaleProduct::join('flashsale_frame', 'flashsale_frame.id_flashsale_frame', '=','flashsale_product.id_flashsale_frame')
        ->join('products', 'products.id_product' , '=' , 'flashsale_product.id_product')->get(); 

        return response()->json([
            'message' => 'Success',
            'data' => $flashsale_product
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
