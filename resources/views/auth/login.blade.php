<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/basic/favicon.ico" type="image/x-icon">
    <title>Login to Tika System</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="light">
<div id="app">
<main>
    <div id="primary" class="blue4 p-t-b-100 height-full responsive-phone">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-t-100">
                    <div class="text-white">
                        <h1>Welcome Back</h1>
                        {{-- <p class="s-18 p-t-b-20 font-weight-lighter">Welcome back my boss !</p> --}}
                    </div>
                    <form action={{URL::to('login')}} method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                                    <input type="text" name="email" class="form-control form-control-lg no-b"
                                           placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group has-icon"><i class="icon-user-secret"></i>
                                    <input type="text" name="password" class="form-control form-control-lg no-b"
                                           placeholder="Password">
                                </div>
                            </div>
                            <div class="col-lg-12">
                            <?php
                                $message = Session::get('message');
                                if (isset($message)) {
                                    echo '<p class="text-red text-center"><strong>'.$message.'</strong></p>';
                                    Session::put('message',null);
                                }?>
                            </div>

                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-success btn-lg btn-block" value="Login now !">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #primary -->
</main>
</div>
<script src="assets/js/app.js"></script>
</body>
</html>