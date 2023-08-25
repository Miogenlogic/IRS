<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Gainwell - Incident Information System</title>
    <!-- ================== jQuery ================== -->
    <script src="{{URL::asset('public/assets/js/jquery.min.js')}}"></script>
    <!-- =================== bootstrap =================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/bootstrap.min.css')}}" type="text/css">
    <script src="{{URL::asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ================== font-awesome ================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/font-awesome.min.css')}}" type="text/css">
    <!-- =================== animation =================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/animations.min.css')}}" type="text/css">
    <script src="{{URL::asset('public/assets/js/animations.min.js')}}"></script>
    <!-- ================== Back To Top ================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/bk_ttop.css')}}" type="text/css">
    <script src="{{URL::asset('public/assets/js/move-top.js')}}"></script>
    <script src="{{URL::asset('public/assets/js/easing.js')}}"></script>
    <!-- ==================== google font ==================== -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!-- ==================== my css ==================== -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{URL::asset('public/assets/css/responsive.css')}}" type="text/css">
</head>

<body>
 <header>
        <!-- start header-top -->
        <!--<div class="header-top d-none d-md-block">-->
        <div class="header-top clearfix">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="header-left">
                            <a href="tel:18004193356"><i class="fa fa-phone circle-icon"></i> Toll Free: 1800 419 3356</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ul class="social-icons float-sm-right">
                            <li><a href="https://www.facebook.com/gainwellcat" target="_blank"><i class="fa fa-facebook circle-icon" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/gainwellcat" target="_blank"><i class="fa fa-twitter circle-icon" aria-hidden="true"></i></a></li>
                            <li><a href="https://linkedin.com/company/gainwellcat/" target="_blank"><i class="fa fa-linkedin circle-icon" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.youtube.com/c/GainwellCAT" target="_blank"><i class="fa fa-youtube-play circle-icon" aria-hidden="true"></i></a></li>
                            <li><a href="https://instagram.com/gainwellcat/" target="_blank"><i class="fa fa-instagram circle-icon" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header-top -->
        <!-- start header-navbar -->
        <div class="header-navbar">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-logo1" href="#"><img src="{{URL::asset('public/assets/img/logo.gif')}}" alt=""></a>
                    <a class="navbar-logo2 d-none d-lg-block" href="#"><img src="{{URL::asset('public/assets/img/cat75.png')}}" alt=""></a>
                    <a class="navbar-logo3 d-block ml-auto" href="#"><img src="{{URL::asset('public/assets/img/gcpl_sml_logo.png')}}" alt=""></a>
                </div>
            </nav>
        </div>
        <!-- end header-navbar -->
    </header>

    <!-- ========================= start login-form ========================= -->
    <section class="login-form">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
            <div class="card form-inner">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-5">
						 @if(Session::has('msg'))
                         <div style="color: red;font-size: 16px;display: inline-block;">{{ Session::get('msg') }}</div>
                        @endif
                            <form action="{{url('loginchk')}}" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Employee ID</label>
                                    <input name="username" type="text" class="form-control" placeholder="Enter Employee ID" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input name="password" type="password" class="form-control" placeholder="Enter Password" required>
                                </div>
                                 <input type="hidden" name="_token" value="{{csrf_token()}}"/> 
								 <div class="form-group">
                                    <label for="">Select Role</label>
									@php $roles = App\Helpers\UserHelper::GetRoles(); @endphp
                                    <select class="form-control" name="role_id" required> 
									<option value="">Please Select</option>
									@foreach($roles as $data)
										<option value="{{$data->id}}" >{{$data->display_name}}</option> 
									@endforeach 
									</select>
                                </div>
                                <div class="clearfix btn-div">
                                    <button type="submit" class="btn-Dark">Login</button>
                                    <a href="{{url('forgotpass')}}" class="ml-3">Forgot Password?</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================= end login-form ========================= -->


        <!-- Footer -->
 <footer>
        <div class="container-fluid">
            <ul class="d-lg-flex justify-content-lg-between">
                <li>
                    <ul class="link-list">
                        <li>
                            <a href="http://www.gainwellindia.com/privacy_policy" target="_blank">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="http://www.gainwellindia.com/cookie-policy" target="_blank">Cookie Policy</a>
                        </li>
                        <li>
                            <a href="http://www.gainwellindia.com/disclaimer" target="_blank">Discalimer</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="footer-middle">
                        <p>Give a Missed Call at: <a href="tel:08081112244">08081112244</a> © 2020 GCPL, All rights reserved.</p>
                    </div>
                </li>
                <li>
                    <div class="copyright">                       
                    </div>
                </li>
            </ul>
        </div>
    </footer>
    <!-- ================================ end footer ================================ -->



    <!-- =================== start back to top =================== -->
    <script type="text/javascript">
        $(document).ready(function() {
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear'
            };

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });

    </script>
    <a href="#" id="toTop" class="hover-bounce"></a>
    <!-- =================== end back to top =================== -->

    <!-- ================== bootstrap tooltip ================== -->
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>

</body>

</html>
