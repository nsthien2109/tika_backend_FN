@extends('seller_layout')
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
                    <a class="nav-link" href={{URL::to('seller/add-coupon-page')}}><i class="icon icon-list"></i>Add Coupon</a>
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
                    <th>Type</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if(isset($store_coupons))
                    @foreach($store_coupons as $coupon)
                    <tr>
                        <td>
                            <div>
                                <div>
                                    <strong>{{$coupon->couponCode}}</strong>
                                </div>
                                <small>{{$coupon->couponName}}</small>
                            </div>
                        </td>
                        <td><span class="r-3 badge badge-warning ">Store</span></td>
                        <td>{{$coupon->start_time}}</td>
                        <td>{{$coupon->end_time}}</td>
                        <td>
                            <a href={{URL::to('seller/edit-coupon-page-'.$coupon->id_coupon.'')}}><i class="icon-eye mr-3"></i></a>
                            <a href={{URL::to('seller/delete-coupon/'.$coupon->id_coupon.'')}}><i class="icon-close text-red"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
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