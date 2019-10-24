@extends('frontend.include.layout')

<!--section-->
@section('after_header')
    <div class="section mt-0">
        <div class="breadcrumbs-wrap">
            <div class="container">
                <div class="breadcrumbs">
                    <a href="{{url('/')}}">Home</a>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
@endsection
<!--//section-->

<!--section-->
@section('body')

    <div class="page-content">

        <!--section dashboard-->
        <div class="section dashboard">
            <div class="container" style="margin: 0px">
                <div class="text-center mb-2  mb-md-3 mb-lg-4">
                    <div class="h-sub theme-color">Registration Validation Response</div>
                <div class="row">
                    <div class="col-md-5 m-auto">
                        <div class="login-reg">
                            @if($msg=="error")
                                Registration failed.
                            @elseif($msg=="success")
                                Done successfully.
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--//section services-->
    </div>



@endsection
<!--footer-->
<!--//footer-->




