<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/img/basic/favicon.ico')}}" type="image/x-icon">
    <title>Paper</title>
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
                <p class="logo-text">TIKA</p>
            </div>
            <div class="relative">
                <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
                aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                    <i class="icon icon-cogs"></i>
                </a>
                <div class="user-panel p-3 light mb-2">
                    <div>
                        <div class="float-left image">
                            <img class="user_avatar" src="{{asset('assets/img/dummy/u13.png')}}" alt="User Image">
                        </div>
                        <div class="float-left info">
                            <?php 
                                  $name = Session::get('sellerName');
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
                            <a href={{URL::to('seller/infomation')}} class="list-group-item list-group-item-action ">
                                <i class="mr-2 icon-umbrella text-blue"></i>Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header"><strong>NAVIGATION</strong></li>
                <li class="treeview"><a href={{URL::to('seller')}}> 
                    <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span>Dashboard</span>
                </a>
                </li>
                <!-- Product navigation -->
                <li class="treeview"><a href={{URL::to('seller/products')}}><i class="icon icon icon-package blue-text s-18"></i>My Products</a></li>
                <li class="treeview"><a href={{URL::to('seller/products-release')}}><i class="icon icon icon-newspaper-o deep-purple-text s-18"></i>Products Release</a></li>
                <!-- Banner navigation -->
                <li class="treeview"><a href={{URL::to('seller/coupons')}}><i class="icon icon-ticket teal-text s-18"></i>Coupons</a></li>
                <li class="treeview"><a href={{URL::to('seller/flashsale_product')}}><i class="icon icon-flash amber-text s-18"></i>Flash Sale</a></li>
                <li class="treeview"><a href={{URL::to('seller/orders')}}><i class="icon icon-clipboard-list deep-orange-text s-18"></i>Orders</a></li>
                <li class="treeview"><a href={{URL::to('seller/comments')}}><i class="icon icon-rate_review yellow-text s-18"></i>Comments</a></li>
                <li class="treeview"><a href={{URL::to('seller/deals')}}><i class="icon icon-view_day light-green-text s-18"></i>Deal of Day (Update DACN 2)</a></li>
                <li class="treeview no-b"><a href={{URL::to('inbox')}}>
                    <i class="icon icon-package light-green-text s-18"></i><span>Inbox (Update DACN 2)</span></a>
                </li>
                <li class="header light mt-3"><strong>ADVANCE</strong></li>
                <li class="treeview">
                    <a href={{URL::to('calendar')}}>
                        <i class="icon icon-calendar-o text-lime s-18"></i> <span>Calender (Update DACN 2)</span>
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
                                <img src="{{asset('assets/img/dummy/u13.png')}}" class="user-image" alt="User Image">
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var id_category = $(this).val();
            var _token =  $('input[name="_token"]').val();
            var result = '';
            if (action == 'category') {
                result = 'subcategory';
            }
             $.ajax({
                url : '{{url('/seller/select_category')}}',
                 method : 'POST',
                data:{action:action,id_category:id_category,_token:_token},
                success:function(data){
                    console.log(data);
                     $('#'+result).html(data);
                 }
             })
        });

    })
</script>
</body>

</html>