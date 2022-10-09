<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller{
    /** Display a listing of the resource.*/
    public function index(){
        $category = Category::all();
        if (!isset($category)) return response()->json(['message' => 'Category not found']);
        return response()->json([
            'message' => 'Success',
            'data' => $category
        ]);
    }

    /** Show the form for creating a new resource.*/
    public function create(){}

    /** Store a newly created resource in storage.*/
    public function store(Request $request){
        $role = $request->user();
        if($role['role'] != 'admin') return response()->json(['message' => 'You are not allowed to this action.']); 

        $this->validate($request, [
            'categoryName' => 'required|min:3|max:25',
            'categoryDescription' => 'required|min:3',
            'categoryImage' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        
        $checkCategory = Category::where('categoryName',$request->categoryName)->first();
        if($checkCategory) return response()->json(['message' => "This category is already exists."]);

        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
        $category->numProducts = 0;

        $image = $request->file('categoryImage');
        if($image){
            $imageName = "category-main-".date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Category/', $imageName);
            $category->categoryImage = $imageName;
            $category->save();
            return response()->json([
                'message' => 'Success',
                'data' => $category
            ]);
        }

        $category->categoryImage = "categoryUnknown.jpg";
            $category->save();
            return response()->json([
                'message' => 'Success',
                'data' => $category
        ]);
    }

    /** Display the specified resource.*/
    public function show($id){}

    /** Show the form for editing the specified resource.*/
    public function edit($id){}

    /** Update the specified resource in storage */
    public function update(Request $request, $id){
        $check = $request->user();
        if($check['role'] != 'admin') return response()->json(['message'=> 'You are not allowd to edit this category']);
        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'This category does not exist.']);

        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;


        $image = $request->file('categoryImage');
        if($image){
            File::delete(public_path("Images/Category/".$category->categoryImage));
            $imageName = "category-main-".date('d-m-Y-H-i').'.'.$image->getClientOriginalExtension();
            $image->store($imageName);
            $image->move('Images/Category/', $imageName);
            $category->categoryImage = $imageName;
            $category->save();
            return response()->json([
                'message' => 'Success',
                'data' => $category
            ]);
        }

        $category->update($request->all());
        return response()->json([
            'message' => 'Success',
            'data' => $category
        ]);
    }

    /** Remove the specified resource from storage. */
    public function destroy(Request $request, $id){
        $check = $request->user();
        if($check['role'] != 'admin') return response()->json(['message' => 'You are not allowed to delete this category.']);

        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'This category does not exist.']);
        File::delete(public_path("Images/Category/".$category->categoryImage));
        $category->delete();
        return response()->json(['message' => 'Success'], 200);
    }
}
