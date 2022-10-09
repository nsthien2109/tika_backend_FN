@extends('layout')
@section('content')

<div class="page  has-sidebar-left height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-slideshow"></i>
                        Brand
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Brands</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href={{URL::to('admin/add-brand-page')}} ><i class="icon icon-plus-circle"></i> Add New Brand</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="tab-content my-3" id="v-pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                <div class="row my-3">
                    <div class="col-md-12">
                        <div class="card r-0 shadow">
                            <div class="table-responsive">
                                <form>
                                    <table class="table table-striped table-hover r-0">
                                        <thead>
                                        <tr class="no-b">
                                            <th style="width: 30px">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="checkedAll" class="custom-control-input"><label
                                                        class="custom-control-label" for="checkedAll"></label>
                                                </div>
                                            </th>
                                            <th>BRAND TITLE</th>
                                            <th>BRAND DESCRIPTION</th>
                                            <th>BRAND IMAGE</th>
                                            <th>BRAND STATUS</th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        
                                        @foreach($brands as $brand)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input checkSingle"
                                                           id="user_id_1" required><label
                                                        class="custom-control-label" for="user_id_1"></label>
                                                </div>
                                            </td>

                                            <td>
                                                <strong>{{$brand->brandName}}</strong>
                                            </td>
                                            <td>
                                                <strong>{{$brand->brandDescription}}</strong>
                                            </td>
                                            <td><img class="card rounded" width="100" src={{env('MY_DOMAIN').'/'.$brand->brandImage}} alt="Card image cap"></td>
                                            <td>
                                                @if($brand->brandStatus == 0)
                                                    <a href={{URL::to('admin/change-status-brand-'.$brand->id_brand.'')}} class="r-3 badge badge-danger white-text">Hide</a>
                                                @elseif($brand->brandStatus == 1)
                                                    <a href={{URL::to('admin/change-status-brand-'.$brand->id_brand.'')}} class="r-3 badge badge-success white-text">Active</a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href={{URL::to('admin/edit-brand-page-'.$brand->id_brand.'')}}><i class="icon-pencil mr-3"></i></a>
                                                <a href={{URL::to('admin/delete-brand/'.$brand->id_brand.'')}}><i class="icon-close2  text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach                                          

                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="my-3" aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href={{URL::to('admin/add-brand-page')}} class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
            class="icon-add"></i></a>
   <?php
   $message = Session::get('message');
   if (isset($message)) {
      echo 
          '<div class="toast"
          data-title="Hi, admin !"
           data-message="'.$message.'"
          data-position-class="toast-bottom-right"
           data-type="success">
      </div>';
      Session::put('message',null);
  }?>
</div>

@endsection