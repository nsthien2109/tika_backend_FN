<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Category;
use Redirect;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('pages.category.categories',['categories'=>$categories]);
    }
    public function create(){
        return view('pages.category.add_category');
    }
    public function store(Request $request){
        
        $checkCategory = Category::where('categoryName',$request->categoryName)->first();
        if($checkCategory){
            \Session::put('message','This category is already exists.');
            return Redirect::to('admin/add-category-page');
        }

        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
        $category->numProducts = 0;

        $image = $request->file('categoryImage');
        if($image){
            $nameCate = str_replace(' ', '', $request->categoryName);
            $imageName = "category-".$nameCate.'-'.date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Category/', $imageName);
            $path = "Images/Category/$imageName";
            $category->categoryImage = $path;
            $category->save();
            \Session::put('message','Create category Success.');
            return Redirect::to('admin/categories');
        }
    }
    public function show($id){
        $category = Category::find($id);
        return view('pages.category.edit_category', ['category' => $category]);
    }
    public function edit($id)
    {
        
    }
    public function update(Request $request){
        $categoryId = $request->categoryId;
        $category = Category::find($categoryId);

        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
        $image = $request->file('categoryImage');
        if($image){
            File::delete(public_path($category->categoryImage));
            $nameCate = str_replace(' ', '', $request->categoryName);
            $imageName = "category-".$nameCate.'-'.date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Category/', $imageName);
            $path = "Images/Category/$imageName";
            $category->categoryImage = $path;
            $category->save();
            \Session::put('message','Update category Success.');
            return Redirect::to('admin/categories');
        }

        $category->update($request->all());
            \Session::put('message','Update category Success.');
            return Redirect::to('admin/categories');
    }

    
    public function destroy($id){
        $category = Category::find($id);
        File::delete(public_path($category->categoryImage));
        $category->delete();
        \Session::put('message','Delete '.$category->categoryName.' Category Successfully');
         return Redirect::to('admin/categories');
    }
}
