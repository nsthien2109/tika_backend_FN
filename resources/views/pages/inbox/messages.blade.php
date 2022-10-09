@extends('layout')
@section('content')

<div class="has-sidebar-left">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Inbox
                    </h4>
                </div>
            </div>
            <div class="row">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="icon icon-list"></i>All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#modalCreateMessage" data-toggle="modal"
                           data-target="#modalCreateMessage">
                            <i class="icon icon-clipboard-add"></i> Compose New Message
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce p-0">
        <div class="animated fadeInUpShort">
            <div class="row no-gutters">
                <div class="col-md-3 white sticky">
                    <div class="sticky white">
                        <ul class="nav nav-tabs nav-material">
                            <li class="nav-item">
                                <a class="nav-link p-3 active show" id="w2--tab1" data-toggle="tab" href="#w2-tab1"><i
                                        class="icon icon-mail-envelope-closed s-18 text-success"></i>New</a>
                            </li>                    
                        </ul>
                    </div>
                    <div class="slimScroll">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="w2-tab1" role="tabpanel"
                                 aria-labelledby="w2-tab1">
                                <ul class="list-unstyled ">
                                    <li class="media p-3 b-b has-hover">
                                        <img class="d-flex mr-3 height-50" src="assets/img/dummy/u1.png"
                                             alt="Generic placeholder image">
                                        <div class="media-body text-truncate">
                                            <small class="float-right">
                                                <span>10 May</span>
                                                <a href="#" class="mr-2 ml-2">
                                                    <i class="icon-star-o "></i>
                                                </a>
                                            </small>
                                            <h6 class="mt-0 mb-1 font-weight-normal">Doe Joe </h6>
                                            <span>Message sent via your  Market </span>
                                            <br>
                                            <small>Congratulations! Your update to WeRock Multipurpose</small>
                                        </div>
                                        <div class="dropdown">
                                            <a class="" href="#" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                <i class="icon-more_vert p-0"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">View
                                                    Profile </a>
                                                <a class="dropdown-item" href="#">Account
                                                    Settings </a>
                                                <a class="dropdown-item" href="#">
                                                    Earning Reports </a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Logout
                                                </a>
                                            </div>
                                        </div>
                                    </li>                                                            
                                </ul>
                            </div>
                           
                    
                        </div>
                    </div>
                </div>
                <div class="col-md-9 b-l">
                    <div class="m-md-3">
                        <!--Message Start-->
                        <div class="card b-0  m-2">
                            <div class="card-body">
                                <div data-toggle="collapse" data-target="#message2" >
                                    <div class="media">
                                        <img class="d-flex mr-3 height-50" src="assets/img/dummy/u3.png"
                                             alt="Generic placeholder image">
                                        <div class="media-body">
                                            <h6 class="mt-0 mb-1 font-weight-normal">Doe Joe</h6>
                                            <span>Message sent via your Market profile</span>
                                            <br>
                                            <small>Mon 9/18/2017, 9:54 PM</small>
                                            <div class="collapse my-3 show" id="message2">
                                                <div>
                                                    <p>Hello John,</p>
                                                    <p>Keffiyeh blog actually fashion axe vegan, irony biodiesel.
                                                        Cold-pressed hoodie chillwave put
                                                        a bird
                                                        on it aesthetic, bitters brunch meggings vegan iPhone.
                                                        Dreamcatcher vegan scenester mlkshk.
                                                        Ethical
                                                        master cleanse Bushwick, occupy Thundercats banjo cliche ennui
                                                        farm-to-table mlkshk fanny
                                                        pack
                                                        gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt
                                                        tofu scenester chillwave 3
                                                        wolf moon
                                                        asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe,
                                                        Godard disrupt migas
                                                        church-key tofu
                                                        blog locavore. Thundercats cronut polaroid Neutra tousled, meh
                                                        food truck selfies narwhal
                                                        American
                                                        Apparel.</p>
                                                    <p>Thanks,<br>Jane</p>
                                                </div>
                                                <div class="btn-group float-right">
                                                    <a class="btn btn-outline-primary btn-xs" href="#modalCreateMessage"
                                                       data-toggle="modal"
                                                       data-target="#modalCreateMessage">Forward</a>
                                                    <a class="btn btn-outline-primary btn-xs" href="#modalCreateMessage"
                                                       data-toggle="modal"
                                                       data-target="#modalCreateMessage">Reply</a>
                                                    <a class="btn btn-outline-primary btn-xs" href="#modalCreateMessage"
                                                       data-toggle="modal"
                                                       data-target="#modalCreateMessage">Save</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Message End-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Add New Message Fab Button-->
    <a href="#modalCreateMessage" data-toggle="modal"
       data-target="#modalCreateMessage" class="btn-fab btn-fab-md fab-right fab-right-bottom-fixed shadow btn-primary"><i
            class="icon-add"></i></a>
</div>

<!--Message Modal-->
<div class="modal fade" id="modalCreateMessage" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content b-0">
            <div class="modal-header r-0 bg-primary">
                <h6 class="modal-title text-white" id="exampleModalLabel">Compose A New Message</h6>
                <a href="#" data-dismiss="modal" aria-label="Close"
                   class="paper-nav-toggle paper-nav-white active"><i></i></a>
            </div>
            <div class="modal-body no-p no-b">
                <form method="post">
                    <div class="form-group has-icon m-0">
                        <i class="icon-envelope-o"></i>
                        <input class="form-control form-control-lg r-0 b-0" type="text"
                               name="email" id="email" placeholder="Recipient Email Address">
                    </div>
                    <div class="b-b"></div>
                    <div class="form-group has-icon m-0">
                        <i class="icon-subject"></i>
                        <input class="form-control form-control-lg r-0 b-0" type="text"
                               name="email" id="subject" placeholder="Subject">
                    </div>
                    <textarea class="form-control r-0 b-0 p-t-40 editor" placeholder="Write Something..."
                              rows="17"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary l-s-1 s-12 text-uppercase">
                    Send Message
                </button>
            </div>
        </div>
    </div>
</div>

@endsection