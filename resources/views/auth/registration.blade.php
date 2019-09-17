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
									<form>
										<div class="form-group">
											<label>Email / Username *</label>
											<input class="form-control" placeholder="Email or Username" type="text">
										</div>
										<div class="form-group">
											<label>Password *</label>
											<input class="form-control" placeholder="Password" type="password">
										</div>
										<div class="form-group">
											<label>Mobile</label>
											<input class="form-control" placeholder="phone" type="text">
										</div>


										<div class="form-group">
											<button class="btn btn-secondary btn-sm">Reset</button>
											<button class="btn btn-primary btn-sm">Register Now</button>
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




