@extends('layout')
@section('content')

<div class="page has-sidebar-left bg-light height-full">
    <div class="container-fluid my-3">
        <div class="d-flex row">
            <div class="col-md-6">
                    <div class="card my-3 shadow no-b r-0">
                        <div class="card-header white">
                            <h6>Add Size</h6>
                        </div>
                        <div class="card-body">
                            <form action={{URL::to('admin/add-size')}} method="POST">
                                {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationServer01">Size name</label>
                                        <input type="text" name="sizeName" class="form-control is-valid" id="validationServer01" placeholder="Size Name" required>
                                        <div class="valid-feedback">
                                            OK !
                                        </div>
                                    </div>                           
                                </div>                              
                                <button class="btn btn-primary" type="submit">Save Size</button>
                            </form>
                        </div>
                    </div>           
            </div>
            <div class="col-md-6">
                <div class="card my-3 shadow no-b r-0">
                    <div class="card-header white">
                        <h6>Add Color</h6>
                    </div>
                    <div class="card-body">
                        <form action={{URL::to('admin/add-color')}} method="POST">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer01">Color name</label>
                                    <input type="text" name="colorName" class="form-control is-valid" id="validationServer01" placeholder="Color name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Color Hex Code</label>
                                    <input type="text" name="colorHex" class="form-control is-valid" id="validationServer02" placeholder="Color hex code" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Save Color</button>
                        </form>
                    </div>
                </div>           
            </div>               
        </div>
        <hr>
        <div class="d-flex row">
            <div class="col-md-6">
                <div class="container-fluid animatedParent animateOnce">
                    <div class="tab-content my-3" id="v-pills-tabContent">
                        <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card r-0 shadow">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover r-0">
                                                <thead>
                                                <tr class="no-b">                                                    
                                                    <th>SIZE NAME</th>
                                                    <th></th>
                                                </tr>
                                                </thead>            
                                                <tbody>
                                                @foreach($sizes as $size)
                                                <tr>                                                               
                                                    <td>                                                            
                                                        <strong>{{$size->sizeName}}</strong>
                                                    </td>                                                        
                                                    <td>
                                                        <a href={{URL::to('admin/delete-size/'.$size->id_size.'')}}><i class="icon-close text-red"></i></a>
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
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="container-fluid animatedParent animateOnce">
                    <div class="tab-content my-3" id="v-pills-tabContent">
                        <div class="tab-pane animated fadeInUpShort show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                            <div class="row my-3">
                                <div class="col-md-12">
                                    <div class="card r-0 shadow">
                                        <div class="table-responsive">
                                                <table class="table table-striped table-hover r-0">
                                                    <thead>
                                                    <tr class="no-b">
                                                        <th>COLOR NAME</th>
                                                        <th>COLOR HEX</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
            
                                                    <tbody>
                                                    @foreach($colors as $color)
                                                    <tr>
                                                        <td>
                                                            <div class="avatar avatar-sm mr-3 mt-1 float-left">
                                                                <span class="avatar-letter avatar-sm circle" style="background-color:#{{$color->colorHex}};"></span>
                                                            </div>
                                                            <div>
                                                                <strong>{{$color->colorName}}</strong>
                                                            </div>
                                                        </td>
            
                                                        <td>{{$color->colorHex}}</td>                                                       
                                                        <td>
                                                            <a href={{URL::to('admin/delete-color/'.$color->id_color.'')}}><i class="icon-close text-red"></i></a>
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
             data-type="warning">
        </div>';
        Session::put('message',null);
    }?>
</div>

@endsection