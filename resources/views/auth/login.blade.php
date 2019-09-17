@extends('frontend.include.layout')

<!--section-->
@section('after_header')
@endsection
<!--//section-->

<!--section-->
@section('body')

    <div class="page-content">
        <div class="section dashboard">
            <div class="container">
                <div class="text-center mb-2  mb-md-3 mb-lg-4">
                    <div class="h-sub theme-color">Login to</div>
                    <h1>My Account</h1>
                    <div class="h-decor"></div>
                </div>

                <!-- Login Container -->
                <div class="row">
                    <div class="col-md-5 m-auto">
                        <div class="login-reg">
                            <form method="post" action="{{url('loginchk')}}">
                                <div class="form-group">
                                    <label>Email / Username</label>
                                    <input class="form-control" placeholder="Email or Username" name="username" type="text">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>

                                <div class="form-group">
                                    <a href="#">Forgot Password?</a>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection
<!--footer-->
<!--//footer-->



