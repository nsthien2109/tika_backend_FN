@extends('layout')
@section('content')

<div class="page has-sidebar-left  height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Banner
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href={{URL::to('admin/banners')}}><i class="icon icon-home2"></i>All Banners</a>
                    </li>
                    <li>
                        <a class="nav-link"  href={{URL::to('admin/add-banner-page')}} ><i class="icon icon-plus-circle"></i> Add New Banner</a>
                    </li>
                    <li>
                        <a class="nav-link active"  href="#" ><i class="icon icon-plus-circle"></i> Edit Banner</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    <form action={{URL::to('admin/update-banner')}} method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title">About banner</h5>
                                <div class="form-row">
                                    <input type="hidden" name="bannerId" value={{$banner->id_banner}}>
                                    <div class="col-md-12">
                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">BANNER NAME</label>
                                            <input id="name" name="bannerName" value={{$banner->bannerName}} class="form-control r-0 light s-12 " type="text" required>
                                        </div>

                                        <div class="form-group m-0">
                                            <label for="url" class="col-form-label s-12">BANNER URL</label>
                                            <input id="url" name="bannerUrl" value={{$banner->bannerUrl}} class="form-control r-0 light s-12 " type="text" required>
                                        </div>

                                        <div class="form-group m-0">
                                            <label for="desc" class="col-form-label s-12">BANNER DESCRIPTION</label>
                                            <input id="desc" name="bannerDescription" value={{$banner->bannerDescription}} class="form-control r-0 light s-12 " type="text" required>
                                        </div>

                                        <div class="form-group m-0">
                                            <label for="name" class="col-form-label s-12">CATEGORY IMAGE</label>
                                            <div class="custom-file">
                                                <input type="file" name="bannerImage" class="custom-file-input" id="validatedCustomFile">
                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>

                                            <img class="card rounded mt-3" width="300" src={{env('MY_DOMAIN').'/'.$banner->bannerImage}} alt="Card image cap">
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