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
                        <a class="nav-link"  href={{URL::to('admin/stores')}}><i class="icon icon-home2"></i>All Stores</a>
                    </li>
                    <li>
                        <a class="nav-link"  href={{URL::to('admin/add-store-page')}} ><i class="icon icon-plus-circle"></i> Add New Stores</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#" ><i class="icon icon-plus-circle"></i> Edit Stores</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    <form action={{URL::to('admin/update-store')}} method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card no-b  no-r">
                            <input type="hidden" name="storeId" value="{{$store->id_store}}">
                            <div class="card-body">
                                <h5 class="card-title">About Store</h5>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">STORE NAME</label>
                                            <input id="name" name="storeName" value="{{$store->storeName}}" class="form-control r-0 light s-12 " type="text" required>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-12 m-0">
                                                <label for="cnic" class="col-form-label s-12"><i class="icon-fingerprint"></i>STORE WEBSITE</label>
                                                @isset($store->storeWebsite)
                                                    <input id="cnic" name="storeWebsite" value={{$store->storeWebsite}} class="form-control r-0 light s-12 date-picker" type="text">
                                                @endisset
                                                    <input id="cnic" name="storeWebsite" class="form-control r-0 light s-12 date-picker" type="text">
                                            </div>                                           
                                        </div>
                                    </div>                               
                                </div>

                                <div class="form-row mt-1">
                                    <div class="form-group col-4 m-0">
                                        <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>Email</label>
                                        <input id="email" name="storeEmail" value={{$store->storeEmail}} class="form-control r-0 light s-12 " type="text" required>
                                    </div>

                                    <div class="form-group col-4 m-0">
                                        <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Phone</label>
                                        <input id="phone" name="storePhone" value={{$store->storePhone}} class="form-control r-0 light s-12 " type="text" required>
                                    </div>
                                    <div class="form-group col-4 m-0">
                                        <label for="mobile" class="col-form-label s-12"><i class="icon-mobile-phone mr-2"></i>City</label>
                                        <input id="mobile" name="storeCity" value="{{$store->storeCity}}" class="form-control r-0 light s-12 " type="text" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-9 m-0">
                                        <label for="address"  class="col-form-label s-12">Address</label>
                                        <input type="text" name="storeAddress" class="form-control r-0 light s-12" id="address" required
                                        value="{{$store->storeAddress}}">
                                    </div>

                                    <div class="form-group col-3 m-0">
                                        <label for="inputCity" class="col-form-label s-12">Country</label>
                                        <input type="text" name="storeCountry" value="{{$store->storeCountry}}" class="form-control r-0 light s-12" id="inputCity" required>
                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="productDetails">Store Description</label>
                                    <textarea class="form-control p-t-40 editor" name="storeDescription"
                                              placeholder="Write Description..." rows="17" required>{{$store->storeDescription}}</textarea>            
                                </div>
                                <hr>

                                <div class="form-row mt-2">
                                    <div class="form-group col-6 m-0">
                                        <label for="name" class="col-form-label s-12">STORE AVATAR</label>
                                        <div class="custom-file">
                                            <input type="file" name="storeAvatar" class="custom-file-input" id="validatedCustomFile">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                        @isset($store->storeAvatar)
                                        <img class="card rounded mt-3" width="200" src={{env('MY_DOMAIN').'/'.$store->storeAvatar}} alt="Card image cap">
                                        @endisset
                                        @empty($store->storeAvatar)
                                        <div class="mt-3">Avatar Store Not Yet</div>
                                        @endempty
                                        
                                    </div>  
                                    <div class="form-group col-6 m-0">
                                        <label for="name" class="col-form-label s-12">STORE BACKGROUND</label>
                                        <div class="custom-file">
                                            <input type="file" name="storeBackgroundImage" class="custom-file-input" id="validatedCustomFile">
                                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                        @isset($store->storeBackgroundImage)
                                        <img class="card rounded mt-3" width="200" src={{env('MY_DOMAIN').'/'.$store->storeBackgroundImage}} alt="Card image cap">
                                        @endisset
                                        @empty($store->storeBackgroundImage)
                                        <div class="mt-3">Background Store Not Yet</div>
                                        @endempty
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