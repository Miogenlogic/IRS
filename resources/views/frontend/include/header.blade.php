@php
    $settings=App\Helpers\UserHelper::getHeaderFooter();
@endphp


    <div class="header-quickLinks js-header-quickLinks d-lg-none">
        <div class="quickLinks-top js-quickLinks-top"></div>
        <div class="js-quickLinks-wrap-m">
        </div>
    </div>
    <div class="header-topline d-none d-lg-flex">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto d-flex align-items-center">
                    <div class="header-phone"><i class="icon-telephone"></i><a href="tel:1-847-555-5555">{{$settings['phone1']}}</a></div>
                    <div class="header-info"><a href="{{url('contact')}}"><i class="icon-placeholder2"></i></a>{{$settings['top-address']}}</div>
                    <div class="header-info"><i class="icon-black-envelope"></i><a href="mailto:info@biopedclinic.net">{{$settings['email']}}</a></div>
                </div>
                <div class="col-auto ml-auto d-flex align-items-center">
                    <span class="header-social">
                        <a href="{{$settings['facebook']}}" target="blank" class="hovicon"><i class="icon-facebook-logo"></i></a>
                        <a href="{{$settings['twitter']}}"  target="blank" class="hovicon"><i class="icon-twitter-logo"></i></a>
                        <a href="{{$settings['instagram']}}"  target="blank" class="hovicon"><i class="icon-instagram"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="header-content">
        <div class="container">
            <div class="row align-items-lg-center">
                <button class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbarNavDropdown">
                    <span class="icon-menu"></span>
                </button>
                <div class="col-lg-auto col-lg-3 d-flex align-items-lg-center">
                    <a href="{{url('/')}}" class="header-logo">
                        <img src="{{URL::asset('public/assets/uploads/logo')}}/{{$settings['logo']}}" alt="" class="img-fluid">
                    </a>
                    @if($settings['logo-title']!='')
                        <a style="margin-left: 8px;color: darkgray;font-style: oblique;"><b>{{$settings['logo-title']}}</b></a>
                    @endif
                </div>
                <div class="col-lg ml-auto header-nav-wrap ">
                    <div class="header-nav js-header-nav">
                        <nav class="navbar navbar-expand-lg btco-hover-menu">
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('about')}}">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('services')}}" class="nav-link">Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('visionmission')}}">Vision & Mission</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('contact')}}">Contact</a>
                                    </li>
                                    <!--<li class="nav-item">
                                        <a class="nav-link" href="{-{url('registration')}}">Register</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{-{url('login')}}">Login</a>
                                    </li>-->
                                    <div class="header-cart nav-item dropdown" style="margin-top: 20px">
                                        <a href="#" class="icon icon-user" data-toggle="dropdown"></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{url('login')}}">Login</a></li>
                                            <li><a class="dropdown-item" href="{{url('registration')}}">Register</a></li>
                                        </ul>
                                    </div>
                                    <div class="header-nav js-header-nav">
                                    </div>
                                </ul>
                            </div>
                        </nav>
                    </div>


                            {{--<div class="col-lg ml-auto header-nav-wrap lg-3">--}}

                            {{--<form action="#" class="form-inline">--}}
                            {{--<i class="icon-search"></i>--}}
                            {{--<input type="text" placeholder="Search">--}}
                            {{--<button type="submit"><i class="icon-search"></i></button>--}}
                            {{--</form>--}}
                         {{----}}


                       {{----}}
                    {{--</div>--}}


                </div>
            </div>
        </div>
    </div>


