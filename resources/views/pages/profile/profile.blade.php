@extends('layout')
@section('content')

<div class="page has-sidebar-left">
    <div>
        <header class="blue accent-3 relative">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <div class="pb-3 flex item-center">
                            <div class="avatar avatar-md mt-3 mr-3 mt-1 float-left">
                                <span class="avatar-letter avatar-letter-{{strtolower(mb_substr($user->firstName, 0, 1))}}  avatar-md circle"></span>
                            </div>
                            <div>
                                <h6 class="p-t-10">{{$user->firstName.' '.$user->lastName}}</h6>
                                {{$user->email}}
                            </div>
                        </div>
                    </div>
                </div>

              <div class="row">
                  <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                      <li>
                          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"><i class="icon icon-home2"></i>Profile</a>
                      </li>
                      <li>
                          <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="icon icon-cog"></i>Edit Profile</a>
                      </li>
                  </ul>
              </div>

            </div>
        </header>

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
           <div class="tab-content" id="v-pills-tabContent">
               <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <div class="row">
                       <div class="col-md-12">
                           <div class="card ">

                               <ul class="list-group list-group-flush">
                                   <li class="list-group-item"><i class="icon icon-mobile text-primary"></i><strong class="s-12">Phone</strong> <span class="float-right s-12">{{$user->phone}}</span></li>
                                   <li class="list-group-item"><i class="icon icon-mail text-success"></i><strong class="s-12">Email</strong> <span class="float-right s-12">{{$user->email}}</span></li>
                                   <li class="list-group-item">
                                        <i class="icon icon-address-card-o text-warning"></i>
                                        <strong class="s-12">Role</strong>
                                        <span class="float-right s-12">
                                            @if($user->role == 0)
                                            <span class="r-3 badge badge-success ">Administrator</span>
                                            @elseif($user->role == 1)
                                            <span class="r-3 badge badge-warning ">Store</span>
                                            @elseif($user->role == 2)
                                            <span class="r-3 badge badge-info ">User</span>
                                            @endif
                                        </span>
                                   </li>
                               </ul>
                           </div>

                       </div>
                      
                   </div>
               </div>
               <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                   <form class="form-horizontal" action={{URL::to('admin/update-user')}} method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="idUser" value={{$user->id}}>
                       <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">First Name</label>
                           <div class="col-sm-10">
                               <input class="form-control" id="inputName" name="firstName" value={{$user->firstName}} type="text">
                           </div>
                       </div>
                       <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Last Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="inputName" name="lastName" value={{$user->lastName}} type="text">
                        </div>
                    </div>
                       <div class="form-group">
                           <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                           <div class="col-sm-10">
                               <input class="form-control" id="inputEmail" name="email" value={{$user->email}} type="email">
                           </div>
                       </div>
                       <div class="form-group">
                           <label for="inputName" class="col-sm-2 control-label">Phone</label>

                           <div class="col-sm-10">
                               <input class="form-control" id="inputName" name="phone" value={{$user->phone}} type="tel">
                           </div>
                       </div>
                       <div class="card-body">
                           <h5 class="card-title">ROLE ACCOUNT</h5>
                           <div class="form-row">
                               <div class="form-group col-5 m-0">
                                   <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" name="role">
                                       <option value="2">User</option>
                                       <option value="0">Administator</option>
                                   </select>
                               </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-sm-offset-2 col-sm-10">
                               <button type="submit" class="btn btn-danger">Save</button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
        </div>

    </div>
</div>

@endsection