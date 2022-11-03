@extends('layout')
@section('content')

<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Flashsale time frame Management
                    </h4>
                </div>
            </div>
            <div class="row">
                <ul class="nav responsive-tab nav-material nav-material-white">
                    <li>
                        <a class="nav-link"  href={{URL::to('admin/flashsale-frame')}}><i class="icon icon-list"></i>Frame</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#"><i
                                class="icon icon-plus-circle"></i> Add Frame</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <form id="needs-validation" novalidate method="POST" action={{URL::to('admin/update-frame')}} enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id_flashsale_frame" value={{$frame->id_flashsale_frame}}>
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="row">
                            <div class="col-md-12 mb-12">
                                <label for="validationCustom01">Frame Title</label>
                                <input type="text" class="form-control" name="title" id="validationCustom01"
                                       placeholder="Title time frame" value="{{$frame->title}}" required>
                                <div class="invalid-feedback">
                                    Please enter title time frame.
                                </div>       
                            </div>
                        </div>
                        <div class="row">                           
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom01">Start Time</label>
                                <input
                                  type="text"
                                  class="date-time-picker form-control"
                                  name="start"
                                  value="{{$frame->start}}"
                                  data-options='{"datepicker":false, "format":"H:i:s"}'
                                  placeholder="Select Start Time"
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
                                  name="end"
                                  value="{{$frame->end}}"
                                  data-options='{"datepicker":false, "format":"H:i:s"}'
                                  placeholder="Select End Time"
                                  required
                                />    
                                <div class="invalid-feedback">
                                    Please select end time.
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