<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlashSaleFrame;
use Redirect;

class FlashSaleFrameController extends Controller
{
    public function index(){
        $time_frame = FlashSaleFrame::all();
        return view('pages.flash_frame.flash_frame',['time_frame'=>$time_frame]);
    }
    public function create(){
        return view('pages.flash_frame.add_frame');
    }
    public function store(Request $request){
        $checkFrame = FlashSaleFrame::where('title',$request->title)->first();
        if(isset($checkFrame)) {
            \Session::put('message','This frame already exits.');
            return Redirect::to('admin/flashsale-frame');
        }
        $frame = new FlashSaleFrame();
        $frame->title = $request->title;
        $frame->start = $request->start;
        $frame->end = $request->end;
        $frame->save();
        \Session::put('message','Create Time Frame Success.');
        return Redirect::to('admin/flashsale-frame');
    }

    public function show($id){
        $frame = FlashSaleFrame::find($id);
        return view('pages.flash_frame.edit_frame', ['frame' => $frame]);
    }

    public function update(Request $request){
        $checkFrame = FlashSaleFrame::where('title',$request->title)->first();
        if(isset($checkFrame) && $checkFrame->id_flashsale_frame != $request->id_flashsale_frame) {
            \Session::put('message','This frame already exits.');
            return Redirect::to('admin/flashsale-frame');
        }
        $frame = FlashSaleFrame::find($request->id_flashsale_frame);
        $frame->update($request->all());
       \Session::put('message','Update Frame Time Success.');
        return Redirect::to('admin/flashsale-frame');
    }

    public function destroy($id){
        $frame = FlashSaleFrame::find($id);
        $frame->delete();
        \Session::put('message','Delete '.$frame->title.' frame Successfully');
         return Redirect::to('admin/flashsale-frame');
    }
}
