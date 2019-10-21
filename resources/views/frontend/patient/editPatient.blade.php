@extends('frontend.include.layout')
@php
	$country=App\Helpers\UserHelper::country();
 // print_r($Patient);die;
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
@php
	$user_session=Session::get('user');
	//$country=App\Helpers\UserHelper::country();
    //dd($user_session);
@endphp
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
											{{$user_session['name']}}
										</div>
										<div class="profile-usertitle-job">
											<div><i class="icon-email"></i>  {{$user_session['email']}}</div>
											<div class="mt-5"><i class="icon-phone"></i>{{$user_session['user_type']}}</div>
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
										<form method="post" action="{{url('/edit-profile-save')}}" enctype="multipart/form-data">

											<div class="row">
												<div class="col-md-12">
													<h4 style="padding:2px;" class="card-title"> Edit User</h4>
												</div>
											</div>


											<div class="row">
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Name</label>
														<input type="text" class="form-control" id="" placeholder="" name="name" value="{{old('name')?old('name'):$Patient->name}} ">
														@if($errors->has('name'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
														@endif
													</div>
												</div>
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="pwd">Email</label>
														<input type="text" class="form-control" id="" placeholder="" name="email" value="{{old('email')?old('email'):$profile->email}} ">
														@if($errors->has('email'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</div>
														@endif
													</div>
												</div>
											</div>
												<div class="row">
													<div class="col-md-6" style="clear:both">
														<div class="form-group">
															<label for="pwd">Username</label>
															<input type="text" class="form-control" id="" placeholder="" name="username" value="{{old('username')?old('username'):$profile->username}} ">
															@if($errors->has('username'))
																<div class="invalid-feedback" style="display:block;">{{$errors->first('username')}}</div>
															@endif
														</div>
													</div>
													<div class="col-md-6" style="clear:both">
														<div class="form-group">
															<label for="email">Password</label>
															<input type="text" class="form-control" id="" placeholder="" name="password" >
														</div>
													</div>
											    </div>





											<div class="row">
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Status</label>
														<select name="status" class="form-control">
															<option value="Active" {{old('status')=='Active'?'Selected':($profile->status=='Active'?'Selected':'')}}>Active</option>
															<option value="Inactive" {{old('status')=='Inactive'?'Selected':($profile->status=='Inactive'?'Selected':'')}}>Inactive</option>
														</select>
													</div>
												</div>

												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Age</label>
														<input type="text" class="form-control datepicker" id="" placeholder="" name="age" value="{{old('age')?old('age'):$Patient->age}} ">
														@if($errors->has('age'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('age')}}</div>
														@endif
													</div>
												</div>
											</div>
											<div class="row">
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




												<div class="col-md-6" style="clear:both;margin-bottom:1rem;font-size: 0.875rem;">
													<div class="form-group" style="margin-bottom:0.5rem">
														<label for="pwd">Gender</label>
														<select name="gender" class="form-control">
															<option value="MALE" {{old('gender')=='MALE'?'Selected':($Patient->gender=='MALE'?'Selected':'')}}>MALE</option>
															<option value="FEMALE" {{old('FEMALE')=='FEMALE'?'Selected':($Patient->gender=='FEMALE'?'Selected':'')}}>FEMALE</option>
														</select>
													</div>

												</div>

											</div>


											<div class="row">
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Country</label>
														<select name="usercountry" id="usercountry" class="form-control">

															<option selected="selected" disabled="disabled">Select Country For Phonecode</option>
															@foreach($country as $wks)
																<option value="{{$wks->id.'-'.$wks->phonecode}}" {{(old('country_id')==$Patient->country_id)? 'selected':($wks->phonecode==$Patient->country_id?'Selected':'')}}>{{$wks->country}}</option>


															@endforeach
														</select>
													</div>
												</div>


												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label style="position: relative;
    right: 54px;" for="email">Mobile</label>
														<input style="margin-top: 27px;
    width: 12%;
    float: left;" type="text" id="xyz" class="form-control" value="{{old('country_id')?old('country_id'):$Patient->country_id}}" readonly >
														<input style="  width: 88%;
    float: left;" type="text" class="form-control" id="" placeholder="enter" name="phone" value="{{old('phone')?old('phone'):$Patient->phone}} ">

														@if($errors->has('phone'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('phone')}}</div>
														@endif
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6" style="clear:both">
													<div class="form-group">
														<label for="email">Address</label>
														<textarea class="form-control" rows="4" id="" placeholder="" name="address" >{{old('address')?old('address'):$Patient->address}}</textarea>
														@if($errors->has('address'))
															<div class="invalid-feedback" style="display:block;">{{$errors->first('address')}}</div>
														@endif
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12" style="clear:both">
													<div class="form-group">
														<input type="hidden" name="id" value="{{$profile->id}}">
														<!--<input type="hidden" name="id" value="{-{$Patient['id']}}">-->
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

@section('after_scripts')
	<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'//,
            //startDate: 'd'
        });
    </script>-->
	<script type="text/javascript">
        $("#usercountry").change(function(){
            var countryCode=$(this).val();
            var res = countryCode.split("-");
            $("#xyz").val('+'+res[1]);
        });
	</script>



@endsection






