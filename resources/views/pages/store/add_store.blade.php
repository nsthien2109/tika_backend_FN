@extends('layout')
@section('content')

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Store
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href={{URL::to('stores')}}><i class="icon icon-home2"></i>All Stores</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#" ><i class="icon icon-plus-circle"></i> Add New Stores</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    <form action={{URL::to('admin/add-store')}} method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About Store</h5>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">STORE NAME</label>
                                            <input id="name" name="storeName" placeholder="Enter Store Name" class="form-control r-0 light s-12 " type="text" required>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-12 m-0">
                                                <label for="cnic" class="col-form-label s-12"><i class="icon-fingerprint"></i>STORE WEBSITE</label>
                                                <input id="cnic" name="storeWebsite" placeholder="Enter Store Website" class="form-control r-0 light s-12 date-picker" type="text">
                                            </div>                                           
                                        </div>
                                    </div>                               
                                </div>

                                <div class="form-row mt-1">
                                    <div class="form-group col-4 m-0">
                                        <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>Email</label>
                                        <input id="email" name="storeEmail" placeholder="store@email.com" class="form-control r-0 light s-12 " type="text" required>
                                    </div>

                                    <div class="form-group col-4 m-0">
                                        <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Phone</label>
                                        <input id="phone" name="storePhone" placeholder="Enter phone number store" class="form-control r-0 light s-12 " type="text" required>
                                    </div>
                                    <div class="form-group col-4 m-0">
                                        <label for="mobile" class="col-form-label s-12"><i class="icon-mobile-phone mr-2"></i>City</label>
                                        <input id="mobile" name="storeCity" placeholder="Enter store city" class="form-control r-0 light s-12 " type="text" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-9 m-0">
                                        <label for="address"  class="col-form-label s-12">Address</label>
                                        <input type="text" name="storeAddress" class="form-control r-0 light s-12" id="address" required
                                               placeholder="Enter Address">
                                    </div>

                                    <div class="form-group col-3 m-0">
                                        <label for="inputCity" class="col-form-label s-12">Country</label>
                                        <input type="text" name="storeCountry" class="form-control r-0 light s-12" id="inputCity" required>
                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="productDetails">Store Description</label>
                                    <textarea class="form-control p-t-40 editor" name="storeDescription"
                                              placeholder="Write Description..." rows="17" required></textarea>            
                                </div>
                                <hr>
                                <div class="form-row mt-1">
                                    <div class="form-group col-6 m-0">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Owner</label>
                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="id_user" id="inlineFormCustomSelectPref">
                                            <option value="-1">Choose Owner</option>
                                            @foreach($users as $user)
                                            <option value={{$user->id}}>{{$user->firstName.'  '.$user->lastName.' -- '.$user->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6 m-0">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Status</label>
                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="storeStatus" id="inlineFormCustomSelectPref" >
                                            <option value="1">Active</option>
                                            <option value="0">Hide</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row mt-2">
                                    <div class="form-group col-6 m-0">
                                        <label for="name" class="col-form-label s-12">STORE AVATAR</label>
                                        <div class="custom-file">
                                            <input type="file" name="storeAvatar" class="custom-file-input" id="validatedCustomFile">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                    </div>  
                                    <div class="form-group col-6 m-0">
                                        <label for="name" class="col-form-label s-12">STORE BACKGROUND</label>
                                        <div class="custom-file">
                                            <input type="file" name="storeBackgroundImage" class="custom-file-input" id="validatedCustomFile">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
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