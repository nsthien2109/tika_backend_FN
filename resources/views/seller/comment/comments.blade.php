@extends('seller_layout')
@section('content')

<div class="page has-sidebar-left bg-light height-full">
  <header class="blue accent-3 relative">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-package"></i>
                    Comment Management
                </h4>
            </div>
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
                    <th>Product</th>
                    <th>Comment User</th>
                    <th>Comment Star</th>
                    <th>Comment Content</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    <tr>
                        <td><img width="70" src={{env('MY_DOMAIN').'/'.$comment->productImage}} alt=""></td>
                        <td>{{$comment->productName}}</td>
                        <td>{{$comment->firstName.' '.$comment->lastName}}</td>
                        <td>{{$comment->star_rate}} star</td>
                        <td>{{$comment->commentContent}}</td>
                        <td>
                            <a href={{URL::to('seller/delete-comment/'.$comment->id_comment.'')}}><i class="icon-close text-red"></i></a>
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