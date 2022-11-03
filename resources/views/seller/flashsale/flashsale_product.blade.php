@extends('seller_layout')
@section('content')

<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Products
                    </h4>
                </div>
            </div>
            <div class="row">
                <ul class="nav responsive-tab nav-material nav-material-white">
                    <li>
                        <a class="nav-link active" href="#"><i class="icon icon-list"></i>All Flashsale Products</a>
                    </li>
                    <li>
                        <a class="nav-link" href={{URL::to('seller/add-flashsale-product-page')}}><i
                                class="icon icon-plus-circle"></i> Add New Flashsale Product</a>
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
                                    <tbody>
                                    @foreach ($flashsale_product as $product)
                                    <tr class="no-b">
                                        <td class="w-10">
                                            <img src={{env('MY_DOMAIN').'/'.$product->productImage}} alt="">
                                        </td>
                                        <td>
                                            <h6>{{$product->productName}}</h6>
                                            <small class="text-muted">${{$product->productPrice}}</small>
                                        </td>
                                        <td>Price sale : ${{$product->productPrice - $product->productPrice * ($product->salePercent / 100)}}</td>
                                        <td>Amount : {{$product->amount}}</td>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->sale_day}}</td>
                                        <td>
                                            <a  class="badge badge-danger white-text">{{$product->salePercent}}%</a>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a href={{URL::to('seller/edit-flashsale-product-page-'.$product->id_flashsale_product.'')}} class="btn-fab btn-fab-sm btn-primary shadow text-white mr-4"><i class="icon-pencil"></i></a>
                                                <a href={{URL::to('seller/delete-product/'.$product->id_flashsale_product.'')}} class="btn-fab btn-fab-sm btn-danger shadow text-white"><i class="icon-trash-can3"></i></a>
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