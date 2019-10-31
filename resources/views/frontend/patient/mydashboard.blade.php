@extends('frontend.include.layout')

		<!--section-->
		@section('after_header')
		  <div class="section mt-0">
			<div class="breadcrumbs-wrap">
				<div class="container">
					<div class="breadcrumbs">
						<a href="{{url('/')}}">Home</a>
						<span>My Dashboard</span>
					</div>
				</div>
			</div>
		   </div>
	    @endsection
		<!--//section-->
@php
	$user_session=Session::get('user');
           //dd($user_session);die;
@endphp

		<!--section-->
		@section('body')


			<div class="quickLinks-wrap js-quickLinks-wrap-d d-none d-lg-flex">
				<div class="sticky-wrapper"><div class="quickLinks js-quickLinks">
						<div class="container">
							<div class="row no-gutters">

								<div class="col">
									<a href="#" class="link" data-toggle="modal" data-target="#modalBookingForm">
										<i class="icon-pencil-writing"></i><span>Book an Appointment</span>
									</a>

								</div>

								<div class="col col-close"><a href="#" class="js-quickLinks-close"><i class="icon-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Close panel"></i></a></div>
							</div>
						</div>
						<div class="quickLinks-open js-quickLinks-open"><span data-toggle="tooltip" data-placement="left" title="" data-original-title="Open panel">+</span></div>
					</div></div>
			</div>

			<div class="page-content">

				<!--section dashboard-->
				<div class="section dashboard">
					<div class="container">
						<div class="text-center mb-2  mb-md-3 mb-lg-4">
							<div class="h-sub theme-color">Welcome to</div>
							<h1>Your Dashboard</h1>
							<div class="h-decor"></div>
						</div>


						<!-- User Dashboards -->
						<div class="row profile">
							<div class="col-md-3"  id="sidebar">
								<div class="profile-sidebar">
									<!-- SIDEBAR USERPIC -->
									<div class="profile-userpic text-center">
										<img src="{{asset('public/assets/uploads/patient/image').'/'.$Patient->image}}" class="img-responsive" alt="">
									</div>
									<!-- END SIDEBAR USERPIC -->
									<!-- SIDEBAR USER TITLE -->
									<div class="profile-usertitle">
										<div class="profile-usertitle-name">
											{{$user_session['name']}}
										</div>
										<div class="profile-usertitle-job">
											<div><i class="icon-email"></i>  {{$user_session['email']}}</div>
											<div class="mt-5"><i class="icon-phone"></i>{{$user_session['user_type']}} </div>
										</div>
									</div>
									<!-- END SIDEBAR USER TITLE -->
									<!-- SIDEBAR BUTTONS -->
									<div class="profile-userbuttons">
										<a href="{{url('edit-profile')}}" class="btn btn-success btn-sm btn-outline-red">Edit Profile</a>

										<a href="{{ url('/logout') }}"><button type="button" class="btn btn-danger btn-sm btn-logout">Log Out</button></a>
									</div>
									<!-- END SIDEBAR BUTTONS -->
									<!-- SIDEBAR MENU -->
									<div class="profile-usermenu">
										<ul class="nav">
											<li class="active">
												<a href="{{url('my-dashboard')}}">My Dashboard </a>
											</li>
											<li>
												<a href="{{url('edit-profile')}}">Edit Profile </a>
											</li>
											<li>
												<a href="{{url('appointments')}}">Appointments </a>
											</li>
											<!--<li>
												<a href="{-{url('reschedule-appointments')}}">Re-Schedule Appointments </a>
											</li>-->
										</ul>
									</div>
									<!-- END MENU -->
								</div>
							</div>
							<div class="col-md-9">
								<!-- Content for Profile -->
								<div class="profile-content">
									<!-- Mass Link -->
									<div class="mass-link">
										<div>
											<h5>My Records</h5>
										</div>
										<div class="row">
											<div class="col-md-4">
												<a href="{{url('edit-profile/')}}" title="My Profile">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-user-1"></i> My Profile</h3>
														</div>
													</div>
												</a>
											</div>
											<div class="col-md-4">
												<a href="{{url('appointments')}}" title="My Appointments">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-calendar-7"></i> My Appointments</h3>
														</div>
													</div>
												</a>
											</div>
											<!--<div class="col-md-4">
												<a href="#" title="My Health Record">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-archive"></i> My Health Record</h3>
														</div>
													</div>
												</a>
											</div>
											<div class="col-md-4">
												<a href="{-{url('my-prescription')}}" title="My Prescription">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-doc-4"></i> My Prescription</h3>
														</div>
													</div>
												</a>
											</div>
											<div class="col-md-4">
												<a href="#" title="My Health Graph">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-chart-area"></i> My Health Graph</h3>
														</div>
													</div>
												</a>
											</div>
											<div class="col-md-4">
												<a href="{-{url('my-payment-history')}}" title="My Payment">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-money-2"></i> My Payment</h3>
														</div>
													</div>
												</a>
											</div>-->
										</div><!-- /row -->

										<!-- ******************************** -->
										<hr>

										<div>
											<h5>Get Appointments</h5>
										</div>
										<div class="row">
											<div class="col-md-4">
												<a href="#" class="link" data-toggle="modal" data-target="#modalBookingForm">


													<div class="card">
														<div class="card-body">
															<h3><i class="icon-calendar-7"></i> Book an Appointment</h3>
														</div>
													</div>
												</a>
											</div>
											<!--<div class="col-md-4">
												<a href="javascript:void(0);" title="Physical Appointment" data-toggle="modal" data-target="#AppointmentModal">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-calendar-7"></i> Physical Appointment</h3>
														</div>
													</div>
												</a>
											</div>
											<div class="col-md-4">
												<a href="javascript:void(0);" title="Diagnostic Appointemnt" data-toggle="modal" data-target="#AppointmentModal">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-calendar-7"></i> Diagnostic Appointemnt</h3>
														</div>
													</div>
												</a>
											</div>
											<div class="col-md-4">
												<a href="{-{url('reschedule-appointments')}}" title="Re-Schedule Appointment">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-undo"></i> Re-Schedule Appointment</h3>
														</div>
													</div>
												</a>
											</div>
											<div class="col-md-4">
												<a href="#" data-toggle="modal" data-target="#HealthRecordFile" title="Upload Health Record">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-archive"></i> Upload Health Record</h3>
														</div>
													</div>
												</a>
											</div>

											<div class="col-md-4">
												<a href="#" title="Re-Schedule Appointment">
													<div class="card">
														<div class="card-body">
															<h3><i class="icon-doc-add"></i> Sit Amet</h3>
														</div>
													</div>
												</a>
											</div>-->
										</div><!-- /row -->
									</div>
									<!--/ Mass Link-->
								</div>
							</div>
						</div>
						<!--/User Dashboard-->

					</div>
				</div>
				<!--//section services-->
			</div>




@endsection
	<!--footer-->
	<!--//footer-->



