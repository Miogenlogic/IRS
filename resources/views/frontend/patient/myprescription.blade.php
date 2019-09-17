@extends('frontend.include.layout')

		<!--section-->
		@section('after_header')
		  <div class="section mt-0">
			<div class="breadcrumbs-wrap">
				<div class="container">
					<div class="breadcrumbs">
						<a href="{{url('/')}}">Home</a>
						<span>My Prescription</span>
					</div>
				</div>
			</div>
		   </div>
	    @endsection
		<!--//section-->

		<!--section-->
		@section('body')


			<div class="quickLinks-wrap js-quickLinks-wrap-d d-none d-lg-flex">
				<div class="sticky-wrapper"><div class="quickLinks js-quickLinks">
						<div class="container">
							<div class="row no-gutters">

							<!--<div class="col">
                                    <a href="#" class="link">
                                        <i class="icon-clock"></i><span>{{$homeSection7->title}}</span>
                                    </a>
                                   <div class="link-drop">
                                        <h5 class="link-drop-title"><i class="icon-clock"></i>{{$homeSection7->title}}</h5>

                                          {!! $homeSection7->content  !!}
									</div>
                                </div>


                                <div class="col">
                                    <a href="#" class="link">
                                        <i class="icon-emergency-call"></i><span>{{$homeSection8->title}}</span>
                                    </a>
                                    <div class="link-drop">
                                        <h5 class="link-drop-title"><i class="icon-emergency-call"></i>{{$homeSection8->title}}</h5>
                                    {!! $homeSection8->content  !!}
									</div>
                                </div>-->


								<div class="col">
									<a href="#" class="link" data-toggle="modal" data-target="#modalBookingForm">
										<i class="icon-pencil-writing"></i><span>Book an Appointment</span>
									</a>
								<!--<div class="link-drop">
                                        <h5 class="link-drop-title"><i class="icon-pencil-writing"></i>Request Form</h5>
                                        <div class="alert alert-danger print-error-msg" style="display:none">
                                            <ul></ul>
                                        </div>
                                        <form id="requestForm">
                                            <div class="successform">
                                                <p>Your message was sent successfully!</p>
                                            </div>
                                            <div class="errorform">
                                                <p>Something went wrong, try refreshing and submitting the form again.</p>
                                            </div>
                                            <div class="input-group">
                                                <span>
                                                <i class="icon-user"></i>
                                            </span>
                                                <input name="requestname" type="text" class="form-control" placeholder="Your Name*">

                                            </div>
                                            <span id="error_requestname" style="display: none;">Field is required</span>
                                            <div class="row row-sm-space mt-1">
                                                <div class="col">
                                                    <div class="input-group">
                                                        <span>
                                                        <i class="icon-email2"></i>
                                                    </span>
                                                        <input name="requestemail" type="text" class="form-control" placeholder="Your Email*">

                                                    </div>
                                                    <span id="error_requestemail" style="display: none;">Field is required</span>
                                                </div>
                                                <div class="col">
                                                    <div class="input-group">
                                                        <span>
                                                        <i class="icon-smartphone"></i>
                                                    </span>
                                                        <input name="requestphone" type="text" class="form-control" placeholder="Your Phone*">

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="selectWrapper input-group mt-1">
                                                <span>
                                                <i class="icon-tooth"></i>
                                            </span>
                                                <select name="requestservice" class="form-control">
                                                    <option selected="selected" disabled="disabled">Select Service</option>
                                                    <option value="Cosmetic Dentistry">Cosmetic Dentistry</option>
                                                    <option value="General Dentistry">General Dentistry</option>
                                                    <option value="Orthodontics">Orthodontics</option>
                                                    <option value="Children`s Dentistry">Children`s Dentistry</option>
                                                    <option value="Dental Implants">Dental Implants</option>
                                                    <option value="Dental Emergency">Dental Emergency</option>
                                                </select>

                                            </div>
                                            <span id="error_requestservice" style="display: none;">Field is required</span>
                                            <div class="row row-sm-space mt-1">
                                                <div class="col-sm-6">
                                                    <div class="input-group flex-nowrap">
                                                        <span>
                                                            <i class="icon-calendar2"></i>
                                                        </span>
                                                        <div class="datepicker-wrap">
                                                            <input name="requestdate" type="text" class="form-control datetimepicker" id="datepicker" placeholder="date" value="">
                                                            <span id="error_requestdate" style="display: none;">Field is required</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mt-1 mt-sm-0">
                                                    <div class="input-group flex-nowrap">
                                                        <span>
                                                                <i class="icon-clock"></i>
                                                        </span>
                                                        <div class="datepicker-wrap">
                                                            <input name="requesttime" type="text" class="form-control timepicker" placeholder="Time" readonly="">
                                                            <span id="error_requesttime" style="display: none;">Field is required</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right mt-2">
                                                <button type="button" onclick="requestForm();" class="btn btn-sm btn-hover-fill">Request</button>
                                            </div>
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        </form>
                                    </div>-->
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
										<img src="https://pbs.twimg.com/profile_images/974736784906248192/gPZwCbdS.jpg" class="img-responsive" alt="">
									</div>
									<!-- END SIDEBAR USERPIC -->
									<!-- SIDEBAR USER TITLE -->
									<div class="profile-usertitle">
										<div class="profile-usertitle-name">
											John Doe
										</div>
										<div class="profile-usertitle-job">
											<div><i class="icon-email"></i> email@domain.com</div>
											<div class="mt-5"><i class="icon-phone"></i> 0123456789</div>
										</div>
									</div>
									<!-- END SIDEBAR USER TITLE -->
									<!-- SIDEBAR BUTTONS -->
									<div class="profile-userbuttons">
										<a href="edit-profile.html" class="btn btn-success btn-sm btn-outline-red">Edit Profile</a>

										<button type="button" class="btn btn-danger btn-sm btn-logout">Log Out</button>
									</div>
									<!-- END SIDEBAR BUTTONS -->
									<!-- SIDEBAR MENU -->
									<div class="profile-usermenu">
										<ul class="nav">
											<li class="active">
												<a href="{{url('my-dashboard')}}">My Dashboard </a>
											</li>
											<li>
												<a href="manage-profile.html">Manage Profile </a>
											</li>
											<li>
												<a href="{{url('appointments')}}">Appointments </a>
											</li>
											<li>
												<a href="{{url('reschedule-appointments')}}">Re-Schedule Appointments </a>
											</li>
										</ul>
									</div>
									<!-- END MENU -->
								</div>
							</div>
							<div class="col-md-9">
								<!-- Content for Profile -->
								<div class="profile-content">
									<div class="table-record responsive-tbl">

										<table class="table">
											<thead>
											<tr>
												<th scope="col">Date</th>
												<th scope="col">Doctor</th>
												<th scope="col">Appointment Type</th>
												<th scope="col">Download</th>
											</tr>
											</thead>
											<tbody>
											<tr>
												<td data-label="Date">01.03.2019</td>
												<td data-label="Doctor">Dr. John Doe</td>
												<td data-label="Appointment Type">Virtual Consultation</td>
												<td data-label="Status"><a href="#" class="badge badge-success"><i class="icon-download"></i> Download</a></td>
											</tr>
											<tr>
												<td scope="row" data-label="Date">01.03.2019</td>
												<td data-label="Doctor">Dr. John Doe</td>
												<td data-label="Appointment Type">Virtual Consultation</td>
												<td data-label="Status"><a href="#" class="badge badge-success"><i class="icon-download"></i> Download</a></td>
											</tr>
											</tbody>
										</table>
									</div>
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



