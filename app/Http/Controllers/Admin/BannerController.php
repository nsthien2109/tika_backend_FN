<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Banner;
use Redirect;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::all();
        return view('pages.banner.banners',['banners' => $banners]);
    }

    public function create(){
        return view('pages.banner.add_banner');
    }

    public function store(Request $request){
        
        $checkBanner = Banner::where('bannerName',$request->bannerName)->first();
        if($checkBanner){
            \Session::put('message','This banner is already exists.');
            return Redirect::to('admin/add-banner-page');
        }

        $banner = new Banner();
        $banner->bannerName = $request->bannerName;
        $banner->bannerDescription = $request->bannerDescription;
        $banner->bannerUrl = $request->bannerUrl;

        $image = $request->file('bannerImage');
        if($image){
            $nameBanner = str_replace(' ', '', $request->bannerName);
            $imageName = "banner-".$nameBanner.'-'.date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Banner/', $imageName);
            $path = "Images/Banner/$imageName";
            $banner->bannerImage = $path;
            $banner->save();
            \Session::put('message','Create Banner Success.');
            return Redirect::to('admin/banners');
        }
    }

    public function show($id)
    {
        $banner = Banner::find($id);
        return view('pages.banner.edit_banner', ['banner' => $banner]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request){
        $bannerId = $request->bannerId;
        $banner = Banner::find($bannerId);

        $banner->bannerName = $request->bannerName;
        $banner->bannerDescription = $request->bannerDescription;
        $image = $request->file('bannerImage');
        if($image){
            File::delete(public_path($banner->bannerImage));
            $nameBanner = str_replace(' ', '', $request->bannerName);
            $imageName = "banner-".$nameBanner.'-'.date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Banner/', $imageName);
            $path = "Images/Banner/$imageName";
            $banner->bannerImage = $path;
            $banner->save();
            \Session::put('message','Update banner Success.');
            return Redirect::to('admin/banners');
        }

        $banner->update($request->all());
            \Session::put('message','Update banner Success.');
            return Redirect::to('admin/banners');
    }

    public function destroy($id){
        $banner = Banner::find($id);
        File::delete(public_path($banner->bannerImage));
        $banner->delete();
        \Session::put('message','Delete '.$banner->bannerName.' Banner Successfully');
         return Redirect::to('admin/banners');
    }
}
