@extends('seller_layout')
@section('content')

<div class="page has-sidebar-left bg-light height-full">
  <header class="blue accent-3 relative">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-package"></i>
                    Order Management
                </h4>
            </div>
        </div>
        <div class="row">
            <ul class="nav responsive-tab nav-material nav-material-white">
                <li>
                    <a class="nav-link active" href="#"><i class="icon icon-list"></i>Order</a>
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
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Order User</th>
                    <th>Order Date</th>
                    <th>Phone</th>
                    <th>Quantity</th>
                    <th>Coupon</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td><img width="70" src={{env('MY_DOMAIN').'/'.$order->productImage}} alt=""></td>
                        <td>{{$order->productName}}</td>
                        <td>
                            <div>
                                <div>
                                    <strong>{{$order->orderName}}</strong>
                                </div>
                                <small>{{$order->orderEmail}}</small>
                            </div>
                        </td>
                        <td><span class="r-3 badge badge-info white-text">{{$order->created_at}}</span></td>
                        <td>{{$order->orderPhone}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->orderCoupon}}</td>
                        <td>
                            @if($order->status == 0)
                            <a href={{URL::to('seller/order/'.$order->id_order_detail.'')}} class="r-3 badge badge-danger white-text">Cancel</a>
                            @elseif($order->status == 1)
                            <a href={{URL::to('seller/order/'.$order->id_order_detail.'')}} class="r-3 badge badge-info white-text">Pending</a>
                            @elseif($order->status == 2)
                            <a href={{URL::to('seller/order/'.$order->id_order_detail.'')}} class="r-3 badge badge-warning white-text">Confirm</a>
                            @elseif($order->status == 3)
                            <a href={{URL::to('seller/order/'.$order->id_order_detail.'')}} class="r-3 badge badge-success white-text">Delivered</a>
                            @elseif($order->status == 4)
                            <a href={{URL::to('seller/order/'.$order->id_order_detail.'')}} class="r-3 badge badge-danger white-text">Refund</a>
                            @endif
                        </td>
                        <td>${{$order->total}}</td>
                        <td>
                            <a href={{URL::to('seller/view-order-page-0')}}><i class="icon-eye mr-3"></i></a>
                            <a href={{URL::to('seller/delete-order/'.$order->id_order_detail.'')}}><i class="icon-close text-red"></i></a>
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