<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="apple-touch-icon" sizes="76x76" href="/#">
    <link rel="icon" type="image/png" href="/#">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Gainwell - Incident Information System</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport">

    <!-- CSS Files -->
    <link href="{{URL::asset('public/assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/now-ui-kit.css')}}" rel="stylesheet">
    <!--Select2 css -->
    <link href="{{URL::asset('public/assets/css/select2.min.css')}}" rel="stylesheet">
    <!-- sweet alert-->
    <link href="{{URL::asset('public/assets/css/sweetalert2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/swal.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/datepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/css/incidentReporting.css')}}" rel="stylesheet">
    <!-- =============== custom css =============== -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('public/assets/css/custom.css')}}">
    
<style>
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.table thead th{
    font-weight: inherit;
}
.table td a{
    color: inherit;
}
.table td a:hover{
    text-decoration: none;
    color: blue;
}
strong{
    font-weight: inherit;
}
.input-group a{
    color: inherit;
}
.input-group a:hover{
    text-decoration: none;
    color: blue;
}
</style>



@yield('after_styles')

</head>
<body class="index-page sidebar-collapse" cz-shortcut-listen="true" ng-app="incidentApp">
@include('admin.include.header')

<div class="wrapper">
    <div class="main">
        <div class="main">

        @yield('body')

        </div>
    </div>

@include('admin.include.footer')

</div>

















<script src="{{URL::asset('public/assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('public/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('public/assets/js/popper.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('public/assets/js/bootstrap-switch.js')}}"></script>
<script src="{{URL::asset('public/assets/js/angular.js')}}"></script>
<script src="{{URL::asset('public/assets/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
<!-- <script src="../js/WOW.js"></script>         -->
<!-- <script src="../js/owl.carousel.min.js"></script>         -->
<script src="{{URL::asset('public/assets/js/kit.fontawesome.js')}}" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{URL::asset('public/assets/css/free-v4-shims.min.css')}}" media="all">
<link rel="stylesheet" href="{{URL::asset('public/assets/css/free-v4-font-face.min.css')}}" media="all">
<link rel="stylesheet" href="{{URL::asset('public/assets/css/free.min.css')}}" media="all">
<!-- <script src="../js/now-ui-kit.js" type="text/javascript"></script> -->
<script src="{{URL::asset('public/assets/js/sweetalert2.all.js')}}"></script>
<script src="{{URL::asset('public/assets/js/sweetalert2.js')}}"></script>
@yield('after_scripts')
</body>
</html>
