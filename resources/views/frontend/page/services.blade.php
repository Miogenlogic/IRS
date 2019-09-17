@extends('frontend.include.layout')

		<!--section-->
	@section('after_header')
		<div class="section mt-0">
			<div class="breadcrumbs-wrap">
				<div class="container">
					<div class="breadcrumbs">
						<a href="{{url('/')}}">Home</a>
						<span>Services</span>
					</div>
				</div>
			</div>
		</div>
    @endsection
		<!--//section-->
		<!--section services-->
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

		<div class="section page-content-first">
			<div class="container">
				<div class="text-center mb-2  mb-md-3 mb-lg-4">
					<div class="h-sub theme-color">What We Offer</div>
					<h1>{{$homeSection16->title}}</h1>
					<div class="h-decor"></div>
					<div class="text-center mt-4">
						<p>{!!$homeSection16->content  !!}</p>
					</div>
				</div>
			</div>
			<div class="container">

				<div class="row col-equalH">
					@foreach($service1 as $ser2)
						<div class="col-md-6 col-lg-4">
							<div class="service-card">
								<div class="service-card-photo">
									<a href="{{url('service-page').'/'.$ser2->seo_url}}"><img src="{{asset('public/assets/uploads/service/image').'/'.$ser2->image}}" class="img-fluid" alt=""></a>
								</div>
								<h5 class="service-card-name"><a href="{{url('service-page').'/'.$ser2->seo_url}}">{{$ser2->title}}</a></h5>
								<div class="h-decor"></div>
								{!!$ser2->short_content  !!}
							</div>
						</div>

					@endforeach
				</div>

			</div>
		</div>
		<!--//section services-->
	</div>

	<!--footer-->

	<!--//footer-->

@endsection