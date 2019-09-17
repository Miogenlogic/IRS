<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Rimpi Das">
    <meta name="format-detection" content="telephone=no">
    <title>BioPed Clinic | Hyperbaric Oxygen Therapy (HBOT) Clinic in Kolkata</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/vendor/slick/slick.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/vendor/animate/animate.min.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/icons/style.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/css/style.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/css/custom.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/color/color.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('public/assets/frontend/css/user-module.css')}}" >
    <!--Favicon-->
    <link rel="icon" href="{{URL::asset('public/assets/frontend/images/logo.jpeg')}}" type="image/x-icon">
    <!--<link rel="icon" href="{{URL::asset('public/assets/frontend/images/favicon.png')}}" type="image/x-icon">-->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    @yield('after_styles')
</head>

<body class="shop-page"><!--header-->
<header class="header">
    @include('frontend.include.header')
    @yield('after_header')
</header>

@yield('body')

@include('frontend.include.footer')

@yield('after_scripts')
</body>
</html>
