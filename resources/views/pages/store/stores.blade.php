@extends('layout')
@section('content')

<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Store
                    </h4>
                </div>
            </div>
            <div class="row">
                <ul class="nav responsive-tab nav-material nav-material-white">
                    <li>
                        <a class="nav-link active" href="#"><i class="icon icon-list"></i>All Store</a>
                    </li>
                    <li>
                        <a class="nav-link" href={{URL::to('admin/add-store-page')}}><i
                                class="icon icon-plus-circle"></i> Add New Store</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <div class="row">
                <div class="col-md-12">
                    <div class="card no-b shadow">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover ">
                                    <thead>
                                        <tr class="no-b">
                                            <th style="width: 30px">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="checkedAll" class="custom-control-input"><label
                                                        class="custom-control-label" for="checkedAll"></label>
                                                </div>
                                            </th>
                                            <th>STORE NAME</th>
                                            <th>PHONE</th>
                                            <th>PRODUCTS</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                    <tbody>
                                    @foreach($stores as $store)
                                    <tr class="no-b">
                                        <td class="w-10">
                                            @if($store->storeAvatar == NULL)
                                                <div class="avatar avatar-lg mr-3 mt-1 float-left">
                                                    <span class="avatar-letter avatar-letter-{{strtolower(mb_substr($store->storeName, 0, 1))}}  avatar-lg circle"></span>
                                                </div>
                                            @else
                                            <img class="card rounded" width="100" src={{env('MY_DOMAIN').'/'.$store->storeAvatar}} alt="Card image cap">
                                            @endif
                                        </td>
                                        <td>
                                            <h6>{{$store->storeName}}</h6>
                                            <small class="text-muted">{{$store->storeEmail}}</small>
                                        </td>
                                        <td>{{$store->storePhone}}</td>
                                        <td><span class="badge badge-success">20</span></td>
                                        <td>
                                            @if($store->storeStatus == 0)
                                                <a href={{URL::to('admin/change-status-store-'.$store->id_store.'')}} class="r-3 badge badge-danger white-text">Hide</a>
                                            @elseif($store->storeStatus == 1)
                                                <a href={{URL::to('admin/change-status-store-'.$store->id_store.'')}} class="r-3 badge badge-success white-text">Active</a>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a href={{URL::to('admin/edit-store-page-'.$store->id_store.'')}} class="btn-fab btn-fab-sm btn-primary shadow text-white mr-4"><i class="icon-pencil"></i></a>
                                                <a href={{URL::to('admin/delete-store/'.$store->id_store.'')}} class="btn-fab btn-fab-sm btn-danger shadow text-white"><i class="icon-trash-can3"></i></a>
                                            </div>
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
            <nav class="pt-3" aria-label="Page navigation">
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