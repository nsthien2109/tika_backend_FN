@extends('layout')
@section('content')

<div class="page has-sidebar-left bg-light height-full">
  <header class="blue accent-3 relative">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-package"></i>
                    Flash Sale Time Frame Management
                </h4>
            </div>
        </div>
        <div class="row">
            <ul class="nav responsive-tab nav-material nav-material-white">
                <li>
                    <a class="nav-link active" href="#"><i class="icon icon-list"></i>Flash frame</a>
                </li>
                <li>
                    <a class="nav-link" href={{URL::to('admin/add-flash-frame-page')}}><i class="icon icon-list"></i>Add Frame</a>
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
                    <th>Title</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($time_frame as $item)
                  <tr>
                      <td>{{$item->title}}</td>
                      <td>{{$item->start}}</td>
                      <td>{{$item->end}}</td>
                      <td>
                          <a href={{URL::to('admin/edit-flash-frame-page-'.$item->id_flashsale_frame.'')}}><i class="icon-eye mr-3"></i></a>
                          <a href={{URL::to('admin/delete-frame/'.$item->id_flashsale_frame.'')}}><i class="icon-close text-red"></i></a>
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