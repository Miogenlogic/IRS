@extends('frontend.include.layout')

		<!--section-->
		@section('after_header')
		  <div class="section mt-0">
			<div class="breadcrumbs-wrap">
				<div class="container">
					<div class="breadcrumbs">
						<a href="{{url('/')}}">Home</a>
						<span>Registration</span>
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
							<div class="h-sub theme-color">Register to</div>
							<h1>Your Account</h1>
							<div class="h-decor"></div>
						</div>

						<!-- Login Container -->
						<div class="row">
							<div class="col-md-5 m-auto">
								<div class="login-reg">
									<form method="post" action="{{url('otp-mail')}}" enctype="multipart/form-data">
										<div class="form-group">
											<label>Name*</label>
											<input name="name" class="form-control" placeholder="Name" type="text">
											@if($errors->has('name'))
												<span class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</span>
											@endif
										</div>
										<div class="form-group">
											<label>Email / Username *</label>
											<input name="email" class="form-control" placeholder="Email or Username" type="text">
											@if($errors->has('email'))
												<span class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</span>
											@endif
										</div>

										<div class="form-group">
											<label>Mobile</label>
											<input name="phone" class="form-control" placeholder="phone" type="text">
											@if($errors->has('phone'))
												<span class="invalid-feedback" style="display:block;">{{$errors->first('phone')}}</span>
											@endif
										</div>
										<div class="form-group">
											<label>Address</label>
											<input name="address" class="form-control" placeholder="Address" type="text">
										</div>

										<div class="form-group">
											<button class="btn btn-secondary btn-sm">Reset</button>
											<input type="hidden" name="_token" value="{{csrf_token()}}">
											<button  type="submit"  class="btn btn-outline-success">Send </button>
											<!--<input class="btn btn-sm btn-hover-fill mt-10 submit" type="submit" name="submit" value="Register Now"/>-->

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




