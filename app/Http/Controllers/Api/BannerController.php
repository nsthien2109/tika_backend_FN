<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{

    public function index(){
        $banner = Banner::all();
        if(!$banner) return response()->json(['message' => 'Banner not found'], 404);
        return response()->json(['message' => 'Success','data' => $banner], 200);
    }

    public function create(){}

    public function store(Request $request){
        $role = $request->user();
        if($role['role'] != 'admin') return response()->json(['message' => 'You are not allowed to this action.']); 

        $this->validate($request, [
            'bannerName' => 'required|min:3|max:25',
            'bannerDescription' => 'required|min:3',
            'bannerImage' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $checkBanner = Banner::where('bannerName',$request->bannerName)->first();
        if($checkBanner) return response()->json(['message' => "This banner name is already exists."]);

        $banner = new Banner();
        $banner->bannerName = $request->bannerName;
        $banner->bannerDescription = $request->bannerDescription;
        $banner->bannerUrl = $request->bannerUrl;

        $image = $request->file('bannerImage');
        if($image){
            $imageName = "banner-main-".date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Banner/', $imageName);
            $banner->bannerImage = $imageName;
            $banner->save();
            return response()->json([
                'message' => 'Success',
                'data' => $banner
            ]);
        }

        $banner->bannerImage = "bannerUnknown.jpg";
            $banner->save();
            return response()->json([
                'message' => 'Success',
                'data' => $banner
        ]);

    }

    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){
        $check = $request->user();
        if($check['role'] != 'admin') return response()->json(['message'=> 'You are not allowd to edit this banner']);
        $banner = Banner::find($id);
        if(!$banner) return response()->json(['message' => 'This banner does not exist.']);

        $banner->bannerName = $request->bannerName;
        $banner->bannerDescription = $request->bannerDescription;
        $banner->bannerUrl = $request->bannerUrl;


        $image = $request->file('bannerImage');
        if($image){
            File::delete(public_path("Images/Banner/".$banner->bannerImage));
            $imageName = "banner-main-".date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Banner/', $imageName);
            $banner->bannerImage = $imageName;
            $banner->save();
            return response()->json([
                'message' => 'Success',
                'data' => $banner
            ]);
        }

        $banner->update($request->all());
        return response()->json([
            'message' => 'Success',
            'data' => $banner
        ]);
    }

    public function destroy(Request $request, $id){
        $check = $request->user();
        if($check['role'] != 'admin') return response()->json(['message' => 'You are not allowed to delete this banner .']);

        $banner = Banner::find($id);
        if(!$banner) return response()->json(['message' => 'This banner does not exist.']);
        File::delete(public_path("Images/Banner/".$banner->bannerImage));
        $banner->delete();
        return response()->json(['message' => 'Success'], 200);
    }
}
