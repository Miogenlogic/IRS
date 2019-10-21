<!-- sidebar-trigger  -->
<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
</a>
<!-- /sidebar-trigger  -->
<!-- sidebar-wrapper  -->
<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="javascript:void(0);">Bioped</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>

        <!-- /sidebar-header  -->
        <div class="sidebar-header">

            <div class="user-pic">
                <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                     alt="User picture">
            </div>
            <div class="user-info">
			  <span class="user-name">
                 Rimpi Das 	</span>
                <span class="user-role"> Admin </span>
                <span class="user-status">
				<i class="fa fa-circle"></i>
				<span>Online</span>
			  </span>
            </div>
            <div class="user-info">
			  <span class="user-name">
                @if(isset($user_session['name'])) {{$user_session['name']}} @endif
			  </span>
                <span class="user-role">@if(isset($user_session['user_type'])) {{ucfirst($user_session['user_type']) }} @endif</span>

            </div>
        </div><!-- /sidebar-header  -->


        <!-- sidebar-menu  -->
        <div class="sidebar-menu">
            <ul>
                <li class="header-menu">
                    <span>General</span>
                </li>
                <li>
                    <a href="@if(Entrust::hasRole('admin')){{url('admin/admin-dashboard')}} @elseif(Entrust::hasRole('doctor')) {{url('admin/doctor-dashboard')}} @elseif(Entrust::hasRole('patient')) {{url('admin/doctor-dashboard')}} @endif">
                        <i class="fa fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                        <span class="badge badge-pill badge-warning">New</span>
                    </a>
                </li>

                @if(Entrust::hasRole('admin'))
                    <li class="sidebar-dropdown {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Content Management</span>
                            <span class="badge badge-pill badge-danger"></span>
                        </a>
                        <div class="sidebar-submenu" {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'style="display: block;"' : '' }}>
                            <ul>
                                <li>
                                    <a href="{{url('admin/cms-home-list')}}">Home</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/cms-about-list')}}" >About</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/cms-vision-list')}}">Vision Mission</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/cms-contact-list')}}">Contact</a>
                                </li>
                                <!--<li>
                                    <a href="{{url('admin/slider-list1')}}">HomeSlider</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/mainslider-list1')}}">HomeMainSlider</a>
                                </li>-->
                            </ul>
                        </div>
                    </li>
                @endif
                @if(Entrust::hasRole('admin'))
                    <li class="sidebar-dropdown {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-briefcase"></i>
                            <span>Service Management</span>
                            <span class="badge badge-pill badge-danger"></span>
                        </a>
                        <div class="sidebar-submenu" {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'style="display: block;"' : '' }}>
                            <ul>
                                <li>
                                    <a href="{{url('admin/cms-service-list')}}">Service </a>
                                </li>
                                <li>
                                    <a href="{{url('admin/service-list')}}" >Service List</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/cms-service-page-list')}}">Service Page</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif

                @if(Entrust::hasRole('admin'))
                    <li class="sidebar-dropdown {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-slideshare"></i>
                            <span>Slider Management</span>
                            <span class="badge badge-pill badge-danger"></span>
                        </a>
                        <div class="sidebar-submenu" {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'style="display: block;"' : '' }}>
                            <ul>
                                <li>
                                    <a href="{{url('admin/main-slider-list')}}">HomeMainSlider</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/home-slider-list')}}">Testimonial</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/slider-list')}}">AboutPageSlider</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                @if(Entrust::hasRole('admin'))
                    <li class="sidebar-dropdown {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-cog"></i>
                            <span>Settings</span>
                            <span class="badge badge-pill badge-danger"></span>
                        </a>
                        <div class="sidebar-submenu" {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'style="display: block;"' : '' }}>
                            <ul>
                                <li>
                                    <a href="{{url('admin/settings')}}">Settings Details</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                @endif

                @if(Entrust::hasRole('admin'))
                    <li class="sidebar-dropdown {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-info-circle"></i>
                            <span>Inquiry Management</span>
                            <span class="badge badge-pill badge-danger"></span>
                        </a>
                        <div class="sidebar-submenu" {{ (Request::is('admin/blog*')||Request::is('admin/video-gallery*')||Request::is('admin/slider*') )? 'style="display: block;"' : '' }}>
                            <ul>
                                <li>
                                    <a href="{{url('admin/inquiry-list')}}">Booking Inquiry</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/question-list')}}">Question Inquiry</a>
                                </li>

                            </ul>
                        </div>
                    </li>
            @endif
            @if(Entrust::hasRole('admin'))
                <li>
                    <a href="{{url('admin/user-list')}}">
                        <i class="fa fa-user"></i>
                        <span>USER</span>
                        <span class="badge badge-pill badge-primary"></span>
                    </a>
                </li>
            @endif

            @if(Entrust::hasRole('admin'))
                <!--<li>
                    <a href="{{url('admin/cms-list')}}">
                        <i class="fa fa-book"></i>
                        <span>CMS</span>
                        <span class="badge badge-pill badge-primary"></span>
                    </a>
                </li>-->
            @endif
                <!--
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="far fa-gem"></i>
                        <span>Dropdown Menu</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="#">General</a>
                            </li>
                            <li>
                                <a href="#">Panels</a>
                            </li>
                            <li>
                                <a href="#">Tables</a>
                            </li>
                            <li>
                                <a href="#">Icons</a>
                            </li>
                            <li>
                                <a href="#">Forms</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-chart-line"></i>
                        <span>Another One</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="#">Pie chart</a>
                            </li>
                            <li>
                                <a href="#">Line chart</a>
                            </li>
                            <li>
                                <a href="#">Bar chart</a>
                            </li>
                            <li>
                                <a href="#">Histogram</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="sidebar-dropdown">
                    <a href="#">
                        <i class="fa fa-globe"></i>
                        <span>Maps</span>
                    </a>
                    <div class="sidebar-submenu">
                        <ul>
                            <li>
                                <a href="#">Google maps</a>
                            </li>
                            <li>
                                <a href="#">Open street map</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="header-menu">
                    <span>System</span>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Settings</span>
                        <span class="badge badge-pill badge-primary">Beta</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-calendar"></i>
                        <span>Master Manage</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-folder"></i>
                        <span>Role Manage</span>
                    </a>
                </li>
                -->
            </ul>
        </div><!-- /sidebar-menu  -->

    </div><!-- sidebar-content  -->

    <!-- sidebar-footer  -->
    <div class="sidebar-footer">
        <!--<a href="#">
            <i class="fa fa-bell"></i>
            <span class="badge badge-pill badge-warning notification">3</span>
        </a>
        <a href="#">
            <i class="fa fa-envelope"></i>
            <span class="badge badge-pill badge-success notification">7</span>
        </a>
        <a href="#">
            <i class="fa fa-cog"></i>
            <span class="badge-sonar"></span>
        </a>-->
        <a href="{{url('/logout')}}">
            <i class="fa fa-power-off"></i>
        </a>
    </div><!-- /sidebar-footer  -->
</nav>
<!-- /sidebar-wrapper  -->
