<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/img/basic/favicon.ico')}}" type="image/x-icon">
    <title>Tika Admin System</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
        .logo-text{
            font-size: 35px;
            font-weight: bold;
            color: var(--primary);
            opacity: .6;
        }
    </style>
</head>
<body class="light">
<!-- Pre loader -->
<div id="app">
    <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
        <section class="sidebar">
            <div class="w-80px mt-3 mb-3 ml-3">
                <p class="text-center logo-text">TIKA</p>
            </div>
            <div class="relative">
                <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
                aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                    <i class="icon icon-cogs"></i>
                </a>
                <div class="user-panel p-3 light mb-2">
                    <div>
                        <div class="float-left image">
                            <img class="user_avatar" src="{{asset('assets/img/dummy/u9.png')}}" alt="User Image">
                        </div>
                        <div class="float-left info">
                            <?php 
                                  $name = Session::get('adminName');
                                  if (isset($name)) {
                                    echo '<h6 class="font-weight-light mt-2 mb-1">'.$name.'</h6>';
                                  }
                            ?>
                            <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="collapse multi-collapse" id="userSettingsCollapse">
                        <div class="list-group mt-3 shadow">
                            <a href={{URL::to('/admin/profile-page-'.\Session::get('adminId').'')}} class="list-group-item list-group-item-action ">
                                <i class="mr-2 icon-umbrella text-blue"></i>Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header"><strong>NAVIGATION</strong></li>
                <li class="treeview"><a href={{URL::to('/admin')}}> 
                    <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span>Dashboard</span>
                </a>
                </li>
                <!-- Product navigation -->
                <li class="treeview"><a href={{URL::to('admin/products')}}><i class="icon icon icon-package blue-text s-18"></i>Products</a></li>
                <!-- User navigation -->
                <li class="treeview"><a href={{URL::to('admin/users')}}><i class="icon icon-account_box light-green-text s-18"></i>Users</a></li>
                <!-- Banner navigation -->
                <li class="treeview"><a href={{URL::to('admin/banners')}}><i class="icon icon-presentation-12 pink-text s-18"></i>Banner</a></li>
                <li class="treeview"><a href={{URL::to('admin/stores')}}><i class="icon icon-store_mall_directory cyan-text s-18"></i>Stores</a></li>
                <li class="treeview"><a href={{URL::to('admin/categories')}}><i class="icon icon-clear_all deep-purple-text s-18"></i>Categories</a></li>
                <li class="treeview"><a href={{URL::to('admin/sub_categories')}}><i class="icon icon-subject lime-text s-18"></i>Sub Category</a></li>
                <li class="treeview"><a href={{URL::to('admin/brands')}}><i class="icon icon-star-3 deep-orange-text s-18"></i>Brand</a></li>
                <li class="treeview"><a href={{URL::to('admin/address')}}><i class="icon icon-address-card-o black-text s-18"></i>User Address</a></li>
                <li class="treeview"><a href={{URL::to('admin/coupons')}}><i class="icon icon-ticket teal-text s-18"></i>Coupons</a></li>
                <li class="treeview"><a href={{URL::to('admin/flashsale-frame')}}><i class="icon icon-flash amber-text s-18"></i>FlashSale Time Frame</a></li>
                <li class="treeview"><a href={{URL::to('admin/orders')}}><i class="icon icon-clipboard-list deep-orange-text s-18"></i>Orders</a></li>
                <li class="treeview"><a href={{URL::to('admin/comments')}}><i class="icon icon-rate_review yellow-text s-18"></i>Comments</a></li>
                <li class="treeview"><a href={{URL::to('admin/units')}}><i class="icon icon-format_color_fill blue-text s-18"></i>Units</a></li>
                <li class="treeview"><a href={{URL::to('admin/deals')}}><i class="icon icon-view_day light-green-text s-18"></i>Deal of Day (Update DACN2)</a></li>
                <li class="treeview"><a href={{URL::to('admin/notify')}}><i class="icon icon-notifications_active red-text s-18"></i>Push Notification (Update DACN2)</a></li>
                <li class="treeview no-b"><a href={{URL::to('inbox')}}>
                    <i class="icon icon-package light-green-text s-18"></i><span>Inbox (Update DACN2)</span></a>
                </li>
                <li class="header light mt-3"><strong>ADVANCE</strong></li>
                <li class="treeview">
                    <a href={{URL::to('calendar')}}>
                        <i class="icon icon-calendar-o text-lime s-18"></i> <span>Calender (Update DACN2)</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>
    <!--Sidebar End-->
    <div class="has-sidebar-left">
        <div class="sticky">
            <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
                <div class="relative">
                    <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                        <i></i>
                    </a>
                </div>
                <!--Top Menu Start -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Right Sidebar Toggle Button -->
                        <li>
                            <a class="nav-link ml-2" data-toggle="control-sidebar">
                                <i class="icon-tasks "></i>
                            </a>
                        </li>
                        <!-- User Account-->
                        <li class="dropdown custom-dropdown user user-menu ">
                            <a href="#" class="nav-link" data-toggle="dropdown">
                                <img src="{{asset('assets/img/dummy/u9.png')}}" class="user-image" alt="User Image">
                            </a>
                            <div class="dropdown-menu p-4 dropdown-menu-right">
                                <div class="row box justify-content-between my-4">
                                    <div class="col">
                                        <a href={{URL::to('/logout')}}>
                                            <i class="icon-exit_to_app indigo lighten-2 avatar  r-5"></i>
                                            <div class="pt-1">Logout</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
</div>
<script src="{{asset('assets/js/app.js')}}"></script>

</body>

</html>