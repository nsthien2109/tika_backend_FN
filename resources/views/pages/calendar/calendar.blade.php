@extends('layout')
@section('content')
<div class="has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10">
                <div class="col">
                    <h4>
                        <i class="icon-calendar"></i>
                        Calendar
                    </h4>
                </div>
            </div>
            <div class="row ">
                <ul class="nav">
                    <li>
                        <a class="nav-link" href="#"><i class="icon icon-list"></i>All Events</a>
                    </li>
                    <li>
                        <a class="nav-link active" href="#"><i
                                class="icon icon-clipboard-add"></i>Add New Event</a>
                    </li>
                    <li>
                        <a class="nav-link" href="#"><i class="icon icon-trash-can"></i>Trash</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="animatedParent animateOnce">
        <div class="container-fluid p-0">
                <div class="row no-gutters">
                        <div class="col-md-3">
                            <div class="card r-0 b-0 shadow sticky">
                                <div class="card-header white ">
                                    <h6>Draggable Events</h6>
                                </div>

                                <div class="card-body b-t pt-2 pb-2 no-b">
                                    <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove">
                                            Remove chip once added in calander
                                        </label>
                                    </div>
                                </div>
                                <div class="card-footer white">
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                        <ul class="fc-color-picker list-inline-item" id="color-chooser">
                                            <li class="list-inline-item"><a class="text-aqua" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-blue" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-light-blue" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-teal" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-yellow" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-orange" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-green" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-lime" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-red" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-purple" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-fuchsia" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-muted" href="#"><i class="icon-circle s-24"></i></a></li>
                                            <li class="list-inline-item"><a class="text-navy" href="#"><i class="icon-circle s-24"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="input-group">
                                        <input id="new-event" type="text" class="form-control r-30" placeholder="Event Title">
                                        <div class="input-group-btn">
                                            <a id="add-new-event" class="btn-fab shadow btn-danger ml-2"><i class="icon-add"></i></a>
                                        </div>
                                        <!-- /btn-group -->
                                    </div>
                                    <!-- /input-group -->
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <div id="external-events" class="p-3">
                                <div class="external-event purple lighten-1 p-2 my-2 r-3 text-white">Lunch</div>
                                <div class="external-event indigo lighten-1 p-2 my-2 r-3 text-white">Go home</div>
                                <div class="external-event light-green lighten-1 p-2 my-2 r-3 text-white">Do homework</div>
                                <div class="external-event amber lighten-1 p-2 my-2 r-3 text-white">Work on UI design</div>
                                <div class="external-event bg-red p-2 my-2 r-3 text-white">Sleep tight</div>
                            </div>

                          <!-- /. box -->

                        </div>
                <!-- /.col -->
                <div class="col-md-9">
                  <div class="card no-r no-b shadow">
                    <div class="card-body p-0">
                        <div id='calendar'></div>
                    </div>
                  </div>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection