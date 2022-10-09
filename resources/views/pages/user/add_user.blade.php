@extends('layout')
@section('content')

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Users
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href={{URL::to('admin/users')}}><i class="icon icon-home2"></i>All Users</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#"><i class="icon icon-plus-circle"></i> Add New User</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    <form action={{URL::to('admin/add-user')}} method="POST">
                        {{ csrf_field() }}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About User</h5>
                                <div class="form-row">
                                    <div class="col-md-8">                               
                                        <div class="form-row">
                                            <div class="form-group col-6 m-0">
                                                <label for="cnic" class="col-form-label s-12"><i class="icon-user-secret mr-2"></i>FIRST NAME</label>
                                                <input id="cnic" name="firstName" placeholder="Enter User First Name" class="form-control r-0 light s-12" type="text">
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                <label for="dob" class="col-form-label s-12"><i class="icon-pencil mr-2"></i>LAST NAME</label>
                                                <input id="dob" name="lastName" placeholder="Enter User Last Name" class="form-control r-0 light s-12" type="text">
                                            </div>

                                            <div class="form-group col-6 m-0">
                                                <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>Email</label>
                                                <input id="email" name="email" placeholder="user@email.com" class="form-control r-0 light s-12 " type="text">
                                            </div>
        
                                            <div class="form-group col-6 m-0">
                                                <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Phone</label>
                                                <input id="phone" name="phone" placeholder="Enter user phone" class="form-control r-0 light s-12 " type="text">
                                            </div>

                                        </div>
                       
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        <input hidden id="file" name="file"/>
                                        <div class="dropzone dropzone-file-area pt-4 pb-4" id="fileUpload">
                                            <div class="dz-default dz-message">
                                                <span>Select user avatar</span>
                                                <strong>You can skip this step</strong>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 m-0">
                                        <label for="address"  class="col-form-label s-12">PASSWORD</label>
                                        <input type="text" name="password" class="form-control r-0 light s-12" id="address"
                                               placeholder="Enter Password">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <h5 class="card-title">ROLE ACCOUNT</h5>
                                <div class="form-row">
                                    <div class="form-group col-5 m-0">
                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="role">
                                            <option value="2">User</option>
                                            <option value="0">Administator</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save Data</button>
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