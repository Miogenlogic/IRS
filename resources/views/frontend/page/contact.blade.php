@extends('frontend.include.layout')

<!--quick links-->

		<!--section-->
		@section('after_header')
		  <div class="section mt-0">
			<div>
				{!! $contact1->content  !!}

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

		<div class="section mt-0 bg-grey">
			<div class="container">
				<div class="row">
					<div class="col-md">
						{!! $contact2->content  !!}

					</div>
					<div class="col-md mt-3 mt-md-0">
						{!! $contact3->content  !!}

					</div>
					<!--<div class="col-md mt-3 mt-md-0">
					{!! $contact5->content  !!}
						<!--<div class="title-wrap">
							<h5>Working Time</h5>
							<div class="h-decor"></div>
						</div>
						<ul class="icn-list-lg">
							<li><i class="icon-clock"></i>
								<div>
									<div class="d-flex"><span>Mon-Thu</span><span class="theme-color">08:00 - 20:00</span></div>
									<div class="d-flex"><span>Friday</span><span class="theme-color">07:00 - 22:00</span></div>
									<div class="d-flex"><span>Saturday</span><span class="theme-color">08:00 - 18:00</span></div>
								</div>
							</li>
						</ul>-->
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
					   {!! $contact4->content  !!}
						<!--<div class="pr-0 pr-lg-8">
							<div class="title-wrap">
								<h2>Get In Touch With Us</h2>
								<div class="h-decor"></div>
							</div>
							<div class="mt-2 mt-lg-4">
								<p>For general questions, please send us a message and we’ll get right back to you. You can also call us directly to speak with a member of our service team or insurance expert.</p>
								<p class="p-sm">Fields marked with a * are required.</p>
							</div>
							<div class="mt-2 mt-md-5"></div>-->

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
								<input type="text" class="form-control" name="name" placeholder="Your name*">
							</div>
							<span id="error_name" style="display: none;">Field is required</span>
							<div class="mt-15">
								<input type="text" class="form-control" name="email" placeholder="Email*">
							</div>
							<span id="error_email" style="display: none;">Field is required</span>
							<div class="mt-15">
								<input type="text" class="form-control" name="phone" placeholder="Your Phone">
							</div>
							<span id="error_phone" style="display: none;">Field is required</span>
							<div class="mt-15">
								<textarea class="form-control" name="message" placeholder="Message"></textarea>
							</div>
							<span id="error_message" style="display: none;">Field is required</span>

							<div class="mt-3">
								<button type="button" onclick="contactForm();" class="btn btn-hover-fill"><i class="icon-right-arrow"></i><span>Send message</span><i class="icon-right-arrow"></i></button>
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