@extends('layout')
@section('content')

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        brand
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href={{URL::to('admin/brands')}}><i class="icon icon-home2"></i>All Brand</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#" ><i class="icon icon-plus-circle"></i> Add New Brand</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    <form action={{URL::to('admin/add-brand')}} method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About Brand</h5>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">BRAND NAME</label>
                                            <input id="name" name="brandName" placeholder="Enter brand Name" class="form-control r-0 light s-12 " type="text" required>
                                        </div>

                                        <div class="form-group m-0">
                                            <label for="desc" class="col-form-label s-12">BRAND DESCRIPTION</label>
                                            <input id="desc" name="brandDescription" placeholder="Enter brand Description" class="form-control r-0 light s-12 " type="text" required>
                                        </div>

                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">BRAND IMAGE</label>
                                            <div class="custom-file">
                                                <input type="file" name="brandImage" class="custom-file-input" id="validatedCustomFile" required>
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                        </div>  
                                        
                                        <div class="form-group m-0">
                                            <label for="status" class="col-form-label s-12">STATUS</label>
                                            <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="brandStatus">
                                                <option value="1">Active</option>
                                                <option value="0">Hide</option>
                                            </select>
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