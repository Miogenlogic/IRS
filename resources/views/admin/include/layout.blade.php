
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
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.css')}}" >

    <!-- Custom Main CSS -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/css/main.css')}}">
    <!-- Page specific Style :: Date Range Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- endinject -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{URL::asset('public/assets/admin/images/favicon.png')}}" />
{{--TIME PICKER--}}
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

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
<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/moment.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/moment.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<link rel="stylesheet" href="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.css')}}" >

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
