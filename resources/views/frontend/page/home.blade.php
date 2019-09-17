@extends('frontend.include.layout')

@section('after_header')
@endsection

@section('body')
    <div class="page-content">
        
        <style>
            .welcome-bot p {
                margin-bottom: 0px;
            }
        </style>
        
        <!--section slider-->
        <div class="section mt-0">
        <!-- Side sticky metas -->
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
            <!-- Side sticky metas -->
            <div id="mainSliderWrapper" class="putulunuSlider">
            <div class="loading-content">
                    <div class="inner-circles-loader"></div>
                   </div>
                <div class="main-slider mb-0 arrows-white arrows-bottom" id="mainSlider" data-slick='{"arrows": true, "dots": true}'>
                    @foreach($slider as $sli)
                        <div class="slide">

                            <img class="d-block" src="{{asset('public/assets/uploads/slider/image').'/'.$sli->image}}" alt="{{$sli->name}}">
                        <!--<div class="img--holder" data-bg="{//{URL::asset('public/assets/frontend/images/content/slider/slide-02.jpg')}}"></div>-->
                        <div class="slide-content center">
                            <div class="vert-wrap container">
                                <div class="vert">
                                    <div class="container">
                                {!! $sli->content  !!}
                                        <div class="slide-btn"><a href="{{url('services')}}" class="btn btn-white" data-animation="fadeInUp" data-animation-delay="2s"><i class="icon-right-arrow"></i><span>Know more</span><i class="icon-right-arrow"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
        <!--//section slider-->
        <!--section under slider-->
        <div class="section mt-0 shadow-bot pt-2 pb-2 welcome-bot" style="margin-bottom: 4px;" >
            <div class="container">
                <div class="row js-icn-text-alt-carousel">
                    <div class="col-md-6 col-lg-4">
                        <div class="icn-text-alt">
                            <div class="icn-text-alt-icn"><i class="icon-first-aid-kit"></i></div>
                            <div>
                                <h4 class="icn-text-alt-title">{{$homeSection9->title}}</h4>
                                <p>{!! $homeSection9->content  !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="icn-text-alt">
                            <div class="icn-text-alt-icn"><i class="icon-flask"></i></div>
                            <div>
                                <h4 class="icn-text-alt-title">{{$homeSection10->title}}</h4>
                                <p>{!! $homeSection10->content  !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="icn-text-alt">
                            <div class="icn-text-alt-icn"><i class="icon-doctor"></i></div>
                            <div>
                                <h4 class="icn-text-alt-title">{{$homeSection11->title}}</h4>
                                <p>{!! $homeSection11->content  !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--//section under slider-->
        
        <!--section welcome-->

        <div class="section" style="margin-top: 2px;">
            <div class="container pt-lg-2" style="text-align: justify">
                <div class="row mt-2 mt-md-3 mt-lg-0">
                    <div class="col-md-6">
                        {!! $homeSection1->content  !!}
                        <div class="mt-2 mt-md-4"></div>
                        <a href="#" class="btn-link" data-toggle="modal" data-target="#modalBookingForm">Book an Appointment<i class="icon-right-arrow"></i></a>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('public/assets/uploads/cms/image').'/'.$homeSection1->image}}">
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="section" style="margin-top: 2px;">
            <div class="container pt-lg-2" style="text-align: justify">
                {!! $homeSection1->content  !!}


                <a href="#" class="btn-link" data-toggle="modal" data-target="#modalBookingForm">Book an Appointment<i class="icon-right-arrow"></i></a>

            </div>
        </div>-->


    <!--//section welcome-->
    <!--section services-->
        <div class="section page-content-first mt-4" style="margin-bottom: 2px;">
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
                   @foreach($service as $ser1)
                   <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-card-photo" >
                                <a href="{{url('service-page').'/'.$ser1->seo_url}}"><img style="height: 100%;width: 100%;" src="{{asset('public/assets/uploads/service/image').'/'.$ser1->image}}" class="img-fluid" alt=""></a>
                            </div>
                            <h5 class="service-card-name"><a href="{{url('service-page').'/'.$ser1->seo_url}}">{{$ser1->title}}</a></h5>
                            <div class="h-decor"></div>
                            {!!$ser1->short_content  !!}
                        </div>
                    </div>

                   @endforeach
                </div>

            </div>
        </div>
    <!--//section services-->
        <!--section mission & vision-->

        <!--<div class="section">
            <div class="container">
                <div class="title-wrap text-center">
                    <h2 class="h1">{{$homeSection12->title}}</h2>
                    <div class="h-decor"></div>
                </div>
                <p class="max-900 text-center">{!! $homeSection12->content  !!}</p>
                <div class="row js-icn-carousel icn-carousel flex-column flex-sm-row text-center text-sm-left" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}]}'>
                    <div class="col-md">
                        <div class="icn-text">
                            <div class="icn-text-circle"><i class="icon-medicine"></i></div>
                            <div>
                                <h5 class="icn-text-title">{{$homeSection13->title}}</h5>
                                <p>{!! $homeSection13->content  !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="icn-text">
                            <div class="icn-text-circle"><i class="icon-pharmacy"></i></div>
                            <div>
                                <h5 class="icn-text-title">{{$homeSection14->title}}</h5>
                                <p>{!! $homeSection14->content  !!} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="icn-text">
                            <div class="icn-text-circle"><i class="icon-principles"></i></div>
                            <div>
                                <h5 class="icn-text-title">{{$homeSection15->title}}</h5>
                                <p>{!! $homeSection15->content  !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    <!--//section mission & vision -->
    <!--section services tabs-->
        <div class="section bg-grey py-0">
            <div class="container-fluid px-0">
                <div class="row no-gutters flex-wrap flex-md-nowrap">
                    <div class="col-md col-lg-6">
                        <div class="services-tab-wrap float-right">
                            <div class="service-tab-banner d-sm-none mb-3">
                                <img src="{{asset('public/assets/uploads/cms/image').'/'.$addservice1->image}}" alt="">
                            </div>
                            <h2 class="h1">{{$addservice1->title}}</h2>
                            <div class="d-flex flex-column flex-md-row position-relative mt-1 mt-md-3">
                                <div class="nav nav-pills mt-2 mt-md-0" role="tablist">
                                    <a class="nav-link active" data-toggle="pill" href="#tab-D" role="tab">{{$addservice2->title}}</a>
                                    <a class="nav-link" data-toggle="pill" href="#tab-E" role="tab">{{$addservice3->title}}</a>
                                    <a class="nav-link" data-toggle="pill" href="#tab-F" role="tab">{{$addservice4->title}}</a>
                                </div>
                            </div>
                            <div id="tab-content" class="tab-content mt-1">
                                <div id="tab-D" class="tab-pane fade show active" role="tabpanel">
                                    {!! $addservice2->content !!}
                                </div>
                                <div id="tab-E" class="tab-pane fade" role="tabpanel">
                                    {!! $addservice3->content !!}
                                </div>
                                <div id="tab-F" class="tab-pane fade" role="tabpanel">
                                    {!! $addservice4->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-auto col-lg-6 service-tab-banner d-none d-sm-block">
                        <img src="{{asset('public/assets/uploads/cms/image').'/'.$addservice1->image}}" alt="">
                    </div>
                </div>
            </div>
        </div>

       <!--//section services tabs--><!--section single service -->
        <div class="section mt-4">
            <div class="container">
                <div class="title-wrap text-center">
                    <h2 class="h1">Testimonial</h2>
                    <div class="h-decor"></div>
                </div>
                <div class="single-service-carousel js-single-service-carousel" style="margin-top: 1px;">

                    @foreach($slider2 as $slid2)

                       <div class="single-service">
                          <div class="row">
                              <div class="col-md">
                                  <div class="text-right pl-0 pl-md-3 pl-lg-6">
                                      <h3>{{$slid2->name}}</h3>
                                     <p>{!! $slid2->content  !!}</p>

                                     </div>
                              </div>
                            <div class="col-md col-img">
                                <img class="d-block" src="{{asset('public/assets/uploads/homeslider/image').'/'.$slid2->image}}" alt="">
                            </div>
                           </div>
                       </div>

                    @endforeach
                </div>
            </div>
        </div>
    <!--//section single service --><!--section promotion-->
        <div class="section">
            <div class="container-fluid px-0">
                <div class="banner-center bg-cover" style="background-image: url({{asset('public/assets/uploads/cms/image').'/'.$homeSection4->image}})">
                    <div class="banner-center-caption text-center">
                        {!! $homeSection4->content  !!}
                        <a href="#" data-toggle="modal" data-target="#modalBookingForm" class="btn btn-white mt-2 mt-sm-3 mt-lg-5"><i class="icon-right-arrow"></i><span>Book an appointment</span><i class="icon-right-arrow"></i></a>
                    </div>
                </div>
            </div>
        </div>

    <!--<div class="section">
              <div class="container-fluid px-0">
                  {!! $homeSection4->content  !!}
         </div>
         </div>-->
    <!--//section promotion--><!--section faq-->
             <div class="section bg-grey py-0 mt-lg-0">
                 <div class="container-fluid px-0">
                     <div class="row no-gutters">
                         <div class="col-xl-6 banner-left bg-fullheight" style="background-image: url(https://hyperbaric-chamber.com/wp-content/uploads/monoplace-hyperbaric-chamber-hybrid-3200.jpg);background-size: cover;background-position: 79%;"></div>
                         <div class="col-xl-6">
                             <div class="faq-wrap px-15 px-lg-8">
                                 <div class="title-wrap">
                                     <h2 class="h1">{{$homeSection5->title}}</h2>
                                 </div>
                                 <div class="nav nav-pills mt-2 mt-lg-3" role="tablist">
                                     <a class="nav-link active" data-toggle="pill" href="#tab-A" role="tab">General</a>
                                     <a class="nav-link" data-toggle="pill" href="#tab-B" role="tab">Urgent</a>
                                 </div>
            {!! $homeSection5->content  !!}
                                 <a href="#" class="btn mt-3" data-toggle="modal" data-target="#modalQuestionForm"><i class="icon-right-arrow"></i><span>Ask Question</span><i class="icon-right-arrow"></i></a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>


        <!--//section faq--><!--section call us-->
        <div class="section mt-5">
            <div class="container">
                <div class="banner-call">
                    <div class="row no-gutters">
                        <div class="col-sm-5 col-lg-5 order-2 order-sm-1 mt-3 mt-md-0 text-center text-md-right">
                            <img src="{{asset('public/assets/uploads/cms/image').'/'.$homeSection6->image}}" alt="" class="shift-left-1">
                        </div>
                        <div class="col-sm-7 col-lg-7 col-lg-7 d-flex align-items-center order-1 order-sm-2">
                            <div class="text-center pt-2 pt-lg-8">
                                <h2><span class="theme-color">{{$homeSection6->title}}</span></h2>
                                <div class="h-decor"></div>
                                {!! $homeSection6->content  !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="section mt-5">
            <div class="container">
            {!! $homeSection6->content  !!}
            </div>
        </div>-->
    <!--//section call us-->
    </div>
@endsection