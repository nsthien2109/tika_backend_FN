<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Color;
use Redirect;

class UnitController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        $colors = Color::all();
        return view('pages.unit.units',['sizes' => $sizes, 'colors' => $colors]);
    }

    public function store_size(Request $request){
        $checkSize = Size::where('sizeName',$request->sizeName)->first();
        if($checkSize){
            \Session::put('message','This size is already exists.');
            return Redirect::to('admin/units');
        }
        $size = new Size();
        $size->sizeName = $request->sizeName;
        $size->save();
        \Session::put('message','Create Size Success.');
        return Redirect::to('admin/units');
    }

    public function store_color(Request $request){
        $checkColor = Color::where('colorName',$request->colorName)->first();
        if($checkColor){
            \Session::put('message','This color is already exists.');
            return Redirect::to('admin/units');
        }

        if(strlen($request->colorHex) < 6 || strlen($request->colorHex) % 2 != 0){
            \Session::put('message','This hex color is not valid.');
            return Redirect::to('admin/units');
        }
        $color = new Color();
        $color->colorName = $request->colorName;
        $color->colorHex = $request->colorHex;
        $color->save();
        \Session::put('message','Create Color Success.');
        return Redirect::to('admin/units');
    }

    public function destroy_size($id){
        $size = Size::find($id);
        $size->delete();
        \Session::put('message','Delete '.$size->sizeName.' size Successfully');
         return Redirect::to('admin/units');
    }

    public function destroy_color($id){
        $color = Color::find($id);
        $color->delete();
        \Session::put('message','Delete '.$color->colorName.' color Successfully');
         return Redirect::to('admin/units');
    }
}
