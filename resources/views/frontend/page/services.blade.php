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

		<div class="section page-content-first" style="margin-top:40px ">
			<div class="container">
				{!! $service_contents[0]->content  !!}
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