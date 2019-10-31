@extends('frontend.include.layout')

		<!--section-->
		@section('after_header')
		  <div class="section mt-0">
			<div class="breadcrumbs-wrap">
				<div class="container">
					<div class="breadcrumbs">
						<a href="{{url('/')}}">Home</a>
						<span>My Appointments</span>
					</div>
				</div>
			</div>
		   </div>
	    @endsection
@php
	$user_session=Session::get('user');
	//$country=App\Helpers\UserHelper::country();
    //dd($user_session);
@endphp
		<!--//section-->
@section('after_styles')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

@endsection
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
											<div><i class="icon-email"></i> {{$user_session['email']}}</div>
											<div class="mt-5"><i class="icon-phone">{{$user_session['user_type']}}</i></div>
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
									<div class="table-record responsive-tbl">
										<div class="push-right mb-15">
											<a href="#" class="link" data-toggle="modal" data-target="#modalBookingForm">
												<i class="icon-pencil-writing"></i><span>Book an Appointment</span>
											</a>

										</div>

										<div class="table-responsive">
											<table class="table table-condensed dataTable no-footer" id="tabe1">
												<thead>
												<tr class="bg-light">
													<!--<td>#</td>-->
													<td>Confirmed Date</td>
													<td>Confirmed Time</td>
													<td>Name</td>
													<td>Status</td>
													<td>Doctor</td>
													<td>Service</td>
													<td>Type</td>
													<!--<td>Email</td>
                                                    <td>Phone</td>

													<td>Created At</td>
													<td>Action</td>-->
												</tr>
												</thead>
											</table>
										</div>
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

@section('after_scripts')

	<script  src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>



	<script>

        $(document).ready(function(){
            $('#tabe1').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("/appointment-get-table") }}',
                },

                columns: [
                    //{data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'confirmed_date', name: 'confirmed_date'},
                    {data: 'confirmed_time', name: 'confirmed_time'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    // {data: 'phone', name: 'phone'},
                   {data: 'doctor_name', name: 'doctor_name'},
                    {data: 'service', name: 'service'},
                    {data: 'type', name: 'type'},
                    //{data: 'created_at', name: 'created_at'},
                    //{data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],


                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
	</script>



@endsection



