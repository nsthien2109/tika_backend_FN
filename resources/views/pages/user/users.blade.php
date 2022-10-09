@extends('layout')
@section('content')

<div class="page  has-sidebar-left height-full">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Users
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                           role="tab" aria-controls="v-pills-all"><i class="icon icon-home2"></i>All Users</a>
                    </li>
                    <li class="float-right">
                        <a class="nav-link"  href={{URL::to('admin/add-user-page')}} ><i class="icon icon-plus-circle"></i> Add New User</a>
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
                                            <th>USER NAME</th>
                                            <th>PHONE</th>
                                            <th>ROLE</th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                       @foreach ($users as $key => $user)
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input checkSingle"
                                                           id="user_id_1" required><label
                                                        class="custom-control-label" for="user_id_1"></label>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                    <span class="avatar-letter avatar-letter-{{strtolower(mb_substr($user->firstName, 0, 1))}}  avatar-md circle"></span>
                                                </div>
                                                <div>
                                                    <div>
                                                        <strong>{{$user->firstName.' '.$user->lastName}}</strong>
                                                    </div>
                                                    <small>{{$user->email}}</small>
                                                </div>
                                            </td>

                                            <td>{{$user->phone}}</td>
                                            <td>
                                                @if($user->role == 0)
                                                    <span class="r-3 badge badge-success ">Administrator</span>
                                                @elseif($user->role == 1)
                                                    <span class="r-3 badge badge-warning ">Store</span>
                                                @elseif($user->role == 2)
                                                    <span class="r-3 badge badge-info ">User</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href={{URL::to('admin/profile-page-'.$user->id.'')}}><i class="icon-eye mr-3"></i></a>
                                                <a href={{URL::to('admin/delete-user/'.$user->id.'')}}><i class="icon-close text-red"></i></a>
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
    <a href={{URL::to('admin/add-user-page')}} class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
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