@extends('layout')
@section('content')

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Sub Category
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href={{URL::to('admin/sub_categories')}}><i class="icon icon-home2"></i>All Sub Categories</a>
                    </li>
                    <li>
                        <a class="nav-link"  href={{URL::to('admin/add-sub-category-page')}} ><i class="icon icon-plus-circle"></i> Add New Sub Category</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#edit" ><i class="icon icon-plus-circle"></i> Edit Sub Category</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    <form action={{URL::to('admin/update-sub-category')}} method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="subId" value={{$subCategory->id_sub_category}}>
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About Sub Category</h5>
                                <div class="form-row">
                                    <div class="col-md-12">

                                        <div class="col-md-12 mb-12 px-0 mt-2">
                                            <label for="brand">CATEGORY</label>
                                            <select id="brand" required class="custom-select form-control" name="id_category">
                                                @foreach ($categories as $category)
                                                    @if($category->id_category == $subCategory->id_category)
                                                        <option selected value={{$category->id_category}}>{{$category->categoryName}}</option>
                                                    @else
                                                        <option value={{$category->id_category}}>{{$category->categoryName}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">SUBCATEGORY NAME</label>
                                            <input id="name" value="{{$subCategory->subCategoryName}}" name="subCategoryName" class="form-control r-0 light s-12 " type="text" required>
                                        </div>
                                    </div>
                                  
                                </div>                         
                            </div>
                            <hr>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    </div>
    <?php
        $message = Session::get('message');
        if (isset($message)) {
            echo 
            '<div class="toast"
                data-title="Hi, admin !"
                data-message="'.$message.'"
                data-position-class="toast-bottom-right"
                data-type="error">
            </div>';
            Session::put('message',null);
    }?>
</div>

@endsection