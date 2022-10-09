@extends('layout')
@section('content')

<div class="page has-sidebar-left bg-light height-full">
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
                    <a class="nav-link active" href="#"><i class="icon icon-list"></i>Coupons</a>
                </li>
                <li>
                    <a class="nav-link" href={{URL::to('admin/add-coupon-page')}}><i class="icon icon-list"></i>Add Coupon</a>
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
                    <th>Code</th>
                    <th>Store</th>
                    <th>Type</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($global_coupons as $gl_coupon)
                    <tr>
                        <td>
                            <div>
                                <div>
                                    <strong>{{$gl_coupon->couponCode}}</strong>
                                </div>
                                <small>{{$gl_coupon->couponName}}</small>
                            </div>
                        </td>
                        <td>ALL Store</td>
                        <td><span class="r-3 badge badge-success ">Global</span></td>
                        <td>{{$gl_coupon->start_time}}</td>
                        <td>{{$gl_coupon->end_time}}</td>
                        <td>
                            <a href={{URL::to('admin/edit-coupon-page-'.$gl_coupon->id_coupon.'')}}><i class="icon-eye mr-3"></i></a>
                            <a href={{URL::to('admin/delete-coupon/'.$gl_coupon->id_coupon.'')}}><i class="icon-close text-red"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @foreach($store_coupons as $st_coupon)
                    <tr>
                        <td>
                            <div>
                                <div>
                                    <strong>{{$st_coupon->couponCode}}</strong>
                                </div>
                                <small>{{$st_coupon->couponName}}</small>
                            </div>
                        </td>
                        <td>{{$st_coupon->storeName}}</td>
                        <td><span class="r-3 badge badge-warning ">Store</span></td>
                        <td>{{$st_coupon->start_time}}</td>
                        <td>{{$st_coupon->end_time}}</td>
                        <td>
                            <a href={{URL::to('admin/edit-coupon-page-'.$st_coupon->id_coupon.'')}}><i class="icon-eye mr-3"></i></a>
                            <a href={{URL::to('admin/delete-coupon/'.$st_coupon->id_coupon.'')}}><i class="icon-close text-red"></i></a>
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