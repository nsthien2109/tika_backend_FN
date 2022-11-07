@extends('seller_layout')
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
                          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home"><i class="icon icon-home2"></i>Home</a>
                      </li>
                      <li>
                          <a class="nav-link" id="v-pills-timeline-tab" data-toggle="pill" href="#v-pills-timeline" role="tab" aria-controls="v-pills-timeline" aria-selected="false"><i class="icon icon-cog"></i>Edit Store</a>
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
                                <li class="list-group-item"><i class="icon icon-store_mall_directory indigo-text"></i><strong class="s-12">Store Name</strong> <span class="float-right s-12">{{$store->storeName}}</span></li>
                                <li class="list-group-item"><i class="icon icon-explore teal-text"></i><strong class="s-12">Website</strong> <span class="float-right s-12">{{$store->storeWebsite ?? 'Not yet'}}</span></li>
                                <li class="list-group-item"><i class="icon icon-room orange-text"></i><strong class="s-12">Address</strong> <span class="float-right s-12">{{$store->storeAddress}}</span></li>
                                <li class="list-group-item"><i class="icon icon-mail text-success"></i><strong class="s-12">Store Email</strong> <span class="float-right s-12">{{$store->storeEmail}}</span></li>
                                <li class="list-group-item"><i class="icon icon-mobile red-text"></i><strong class="s-12">Hotline</strong> <span class="float-right s-12">{{$store->storePhone}}</span></li>
                            </ul>
                           </div>                          
                       </div>
                   </div>
               </div>

               <div class="tab-pane fade" id="v-pills-timeline" role="tabpanel" aria-labelledby="v-pills-timeline-tab">

                <form action={{URL::to('seller/update-store')}} method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card no-b  no-r">
                        <input type="hidden" name="storeId" value="{{$store->id_store}}">
                        <div class="card-body">
                            <h5 class="card-title">About Store</h5>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group m-0">
                                        <label for="name" class="col-form-label s-12">STORE NAME</label>
                                        <input id="name" name="storeName" value="{{$store->storeName}}" class="form-control r-0 light s-12 " type="text" required>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 m-0">
                                            <label for="cnic" class="col-form-label s-12"><i class="icon-fingerprint"></i>STORE WEBSITE</label>
                                            @isset($store->storeWebsite)
                                                <input id="cnic" name="storeWebsite" value={{$store->storeWebsite}} class="form-control r-0 light s-12 date-picker" type="text">
                                            @endisset
                                                <input id="cnic" name="storeWebsite" class="form-control r-0 light s-12 date-picker" type="text">
                                        </div>                                           
                                    </div>
                                </div>                               
                            </div>

                            <div class="form-row mt-1">
                                <div class="form-group col-4 m-0">
                                    <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>Email</label>
                                    <input id="email" name="storeEmail" value={{$store->storeEmail}} class="form-control r-0 light s-12 " type="text" required>
                                </div>

                                <div class="form-group col-4 m-0">
                                    <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Phone</label>
                                    <input id="phone" name="storePhone" value={{$store->storePhone}} class="form-control r-0 light s-12 " type="text" required>
                                </div>
                                <div class="form-group col-4 m-0">
                                    <label for="mobile" class="col-form-label s-12"><i class="icon-mobile-phone mr-2"></i>City</label>
                                    <input id="mobile" name="storeCity" value="{{$store->storeCity}}" class="form-control r-0 light s-12 " type="text" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-9 m-0">
                                    <label for="address"  class="col-form-label s-12">Address</label>
                                    <input type="text" name="storeAddress" class="form-control r-0 light s-12" id="address" required
                                    value="{{$store->storeAddress}}">
                                </div>

                                <div class="form-group col-3 m-0">
                                    <label for="inputCity" class="col-form-label s-12">Country</label>
                                    <input type="text" name="storeCountry" value="{{$store->storeCountry}}" class="form-control r-0 light s-12" id="inputCity" required>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label for="productDetails">Store Description</label>
                                <textarea class="form-control p-t-40 editor" name="storeDescription"
                                          placeholder="Write Description..." rows="17" required>{{$store->storeDescription}}</textarea>            
                            </div>
                            <hr>

                            <div class="form-row mt-2">
                                <div class="form-group col-6 m-0">
                                    <label for="name" class="col-form-label s-12">STORE AVATAR</label>
                                    <div class="custom-file">
                                        <input type="file" name="storeAvatar" class="custom-file-input" id="validatedCustomFile">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                    @isset($store->storeAvatar)
                                    <img class="card rounded mt-3" width="200" src={{env('MY_DOMAIN').'/'.$store->storeAvatar}} alt="Card image cap">
                                    @endisset
                                    @empty($store->storeAvatar)
                                    <div class="mt-3">Avatar Store Not Yet</div>
                                    @endempty
                                    
                                </div>  
                                <div class="form-group col-6 m-0">
                                    <label for="name" class="col-form-label s-12">STORE BACKGROUND</label>
                                    <div class="custom-file">
                                        <input type="file" name="storeBackgroundImage" class="custom-file-input" id="validatedCustomFile">
                                        <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    </div>
                                    @isset($store->storeBackgroundImage)
                                    <img class="card rounded mt-3" width="200" src={{env('MY_DOMAIN').'/'.$store->storeBackgroundImage}} alt="Card image cap">
                                    @endisset
                                    @empty($store->storeBackgroundImage)
                                    <div class="mt-3">Background Store Not Yet</div>
                                    @endempty
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i>Save Data</button>
                        </div>
                    </div>
                </form>
               </div>
               <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <form class="form-horizontal" action={{URL::to('seller/update-profile')}} method="POST">
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