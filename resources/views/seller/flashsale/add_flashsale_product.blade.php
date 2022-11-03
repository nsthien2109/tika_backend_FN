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
                        <a class="nav-link"  href={{URL::to('seller/flashsale_product')}}><i class="icon icon-list"></i>All Flashsale Products</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#"><i
                                class="icon icon-plus-circle"></i> Add New Flashsale Product</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <form id="needs-validation" novalidate method="POST" action={{URL::to('seller/add-flashsale-product')}} enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="brand">Product</label>
                                <select id="brand" class="custom-select form-control" name="id_product" required>
                                    <option value="">Select Product Sale</option>
                                    @foreach($products as $product)
                                    <option value={{$product->id_product}}>{{$product->productName}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid product.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category">Time Frame</label>
                                <!--<input type="text" class="form-control"  placeholder="Mobile Phones" required>-->
                                <select class="custom-select form-control category choose" name="id_flashsale_frame" id="category" required>
                                    <option value="">Select Time Frame</option>
                                    @foreach($frame as $fr)
                                    <option value={{$fr->id_flashsale_frame}}>{{$fr->title}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid frame time.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">End Time</label>
                                <input
                                  type="text"
                                  class="date-time-picker form-control"
                                  name="sale_day"
                                  data-options='{"timepicker":false, "format":"d-m-Y"}'
                                  placeholder="Select Day"
                                  required
                                />    
                                <div class="invalid-feedback">
                                    Please select day.
                                </div>       
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="amount">Amount</label>
                                <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" required>
                                <div class="invalid-feedback">
                                    Please provide a valid amount.
                                </div>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="discount">Sale Percent</label>
                                <input type="text" class="form-control" name="salePercent" id="discount"
                                       placeholder="Sale Percent" required>
                                <div class="invalid-feedback">
                                    Please provide a valid percent sale.
                                </div>
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