@extends('layout')
@section('content')

<div class="page has-sidebar-left bg-light height-full">
  <header class="blue accent-3 relative">
    <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
            <div class="col">
                <h4>
                    <i class="icon-package"></i>
                    Address
                </h4>
            </div>
        </div>
        <div class="row">
            <ul class="nav responsive-tab nav-material nav-material-white">
                <li>
                    <a class="nav-link active" href="#"><i class="icon icon-list"></i>All Address</a>
                </li>
                <li>
                    <a class="nav-link" href={{URL::to('admin/add-address-page')}}><i class="icon icon-list"></i>Add Address</a>
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
                    <th>User</th>
                    <th>Province</th>
                    <th>District</th>
                    <th>Commune</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($address as $key => $address_item)
                    <tr>
                        <td>
                            <div class="avatar avatar-md mr-3 mt-1 float-left">
                                <span class="avatar-letter avatar-letter-{{strtolower(mb_substr($address_item->firstName, 0, 1))}}  avatar-md circle"></span>
                            </div>
                            <div>
                                <div>
                                    <strong>{{$address_item->firstName.' '.$address_item->lastName}}</strong>
                                </div>
                                <small>{{$address_item->email}}</small>
                            </div>
                        </td>

                        <td>{{$address_item->addressProvince}}</td>
                        <td>{{$address_item->addressDistrict}}</td>
                        <td>{{$address_item->addressCommune}}</td>
                        <td>
                            <a href={{URL::to('admin/edit-address-page-'.$address_item->id_address.'')}}><i class="icon-eye mr-3"></i></a>
                            <a href={{URL::to('admin/delete-address/'.$address_item->id_address.'')}}><i class="icon-close text-red"></i></a>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>User</th>
                    <th>Province</th>
                    <th>District</th>
                    <th>Commune</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
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