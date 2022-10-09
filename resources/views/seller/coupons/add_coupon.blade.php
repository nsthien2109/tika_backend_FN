@extends('seller_layout')
@section('content')

<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Coupon Management
                    </h4>
                </div>
            </div>
            <div class="row">
                <ul class="nav responsive-tab nav-material nav-material-white">
                    <li>
                        <a class="nav-link"  href={{URL::to('seller/coupons')}}><i class="icon icon-list"></i>Coupons</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#"><i
                                class="icon icon-plus-circle"></i> Add Coupon</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <form id="needs-validation" novalidate method="POST" action={{URL::to('seller/add-coupon')}} enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom01">Coupon Name</label>
                                <input type="text" class="form-control" name="couponName" id="validationCustom01"
                                       placeholder="Coupon Name" required>
                                <div class="invalid-feedback">
                                    Please enter coupon name.
                                </div>       
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Coupon Code</label>
                                <input type="text" class="form-control" name="couponCode" id="validationCustom01"
                                       placeholder="Coupon Code" maxlength="15" minlength="6" required>
                                <div class="invalid-feedback">
                                    Please enter coupon code.
                                </div>       
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Coupon Percent</label>
                                <input type="text" class="form-control" name="couponPercent" id="validationCustom01"
                                       placeholder="Coupon Percent" required>
                                <div class="invalid-feedback">
                                    Please enter persen value coupon.
                                </div>       
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Coupon Turns</label>
                                <input type="text" class="form-control" name="couponTurns" id="validationCustom01"
                                       placeholder="Coupon Turns" required>
                                <div class="invalid-feedback">
                                    Please enter address district.
                                </div>       
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Start Time</label>
                                <input
                                  type="text"
                                  class="date-time-picker form-control"
                                  name="start_time"
                                  placeholder="Select Start Time Coupon Event"
                                  required
                                />    
                                <div class="invalid-feedback">
                                    Please select start time.
                                </div>       
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">End Time</label>
                                <input
                                  type="text"
                                  class="date-time-picker form-control"
                                  name="end_time"
                                  placeholder="Select End Time Coupon Event"
                                  required
                                />    
                                <div class="invalid-feedback">
                                    Please select end time.
                                </div>       
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="amount">Coupon Description</label>
                                <input type="text" class="form-control" name="couponDescription" id="amount"
                                placeholder="Enter a coupon description"
                                required>
                                <div class="invalid-feedback">
                                    Please enter coupon description.
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
                            <h6 class="card-header white">Publish</h6>                            
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