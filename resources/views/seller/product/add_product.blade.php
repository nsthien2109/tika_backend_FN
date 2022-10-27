@extends('seller_layout')
@section('content')

<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Product
                    </h4>
                </div>
            </div>
            <div class="row">
                <ul class="nav responsive-tab nav-material nav-material-white">
                    <li>
                        <a class="nav-link"  href={{URL::to('seller/products')}}><i class="icon icon-list"></i>All Products</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#"><i
                                class="icon icon-plus-circle"></i> Add New Product</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <form id="needs-validation" novalidate method="POST" action={{URL::to('seller/add-product')}} enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Product Name</label>
                                <input type="text" class="form-control" name="productName" id="validationCustom01"
                                       placeholder="Product Name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="brand">Brand</label>
                                <select id="brand" class="custom-select form-control" name="id_brand" required>
                                    <option value="">Select Product Brand</option>
                                    @foreach($brands as $brand)
                                    <option value={{$brand->id_brand}}>{{$brand->brandName}}</option>
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
                                <select class="custom-select form-control category choose" name="id_category" id="category" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value={{$category->id_category}}>{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid category.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category">Sub Category</label>
                                <!--<input type="text" class="form-control"  placeholder="Mobile Phones" required>-->
                                <select id="subcategory" class="custom-select form-control subcategory" name="id_sub" >
                                    <option value="">Select Sub Category</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid category.
                                </div>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="validationCustom04">Price</label>
                                <input type="text" class="form-control" name="productPrice" id="validationCustom04" placeholder="$"
                                       required>
                                <div class="invalid-feedback">
                                    Please provide a valid price.
                                </div>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" name="productAmount" id="amount" required>
                                <div class="invalid-feedback">
                                    Please provide a valid amount.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="discount">Product Discount</label>
                                <input type="text" class="form-control" name="discount" id="discount"
                                       placeholder="Product Discount">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label>
                                <!--<input type="text" class="form-control"  placeholder="Mobile Phones" required>-->
                                <select id="status" class="custom-select form-control" name="productStatus" required>
                                    <option value="1">Active</option>
                                    <option value="0">Hide</option>

                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid status.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card-title">Select Size</div>
                                <select class="select2 custom-select form-control" name="id_size[]" multiple="multiple" >
                                @foreach($sizes as $size)
                                <option value={{$size->id_size}}>{{$size->sizeName}}</option>
                                @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid size.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card-title">Select Colors</div>
                                <select class="select2 custom-select form-control" name="id_color[]" multiple="multiple" >
                                @foreach($colors as $color)
                                <option value={{$color->id_color}}>{{$color->colorName}}</option>
                                @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid color.
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="productDetails">Product Description</label>
                            <textarea class="form-control p-t-40 editor" name="productDescription" id="productDetails"
                                      placeholder="Write Something..." rows="17" required></textarea>
                            <div class="invalid-feedback">
                                Please provide a product details.
                            </div>
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
                            <h6 class="card-header white">Images Product</h6>
                            <div class="card-body text-success">

                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="file" name="productImages[]" class="" id="customControlValidation1" required multiple>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <h6 class="card-header white">Publish Box</h6>                            
                            <div class="card-footer bg-transparent">
                                <button class="btn btn-primary" type="submit">Save</button>
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