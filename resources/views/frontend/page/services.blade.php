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
@php

    $modal=App\Helpers\UserHelper::modal();
@endphp

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

								@if($ser2->id==6)
                                  @foreach($modal as $sermod)
									<li><a href="#" class="btn-link" data-toggle="modal" data-target="#{{$sermod->model_name}}">{{$sermod->model_title}}</a></li>
								  @endforeach
                                 @endif
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


@section('after_scripts')


@foreach($modal as $modname)

<div class="modal fade" id="{{$modname->model_name}}">

	<div class="modal-dialog">

		<div class="modal-content">



			<!-- Modal Header -->

			<div class="modal-header" style="background: #007bff;">

				<h4 class="modal-title" style="color: #fff">{{$modname->model_title}}</h4>

				<button type="button" class="close" data-dismiss="modal">×</button>

			</div>



			<!-- Modal body -->

			<div class="modal-body" style="padding: 15px;
    height: 60vh;
    overflow: auto;">

				<p>{!!$modname->content  !!}</p>



			</div>



			<!-- Modal footer -->

			<div class="modal-footer">

				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

			</div>



		</div>

	</div>

</div>
@endforeach

@endsection