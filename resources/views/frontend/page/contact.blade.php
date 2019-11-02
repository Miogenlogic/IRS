@extends('frontend.include.layout')
@php
	$userSession=Session::get('user');
	$country=App\Helpers\UserHelper::country();
    //dd($userSession);
@endphp
<!--quick links-->

		<!--section-->
		@section('after_header')
		  <div class="section mt-0">
			<div>
				{!! $contact_contents[0]->content  !!}

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

		<div class="section mt-0 bg-grey">
			<div class="container">
				<div class="row">
					<!--<div class="col-md">-->
						{!! $contact_contents[1]->content  !!}

					<!--</div>-->
				</div>
			</div>
		</div>
		<!--//section-->
		
		<!--section-->
		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md col-lg-5">
					   {!! $contact_contents[2]->content  !!}


						</div>

					<div class="col-md col-lg-6 mt-4 mt-md-0">
						<div class="alert alert-danger print-error-msg" style="display:none">
							<ul></ul>
						</div>
						<form class="contact-form" id="contactForm">
							<div class="successform">
								<p>Your message was sent successfully!</p>
							</div>
							<div class="errorform">
								<p>Something went wrong, try refreshing and submitting the form again.</p>
							</div>
							<div>
								<input type="text" name="name" class="form-control" autocomplete="off" placeholder="Your Name*" value="{{isset($userSession['name'])?$userSession['name']:''}}" />
							</div>

							<div class="mt-15">
								<input type="text" name="email" class="form-control" autocomplete="off" placeholder="Your Email*" value="{{isset($userSession['email'])?$userSession['email']:''}}" />
							</div>

                            <div class="mt-15">
                                <select name="contactcountry" id="contactcountry" class="form-control questioncountry">

                                    <option selected="selected" disabled="disabled">Select Country For Phonecode</option>
                                    @foreach($country as $wks)

                                        <option value="{{$wks->id.'-'.$wks->phonecode}}">{{$wks->country}}</option>

                                    @endforeach
                                </select>
                            </div>

							<div class="input-group mt-15">
								<span class="country-code"></span>

								<input type="text" class="form-control" name="phone" placeholder="Your Phone">
							</div>

							<div class="mt-15">
								<textarea class="form-control" name="message" placeholder="Message"></textarea>
							</div>


							<div class="mt-3">
								<!--<button type="button" onclick="contactForm();" class="btn btn-hover-fill"><i class="icon-right-arrow"></i><span>Send message</span><i class="icon-right-arrow"></i></button>-->
								<input class="btn btn-sm btn-hover-fill mt-15 submit" type="submit" id="contactFormSubmit" name="submit" value="submit"/>
							</div>
							<input type="hidden" name="_token" value="{{csrf_token()}}">
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--//section-->
	</div>

	<!--//footer-->
	<div class="backToTop js-backToTop">
		<i class="icon icon-up-arrow"></i>
	</div>
@endsection

@section('after_scripts')
	<script>
        $('#contactFormSubmit').click(function(){
            //$().ready(function() {
            // validate signup form on keyup and submit
            $("#contactForm").validate({
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
                    contactcountry: {

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

                    email: {
                        required: "Please enter a valid email address",
                        regex: "Please enter a valid email address",
                    },
                    message: {
                        required: "Please enter your comments",

                    },
                    contactcountry: {
                        required: "Please enter your country",

                    },

                },

                submitHandler: function(form) {

                    $(form).ajaxSubmit({
                        url:"{{url('contact-add')}}",
                        type:"POST",
                        success: function(){
                            alert('Successfully submited');
                            $('#contactForm').get(0).reset();
                            // $('#modalQuestionForm').modal('hide');

                        }
                    });
                }
            });

        });
	</script>
@endsection