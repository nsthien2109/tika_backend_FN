@extends('seller_layout')
@section('content')

<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Edit Product
                    </h4>
                </div>
            </div>
            <div class="row">
                <ul class="nav responsive-tab nav-material nav-material-white">
                    <li>
                        <a class="nav-link"  href={{URL::to('seller/products')}}><i class="icon icon-list"></i>All Products</a>
                    </li>
                    <li>
                        <a class="nav-link"  href={{URL::to('seller/add-product-page')}}><i
                                class="icon icon-plus-circle"></i> Add New Product</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#"><i
                                class="icon icon-plus-circle"></i> Edit Product</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <form action={{URL::to('seller/update-product')}} id="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_product" value={{$product->id_product}}>
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Product Name</label>
                                <input type="text" class="form-control" name="productName" id="validationCustom01"
                                      value="{{$product->productName}}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="brand">Brand</label>
                                <select id="brand" class="custom-select form-control" name="id_brand" disabled required>
                                    <option value="">Select Product Category</option>
                                    @foreach($brands as $brand)
                                        @if($brand->id_brand == $product->id_brand)
                                        <option selected value={{$brand->id_brand}}>{{$brand->brandName}}</option>
                                        @else
                                        <option value={{$brand->id_brand}}>{{$brand->brandName}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid brand.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category">Category</label>
                                <!--<input type="text" class="form-control"  placeholder="Mobile Phones" required>-->
                                <select id="category" class="custom-select form-control" name="id_category" disabled required>
                                    <option value="">Select Product Category</option>
                                    @foreach($categories as $category)
                                        @if($category->id_category == $product->id_category)
                                        <option selected value={{$category->id_category}}>{{$category->categoryName}}</option>
                                        @else
                                        <option value={{$category->id_category}}>{{$category->categoryName}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid category.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">Price</label>
                                <input type="text" class="form-control" name="productPrice" id="validationCustom04" value="{{$product->productPrice}}"
                                       required>
                                <div class="invalid-feedback">
                                    Please provide a valid price.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" name="productAmount" id="amount" value="{{$product->productAmount}}" required>
                                <div class="invalid-feedback">
                                    Please provide a valid amount.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card-title">Select Size</div>
                                <select class="select2 custom-select form-control" name="id_size[]" multiple="multiple">
                                @foreach($sizes as $size)
                                    <option value={{$size->id_size}}>{{$size->sizeName}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card-title">Select Colors</div>
                                <select class="select2 custom-select form-control" name="id_color[]" multiple="multiple">
                                @foreach($colors as $color)
                                <option value={{$color->id_color}}>{{$color->colorName}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card-title">Your Product size</div>
                                @foreach($sizeSelected as $sizeProduct)
                                    <strong class="pink-text">{{$sizeProduct}}&nbsp;&nbsp;</strong>
                                @endforeach
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card-title">Your Product Color</div>
                                @foreach($colorSelected as $colorProduct)
                                <span class="avatar-letter avatar-sm circle" style="background-color:#{{$colorProduct}};"></span>
                                @endforeach
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="discount">Product Discount</label>
                                <input type="text" class="form-control" name="discount" id="discount" value="{{$product->discount}}">
                            </div>                         
                        </div>

                        <div class="form-group">
                            <label for="productDetails">Product Description</label>
                            <textarea class="form-control p-t-40 editor" name="productDescription" id="productDetails" rows="10" required>{{$product->productDescription}}</textarea>
                            <div class="invalid-feedback">
                                Please provide a product details.
                            </div>
                        </div>

                        <div class="card">
                            <h6 class="card-header white">Select All Product Image</h6>
                            <div class="card-body text-success">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="file" name="productImages[]" class="" id="customControlValidation1" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                        <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (function () {
                                "use strict";
                                window.addEventListener("load", function () {
                                    var form = document.getElementById("needs-validation");
                                    form.addEventListener("submit", function (event) {
                                        if (form.checkValidity() == false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add("was-validated");
                                        var editorElement = document.getElementById("productDetails");
                                        if (editorElement.value == '') {
                                            editorElement.parentNode.classList.add("is-invalid");
                                            editorElement.parentNode.classList.remove("is-valid");
                                        } else {
                                            editorElement.parentNode.classList.remove("is-invalid");
                                            editorElement.parentNode.classList.add("is-valid");
                                        }

                                    }, false);
                                }, false);
                            }());
                        </script>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card mt-4">
                            <h6 class="card-header white">Your product Images</h6>
                            <div class="card-body text-success">
                                @foreach($images as $key => $image)
                                    <img class="card rounded mt-3" src={{env('MY_DOMAIN').'/'.$image->url}} alt="Card image cap">
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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