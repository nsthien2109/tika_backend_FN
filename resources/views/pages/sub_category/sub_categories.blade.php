@extends('layout')
@section('content')

<div class="page  has-sidebar-left height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-slideshow"></i>
                        Sub Categories
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Categories</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href={{URL::to('admin/add-sub-category-page')}} ><i class="icon icon-plus-circle"></i> Add New Sub Category</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid my-3">
        <div class="row">
          <div class="col-md-12">
            <div class="card my-3 no-b">
              <div class="card-body">
                <table
                  id="example2"
                  class="table table-bordered table-hover data-tables"
                  data-options='{ "paging": false; "searching":false}'
                >
                  <thead>
                    <tr>
                      <th>Sub Category</th>
                      <th>Products</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sub_categories as $subCategory)
                      <tr>
                          <td>
                              <div>
                                  <div>
                                      <strong>{{$subCategory->subCategoryName}}</strong>
                                  </div>
                                  <small>{{$subCategory->categoryName}}</small>
                              </div>
                          </td>
                          <td><span class="r-3 badge badge-success ">{{$subCategory->numProducts}}</span></td>
                          <td>
                            @if($subCategory->status == 0)
                                <a href={{URL::to('admin/change-status-sub-'.$subCategory->id_sub_category.'')}} class="r-3 badge badge-danger white-text">Hide</a>
                            @elseif($subCategory->status == 1)
                                <a href={{URL::to('admin/change-status-sub-'.$subCategory->id_sub_category.'')}} class="r-3 badge badge-success white-text">Active</a>
                            @endif
                        </td>
                          <td>
                              <a href={{URL::to('admin/edit-sub-category-page-'.$subCategory->id_sub_category.'')}}><i class="icon-eye mr-3"></i></a>
                              <a href={{URL::to('admin/delete-sub-category/'.$subCategory->id_sub_category.'')}}><i class="icon-close text-red"></i></a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!--Add New Message Fab Button-->
    <a href={{URL::to('admin/add-category-page')}} class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
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