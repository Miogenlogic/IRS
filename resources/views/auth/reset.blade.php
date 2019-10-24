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
                    <div class="h-sub theme-color">Reset Password Response</div>
                <div class="row">
                    <div class="col-md-5 m-auto">
                        <div class="login-reg">
                            @if(Session::has('msg'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;
    font-weight: 700;">
                                    {{ Session::get('msg') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if($msg=="error")
                                Reset failed.
                            @elseif($msg=="success")
                                Please check your mail for reset password.
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




