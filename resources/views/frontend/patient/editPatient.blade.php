@extends('frontend.include.layout')
@php
//print_r($user_session);die;
@endphp
		<!--section-->
		@section('after_header')
		  <div class="section mt-0">
			<div class="breadcrumbs-wrap">
				<div class="container">
					<div class="breadcrumbs">
						<a href="{{url('/')}}">Home</a>
						<span>Edit Profile</span>
					</div>
				</div>
			</div>
		   </div>
	    @endsection
		<!--//section-->

		<!--section-->
		@section('body')

			<div class="page-content">
				<div class="section dashboard">
					<div class="container">
						<div class="text-center mb-2  mb-md-3 mb-lg-4">
							<div class="h-sub theme-color">Welcome to</div>
							<h1>Your Profile</h1>
							<div class="h-decor"></div>
						</div>
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
										<a href="{{url('edit-profile')}}" class="btn btn-success btn-sm btn-outline-red">Edit Profile</a>

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
												<a href="{{url('edit-profile')}}">Edit Profile </a>
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
										<form method="post" action="{{url('/edit-profile-save')}}" enctype="multipart/form-data">

											<div class="row">
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="pwd">Name</label>
														<input type="text" class="form-control" id="" placeholder="" name="name" value="{{old('name')?old('name'):$Patient->name}}">
														@if($errors->has('name'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
														@endif
													</div>
												</div>
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="pwd">Image</label>
														<input type="file" class="form-control" id="" placeholder="" name="image" value="{{old('image')?old('image'):$Patient->image}}">
														@if($Patient['image']!='')

															<img src="{{asset('public/assets/uploads/patient/image').'/'.$Patient->image}}"  style="width:100px;height:100px;margin-top: 10px;">

														@endif
														@if($errors->has('image'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('image')}}</div>
														@endif
													</div>

												</div>
											</div>
											<div class="row">
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="option">Phone</label>
														<input type="text" class="form-control" id="" placeholder="" name="phone" value="{{old('phone')?old('phone'):$Patient->phone}}">
														@if($errors->has('phone'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('phone')}}</div>
														@endif
													</div>

												</div>
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Email</label>
														<input type="text" class="form-control" id="" placeholder="" name="email" value="{{old('email')?old('email'):$Patient->email}}">
														@if($errors->has('email'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</div>
														@endif
													</div>

												</div>
											</div>

											<div class="row">
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Age</label>
														<input type="text" class="form-control" id="" placeholder="" name="age" value="{{old('age')?old('age'):$Patient->age}}">
														@if($errors->has('age'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('age')}}</div>
														@endif
													</div>

												</div>
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Gender</label>
														<select name="gender" class="form-control">
															<option value="MALE" {{old('gender')=='MALE'?'Selected':($Patient->gender=='MALE'?'Selected':'')}}>MALE</option>
															<option value="FEMALE" {{old('gender')=='FEMALE'?'Selected':($Patient->gender=='FEMALE'?'Selected':'')}}>FEMALE</option>
														</select>
													</div>

												</div>
											</div>

											<div class="row">
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Country</label>
															<select name="country" class="form-control">
																@foreach($country as $coun)
																	<option value="{{$coun->country}}" {{(old('country')==$Patient->country)? 'selected':($coun->country==$Patient->country?'Selected':'')}}>{{$coun->country}}</option>
                                                                @endforeach

															</select>
													</div>
												</div>

												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="pwd">State</label>
														<input type="text" class="form-control" id="" placeholder="" name="state" value="{{old('state')?old('state'):$Patient->state}}">
														@if($errors->has('state'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('state')}}</div>
														@endif
													</div>

												</div>
											</div>
											<div class="row">
												<div class="col-md-12" style="clear:both">
													<div class="form-group">
														<label for="address">Address</label>
                                                           <textarea type="text" class="form-control" id="address" placeholder="" name="address">{{old('address')?old('address'):$Patient->address}}</textarea>
														@if($errors->has('address'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('address')}}</div>
														@endif
													</div>
												</div>
											</div>


											<div class="row">
												<div class="col-md-12" style="clear:both">
													<div class="form-group">
														<input type="hidden" name="id" value="{{$Patient->id}}">

														<input type="hidden" name="_token" value="{{csrf_token()}}">
														<button  type="submit" class="btn btn-outline-success">Submit</button>
														<button  type="cancel" class="btn btn-outline-danger">Cancel</button>
													</div>
												</div>
											</div>

										</form>

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






