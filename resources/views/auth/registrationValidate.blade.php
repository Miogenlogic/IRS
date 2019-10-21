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
                            <form action="{{url('registration-validation-check')}}" method="post">
                                <div class="form-group">
                                    <label>Provide Your New Password</label>

                                    <input name="password" id="password" class="form-control" placeholder="Password" type="password">
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('password')}}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input name="password_confirmation" class="form-control" placeholder="confirmed password" type="password">
                                    @if($errors->has('password_confirmation'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('password_confirmation')}}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-secondary btn-sm">Reset</button>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="str" value="{{$str}}">
                                    <input class="btn btn-sm btn-hover-fill mt-10 submit" type="submit" name="submit" value="Submit"/>
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




