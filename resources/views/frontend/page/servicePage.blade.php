@extends('frontend.include.layout')
@php
	$userSession=Session::get('user');
	 $country=App\Helpers\UserHelper::country();
    //dd($userSession);
@endphp
		<!--section-->
		@section('after_header')
		<div class="section mt-0">
			<div class="breadcrumbs-wrap">
				<div class="container">
					<div class="breadcrumbs">
						<a href="{{url('/')}}">Home</a>
						<a href="{{url('services')}}">Services</a>

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

				<div class="section page-content-first" style="margin-top:0px ">
			<div class="container mt-6">
				<div class="row">
					<div class="col-md">


						<div class="row d-flex flex-column flex-sm-row flex-md-column">

						</div>
						<div class="question-box mt-3">
							<h5 class="question-box-title">Ask the Experts</h5>
							<div class="alert alert-danger print-error-msg" style="display:none">
								<ul></ul>
							</div>
							<form id="expertForm" >
								<div class="successform">
									<p>Your message was sent successfully!</p>
								</div>
								<div class="errorform">
									<p>Something went wrong, try refreshing and submitting the form again.</p>
								</div>
								<input type="text" name="name" class="form-control" autocomplete="off" placeholder="Your Name*" value="{{isset($userSession['name'])?$userSession['name']:''}}" />

								<input type="text" name="email" class="form-control" autocomplete="off" placeholder="Your Email*" value="{{isset($userSession['email'])?$userSession['email']:''}}" />


                                <select name="expertcountry" id="expertcountry" class="form-control questioncountry">

                                    <option selected="selected" disabled="disabled">Select Country For Phonecode</option>
                                    @foreach($country as $wks)

                                        <option value="{{$wks->id.'-'.$wks->phonecode}}">{{$wks->country}}</option>

                                    @endforeach
                                </select>
                                <div class="input-group">

                                    <span class="country-code"></span>

                                    <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Your Phone" />

                                </div>

                               <div style="padding-top: 10px">
								 <textarea name="message" class="form-control" placeholder="Your comment*"></textarea>
                               </div>


								<!--<button type="button" onclick="questionForm1();" class="btn btn-sm btn-hover-fill mt-15"><i class="icon-right-arrow"></i><span>Ask Now</span><i class="icon-right-arrow"></i></button>-->

								<input class="btn btn-sm btn-hover-fill mt-15" id="expertFormSubmit" type="submit" name="submit" value="submit"/>
								<input type="hidden"  name="_token" value="{{csrf_token()}}">
								<input type="hidden"  name="service_id" value="{{$service2->id}}">
							</form>
						</div>
					</div>
					<div class="col-md-8 col-lg-9 mt-4 mt-md-0">
						<div class="title-wrap">
							<h1>{{$service2->title}}</h1></div>
						<div class="service-img">
							<img src="{{asset('public/assets/uploads/service/image').'/'.$service2->image}}" class="img-fluid" alt="">
						</div>

					{!! $service2->content  !!}

					</div>
				</div>
			</div>
		</div>
		<!--//section-->
			</div>
	

@endsection

@section('after_scripts')
	<script>
        $('#expertFormSubmit').click(function(){
            //$().ready(function() {
            // validate signup form on keyup and submit
            $("#expertForm").validate({
                rules: {
                    name: {

                        required: true,

                    },
                    phone: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },

                    email: {
                        required: true,
                        regex:"[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}",
                    },
                    expertcountry: {

                        required: true,

                    },
                    message:{
                        required: true,
                    }



                },
                messages: {

                    name: {
                        required: "Please enter a name",

                    },
                    phone: {

                        number: "Must be number",
                        minlength: "Your phone number must be at least 10 characters long",
                        maxlength: "Your phone number only 10 characters long"
                    },
                    expertcountry: {
                        required: "Please enter your country",

                    },
                    email: {
                        required: "Please enter a valid email address",
                        regex: "Please enter a valid email address",
                    },
                    message: {
                        required: "Please enter your comments",

                    },


                },

                submitHandler: function(form) {

                    $(form).ajaxSubmit({
                        url:"{{url('ask-add')}}",
                        type:"POST",
                        success: function(){
                            alert('Successfully submited');
                            $('#expertForm').get(0).reset();
                            // $('#modalQuestionForm').modal('hide');

                        }
                    });
                }
            });

        });
	</script>
@endsection