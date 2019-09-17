
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="author" content="Rimpi Das">
    <title>BioPed</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/vendors/css/vendor.bundle.addons.css')}}">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/css/style.css')}}">
    <!-- Custom Main CSS -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/css/main.css')}}">
    <!-- Page specific Style :: Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- endinject -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{URL::asset('public/assets/admin/images/favicon.png')}}" />


    @yield('after_styles')
</head>








@php
    //$data = Session::get('user');
@endphp

<body>
<!-- whole content should be wrapped by this div  -->
<div class="page-wrapper rk-theme toggled">
    @include('admin.include.sidebar')
    <main class="page-content">

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('admin.include.header')
                    {{--
                        <div class="quickLinks-wrap js-quickLinks-wrap-d d-none d-lg-flex">
                        <div class="sticky-wrapper"><div class="quickLinks js-quickLinks">
                                <div class="container">
                                    <div class="row no-gutters">

                                    <!--<div class="col">
                                    <a href="#" class="link">
                                        <i class="icon-clock"></i><span>{{$homeSection7->title}}</span>
                                    </a>
                                   <div class="link-drop">
                                        <h5 class="link-drop-title"><i class="icon-clock"></i>{{$homeSection7->title}}</h5>

                                          {!! $homeSection7->content  !!}
                                            </div>
                                        </div>


                                        <div class="col">
                                            <a href="#" class="link">
                                                <i class="icon-emergency-call"></i><span>{{$homeSection8->title}}</span>
                                    </a>
                                    <div class="link-drop">
                                        <h5 class="link-drop-title"><i class="icon-emergency-call"></i>{{$homeSection8->title}}</h5>
                                    {!! $homeSection8->content  !!}
                                            </div>
                                        </div>-->


                                        <div class="col">
                                            <a href="#" class="link" data-toggle="modal" data-target="#modalBookingForm">
                                                <i class="icon-pencil-writing"></i><span>Book an Appointment</span>
                                            </a>
                                        <!--<div class="link-drop">
                                        <h5 class="link-drop-title"><i class="icon-pencil-writing"></i>Request Form</h5>
                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                            <ul></ul>
                                        </div>
                                        <form id="requestForm">
                                            <div class="successform">
                                                <p>Your message was sent successfully!</p>
                                            </div>
                                            <div class="errorform">
                                                <p>Something went wrong, try refreshing and submitting the form again.</p>
                                            </div>
                                            <div class="input-group">
                                                <span>
                                                <i class="icon-user"></i>
                                            </span>
                                                <input name="requestname" type="text" class="form-control" placeholder="Your Name*">

                                            </div>
                                            <span id="error_requestname" style="display: none;">Field is required</span>
                                            <div class="row row-sm-space mt-1">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <span>
                                                        <i class="icon-email2"></i>
                                                    </span>
                                                        <input name="requestemail" type="text" class="form-control" placeholder="Your Email*">

                                                    </div>
                                                    <span id="error_requestemail" style="display: none;">Field is required</span>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group">
                                                        <span>
                                                        <i class="icon-smartphone"></i>
                                                    </span>
                                                        <input name="requestphone" type="text" class="form-control" placeholder="Your Phone*">

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="selectWrapper input-group mt-1">
                                                <span>
                                                <i class="icon-tooth"></i>
                                            </span>
                                                <select name="requestservice" class="form-control">
                                                    <option selected="selected" disabled="disabled">Select Service</option>
                                                    <option value="Cosmetic Dentistry">Cosmetic Dentistry</option>
                                                    <option value="General Dentistry">General Dentistry</option>
                                                    <option value="Orthodontics">Orthodontics</option>
                                                    <option value="Children`s Dentistry">Children`s Dentistry</option>
                                                    <option value="Dental Implants">Dental Implants</option>
                                                    <option value="Dental Emergency">Dental Emergency</option>
                                                </select>

                                            </div>
                                            <span id="error_requestservice" style="display: none;">Field is required</span>
                                            <div class="row row-sm-space mt-1">
                                                <div class="col-sm-6">
                                                    <div class="input-group flex-nowrap">
                                                        <span>
                                                            <i class="icon-calendar2"></i>
                                                        </span>
                                                        <div class="datepicker-wrap">
                                                            <input name="requestdate" type="text" class="form-control datetimepicker" id="datepicker" placeholder="date" value="">
                                                            <span id="error_requestdate" style="display: none;">Field is required</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-1 mt-sm-0">
                                                    <div class="input-group flex-nowrap">
                                                        <span>
                                                                <i class="icon-clock"></i>
                                                        </span>
                                                        <div class="datepicker-wrap">
                                                            <input name="requesttime" type="text" class="form-control timepicker" placeholder="Time" readonly="">
                                                            <span id="error_requesttime" style="display: none;">Field is required</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right mt-2">
                                                <button type="button" onclick="requestForm();" class="btn btn-sm btn-hover-fill">Request</button>
                                            </div>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        </form>
                                    </div>-->
                                        </div>

                                        <div class="col col-close"><a href="#" class="js-quickLinks-close"><i class="icon-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close panel"></i></a></div>
                                    </div>
                                </div>
                                <div class="quickLinks-open js-quickLinks-open"><span data-toggle="tooltip" data-placement="left" title="" data-original-title="Open panel">+</span></div>
                            </div></div>
                    </div>
                    --}}
                    @yield('body')
                </div>
                <!-- main-panel ends -->
                @include('admin.include.footer')
            </div>
            <!-- main-panel ends -->
        </div>
    </main>
</div>
<!-- plugins:js -->
<script src="{{URL::asset('public/assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{URL::asset('public/assets/admin/vendors/js/vendor.bundle.addons.js')}}"></script>

<script src="{{URL::asset('public/assets/admin/js/template.js')}}"></script>

@yield('after_scripts')
<script>
    //Sidebar init with fns
    jQuery(function ($) {

        $(".sidebar-dropdown > a").click(function() {
            $(".sidebar-submenu").slideUp(200);
            if (
                $(this)
                    .parent()
                    .hasClass("active")
            ) {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .parent()
                    .removeClass("active");
            } else {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                    .next(".sidebar-submenu")
                    .slideDown(200);
                $(this)
                    .parent()
                    .addClass("active");
            }
        });

        $("#close-sidebar").click(function() {
            $(".page-wrapper").removeClass("toggled");
        });
        $("#show-sidebar").click(function() {
            $(".page-wrapper").addClass("toggled");
        });




    });
</script>

</body>

</html>
