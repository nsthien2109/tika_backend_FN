<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Product;
use Redirect;

class SubCategoryController extends Controller
{
    public function index(){
        $subCategory = SubCategory::join('category', 'sub_category.id_category', '=', 'category.id_category')->get();
        return view('pages.sub_category.sub_categories',['sub_categories'=>$subCategory]);
    }

    public function create(){
        $categories = Category::all();
        return view('pages.sub_category.add_sub_category',['categories' => $categories]);
    }

    public function store(Request $request){
        $checkSubCategory = SubCategory::where('subCategoryName',$request->subCategoryName)->first();
        if($checkSubCategory){
            \Session::put('message','This sub category is already exists.');
            return Redirect::to('admin/add-sub-category-page');
        }

        $subCategory = new SubCategory();
        $subCategory->subCategoryName = $request->subCategoryName;
        $subCategory->id_category = $request->id_category;
        $subCategory->status = $request->status;
        $subCategory->numProducts = 0;

        $subCategory->save();
        \Session::put('message','Create sub category Success.');
        return Redirect::to('admin/sub_categories');
    }

    public function show($id){
        $subCategory = SubCategory::find($id);
        $categories = Category::all();
        return view('pages.sub_category.edit_sub_category', ['subCategory' => $subCategory, 'categories' => $categories]);
    }

    public function update(Request $request){
        $subId = $request->subId;
        $subCategory = SubCategory::find($subId);
        $subCategory->id_category = $request->id_category;
        $subCategory->subCategoryName = $request->subCategoryName;
        $subCategory->update($request->all());
            \Session::put('message','Update sub category Success.');
            return Redirect::to('admin/sub_categories');
    }

    public function changeStatus($id){
        $sub = SubCategory::find($id);
        if($sub->status == 0){
            $sub->update(['status'=> 1]);
        }else{
            $sub->update(['status'=>0]);
        }
        \Session::put('message','Update sub category Success.');
        return Redirect::to('admin/sub_categories');
    }

    public function destroy($id){
        $sub = SubCategory::find($id);
        $products = Product::where('id_sub_category',$id)->get();
        foreach ($products as $key => $pr) {
            $pr->delete();
        }
        $sub->delete();
        \Session::put('message','Delete '.$sub->subCategoryName.' Banner Successfully');
        return Redirect::to('admin/sub_categories');
    }
}
