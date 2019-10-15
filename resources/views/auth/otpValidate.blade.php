@extends('frontend.include.layout')

<!--section-->
@section('after_header')
    <div class="section mt-0">
        <div class="breadcrumbs-wrap">
            <div class="container">
                <div class="breadcrumbs">
                    <a href="{{url('/')}}">Home</a>
                    <span>OTP Validate</span>
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
                    <div class="h-sub theme-color">OTP Validate</div>
                    <h1></h1>
                    <div class="h-decor"></div>
                </div>

                <!-- Login Container -->
                <div class="row">
                    <div class="col-md-5 m-auto">
                        <div class="login-reg">
                            <form id="otpmail">
                                <!--<div class="form-group">
                                    <label>Name*</label>
                                    <input name="name" class="form-control" placeholder="Name" type="text">

                                </div>-->
                                <div class="form-group">
                                    <label>Email / Username*</label>
                                    <input name="email" class="form-control" placeholder="Email or Username" type="hidden" value="">

                                </div>
                                <div class="form-group">
                                    <label>OTP</label>
                                    <input name="otp" class="form-control" placeholder="otp" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Old Password</label>

                                    <input name="password" class="form-control" placeholder="Password" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>

                                    <input name="password" class="form-control" placeholder="Password" type="password">
                                </div>
                                <!--<div class="form-group">
                                    <label>Address</label>
                                    <input name="address" class="form-control" placeholder="Address" type="text">
                                </div>-->

                                <div class="form-group">
                                    <button class="btn btn-secondary btn-sm">Reset</button>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input class="btn btn-sm btn-hover-fill mt-10 submit" type="submit" name="submit" value="Register Now"/>

                                </div>
                            </form>
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




