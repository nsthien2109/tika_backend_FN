<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Brand;
use Redirect;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('pages.brand.brands',['brands' => $brands]);
    }
    public function create(){
        return view('pages.brand.add_brand');
    }
    public function store(Request $request){
        
        $checkBrand = Brand::where('brandName',$request->brandName)->first();
        if($checkBrand){
            \Session::put('message','This brand is already exists.');
            return Redirect::to('admin/add-brand-page');
        }

        $brand = new Brand();
        $brand->brandName = $request->brandName;
        $brand->brandDescription = $request->brandDescription;
        $brand->brandStatus = $request->brandStatus;

        $image = $request->file('brandImage');
        if($image){
            $nameBrand = str_replace(' ', '', $request->brandName);
            $imageName = "brand-".$nameBrand.'-'.date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Brand/', $imageName);
            $path = "Images/Brand/$imageName";
            $brand->brandImage = $path;
            $brand->save();
            \Session::put('message','Create brand Success.');
            return Redirect::to('admin/brands');
        }
    }
    public function show($id)
    {
        $brand = Brand::find($id);
        return view('pages.brand.edit_brand', ['brand' => $brand]);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request){
        $brandId = $request->brandId;
        $brand = Brand::find($brandId);

        $brand->brandName = $request->brandName;
        $brand->brandDescription = $request->brandDescription;
        $image = $request->file('brandImage');
        if($image){
            File::delete(public_path($brand->brandImage));
            $nameBrand = str_replace(' ', '', $request->brandName);
            $imageName = "brand-".$nameBrand.'-'.date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Brand/', $imageName);
            $path = "Images/Brand/$imageName";
            $brand->brandImage = $path;
            $brand->save();
            \Session::put('message','Update brand Success.');
            return Redirect::to('admin/brands');
        }

        $brand->update($request->all());
            \Session::put('message','Update brand Success.');
            return Redirect::to('admin/brands');
    }

    public function changeStatus($id)
    {
        $brand = Brand::find($id);
        if($brand->brandStatus == 0){
            $brand->update(['brandStatus'=>1]);
        }else{
            $brand->update(['brandStatus'=>0]);
        }
        \Session::put('message','Update brand Success.');
        return Redirect::to('admin/brands');
    }


    public function destroy($id){
        $brand = Brand::find($id);
        File::delete(public_path($brand->brandImage));
        $brand->delete();
        \Session::put('message','Delete '.$brand->bannerName.' brand Successfully');
         return Redirect::to('admin/brands');
    }
}
