@extends('frontend.include.layout')

@section('after_header')
    <style>
        ul.tabs{
            margin: 0px;
            padding: 0px;
            list-style: none;
        }
        ul.tabs li{
            background: none;
            color: #222;
            display: inline-block;
            padding: 10px 15px;
            cursor: pointer;
        }

        ul.tabs li.current{
            background: #ededed;
            color: #222;
        }

        .tab-content{
            display: none;
            background: #ededed;
            padding: 15px;
        }

        .tab-content.current{
            display: inherit;
        }


        /*Accordion CSS*/
        .accordion{
            height: 46px;
            margin: 0 auto;
            background: #fff;
            border-radius: 3px;
            box-shadow: 0 0 5px rgba(225,225,225,1);
            overflow: hidden;
            transition: height 0.3s ease;
            margin-bottom: 8px;
        }
        .accordion .accordion_tab{
            padding: 9px;
            cursor: pointer;
            user-select: none;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 1px;
            position: relative;
        }

        .accordion .accordion_tab .accordion_arrow{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 20px;
            width: 12px;
            height: 12px;
            transition: all 0.3s ease;
        }

        .accordion .accordion_tab .accordion_arrow img{
            width: 100%;
            height: 100%;
        }

        .accordion .accordion_tab.active .accordion_arrow{
            transform: translateY(-50%) rotate(180deg);
        }

        .accordion.active{
            height: 320px;
        }

        .accordion .accordion_content{
            padding: 20px;
            border-top: 1px solid #e9e9e9;
        }

        .accordion .accordion_content .accordion_item{
            margin-bottom: 20px;
        }

        .accordion .accordion_content .accordion_item p.item_title{
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 18px;
            color: #207dc8;
        }

        .accordion .accordion_content .accordion_item p:last-child{
            color: #9a9b9f;
            font-size: 14px;
            line-height: 20px;
        }
    </style>
    <style>
        .welcome-bot p {
            margin-bottom: 0px;
        }
    </style>
@endsection

@php

    $modal=App\Helpers\UserHelper::modal();
@endphp

@section('body')
    <div class="page-content">
        

        
        <!--section slider-->
        <div class="section mt-0">
        <!-- Side sticky metas -->
            <div class="quickLinks-wrap js-quickLinks-wrap-d d-none d-lg-flex">
                <div class="sticky-wrapper"><div class="quickLinks js-quickLinks">
                        <div class="container">
                            <div class="row no-gutters">

                                <!--<div class="col">
                                    <a href="#" class="link">
                                        <i class="icon-clock"></i><span>{-{$homeSection7->title}}</span>
                                    </a>
                                   <div class="link-drop">
                                        <h5 class="link-drop-title"><i class="icon-clock"></i>{--{$homeSection7->title}}</h5>

                                          {-!! $homeSection7->content  !!}
                                    </div>
                                </div>


                                <div class="col">
                                    <a href="#" class="link">
                                        <i class="icon-emergency-call"></i><span>{-{$homeSection8->title}}</span>
                                    </a>
                                    <div class="link-drop">
                                        <h5 class="link-drop-title"><i class="icon-emergency-call"></i>{-{$homeSection8->title}}</h5>
                                    {-!! $homeSection8->content  !!}
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
                {!! $home_contents[0]->content  !!}
            </div>
        </div>
        <!--//section under slider-->
        
        <!--section welcome-->

        <div class="section" style="margin-top: 2px;">
            <div class="container pt-lg-2" style="text-align: justify">
                {!! $home_contents[1]->content  !!}

            </div>
        </div>

        <!--<div class="section" style="margin-top: 2px;">
            <div class="container pt-lg-2" style="text-align: justify">
                {--!! $homeSection1->content  !!}


                <a href="#" class="btn-link" data-toggle="modal" data-target="#modalBookingForm">Book an Appointment<i class="icon-right-arrow"></i></a>

            </div>
        </div>-->


    <!--//section welcome-->
    <!--section services-->
        <div class="section page-content-first mt-4" style="margin-bottom: 2px;">
            <div class="container">
                <div class="text-center mb-2  mb-md-3 mb-lg-4">
                    {!! $home_contents[2]->content  !!}
                </div>
            </div>
            <div class="container">

                <div class="row col-equalH">
                   @foreach($service as $ser1)
                   <div class="col-md-6 col-lg-4">
                        <div class="service-card">
                            <div class="service-card-photo" >
                                <a href="{{url('service-page').'/'.$ser1->seo_url}}"><img src="{{asset('public/assets/uploads/service/image').'/'.$ser1->image}}" class="img-fluid" alt=""></a>
                            </div>
                            <h5 class="service-card-name"><a href="{{url('service-page').'/'.$ser1->seo_url}}">{{$ser1->title}}</a></h5>
                            <div class="h-decor"></div>
                            {!!$ser1->short_content  !!}

                                @foreach($modal as $sermod)
                                    @if($ser1->id==$sermod->service_id)
                                        <li><a href="#" class="btn-link" data-toggle="modal" data-target="#{{$sermod->model_name}}">{{$sermod->model_title}}</a></li>
                                    @endif
                                @endforeach
                        </div>
                    </div>

                   @endforeach
                </div>

            </div>
        </div>
    <!--//section services-->

    <!--section services tabs-->
        <div class="section bg-grey py-0">
            <div class="container-fluid px-0">
                {!! $home_contents[3]->content  !!}
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
                {!! $home_contents[4]->content  !!}
            </div>
        </div>

    <!--<div class="section">
              <div class="container-fluid px-0">
                  {-!! $homeSection4->content  !!}
         </div>
         </div>-->
    <!--//section promotion--><!--section faq-->
             <div class="section bg-grey py-0 mt-lg-0">
                 <div class="container-fluid px-0">
                     {!! $home_contents[5]->content  !!}
                 </div>
             </div>


        <!--//section faq--><!--section call us-->
        <div class="section mt-5">
            <div class="container">
                <div class="banner-call">
                    {!! $home_contents[6]->content  !!}
                </div>
            </div>
        </div>
        <!--<div class="section mt-5">
            <div class="container">
            {-!! $homeSection6->content  !!}
            </div>
        </div>-->
    <!--//section call us-->
    </div>
@endsection


@section("after_scripts")
    <script>
        $(document).ready(function(){

            $('ul.tabs li').click(function(){
                var tab_id = $(this).attr('data-tab');

                $('ul.tabs li').removeClass('current');
                $('.tab-content').removeClass('current');

                $(this).addClass('current');
                $("#"+tab_id).addClass('current');
            })

        })
    </script>

    <!--Accordion-->
    <script>
        $(".accordion_tab").click(function(){
            $(".accordion_tab").each(function(){
                $(this).parent().removeClass("active");
                $(this).removeClass("active");
            });
            $(this).parent().addClass("active");
            $(this).addClass("active");
        });
    </script>






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
