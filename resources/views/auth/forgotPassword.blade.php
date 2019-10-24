@extends('frontend.include.layout')

		<!--section-->
		@section('after_header')
		  <div class="section mt-0">
			<div class="breadcrumbs-wrap">
				<div class="container">
					<div class="breadcrumbs">
						<a href="{{url('/')}}">Home</a>
						<span>Forgot Password Link</span>
					</div>
				</div>
			</div>
		   </div>
	    @endsection
		<!--//section-->
@php
	//$userSession=Session::get('user');
	//$country=App\Helpers\UserHelper::country();
    //dd($userSession);
@endphp
		<!--section-->
		@section('body')

			<div class="page-content">
				@if(Session::has('message'))
					<div class="alert alert-warning alert-dismissible fade show" role="alert" style="text-align: center;
    font-weight: 700;">
						{{ Session::get('message') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				<!--section dashboard-->
				<div class="section dashboard">
					<div class="container" style="margin: 0px">
						<div class="text-center mb-2  mb-md-3 mb-lg-4">
							<div class="h-sub theme-color"></div>
							<h1>Provide Your Email</h1>
							<div class="h-decor"></div>
						</div>

						<!-- Login Container -->
						<div class="row">
							<div class="col-md-5 m-auto">
								<div class="login-reg">
									<form method="post" action="{{url('reset-mail')}}" enctype="multipart/form-data">

										<div class="form-group">
											<label>Email*</label>
											<input name="email" class="form-control" placeholder="Email or Username" type="text">
											@if($errors->has('email'))
												<span class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</span>
											@endif
										</div>


										<div class="form-group">

											<input type="hidden" name="_token" value="{{csrf_token()}}">
											<button  type="submit"  class="btn btn-outline-success">Send </button>


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
@section("after_scripts")


@endsection

