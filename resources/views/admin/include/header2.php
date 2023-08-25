<header>
    <div class="header-top-bar d-none d-md-block d-lg-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="info-only" style="font-size: 20px;">
                        <i class="fas fa-phone-alt phone" aria-hidden="true"></i>
                        Toll Free: 1800 419 3356
                    </div>
                </div>
                <div class="col-md-5 text-right">
                    <!-- Search -->





                    <div class="social-handler">
                        <ul>
                            <li><a href="https://facebook.com/gainwellcat" target="_blank"><i class="fab fa-facebook-f facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/gainwellcat" target="_blank"><i class="fab fa-twitter twitter" aria-hidden="true"></i></a></li>
                            <li><a href="https://linkedin.com/company/gainwellcat/" target="_blank"><i class="fab fa-linkedin-in linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="https://youtube.com/c/GainwellCAT" target="_blank"><i class="fab fa-youtube youtube" aria-hidden="true"></i></a></li>
                            <li><a href="https://instagram.com/gainwellcat/" target="_blank"><i class="fab fa-instagram instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-black no-padding-lr" id="headerScroll">
        <div class="container-fluid">
            <div class="navbar-translate">
                <a class="navbar-brand" href="https://www.gainwellindia.com/cat" target="_blank">
                    <img src="{{URL::asset('public/assets/img/logo.gif')}}" alt="Brand Logo">
                </a>
                <a class="navbar-brand l-75" href="https://www.gainwellindia.com/milestone" target="_blank">
                    <img src="{{URL::asset('public/assets/img/cat75.png')}}" alt="Brand Logo">
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar top-bar"></span>
                    <span class="navbar-toggler-bar middle-bar"></span>
                    <span class="navbar-toggler-bar bottom-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">
                     <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-on-dark" href="{{url('admin-dashboard')}}">
                            <i class="now-ui-icons shopping_shop"></i>
                            <p>Home</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn btn-primary btn-on-dark" href="{{url('admin-incident')}}">
                            <i class="now-ui-icons text_align-center"></i>
                            <p>Incident</p>
                        </a>
                    </li>

                            
                     <li  class="subaccount nav-item dropdown">
                        <a href="#" class="nav-link btn btn-primary btn-on-dark dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
                            <i class="now-ui-icons users_circle-08"></i>
                            <p>{{ session('user')['employee_name'] }}</p>
                        </a>
                            <ul  class="sub-content dropdown-content">
                               <li class="subaccount"> <a id="myProfile" href="{{url('admin-reportform')}}">My Profile</a>
                                <!--<ul class="sub-content">-->
                                <!--    <li><a href="{{url('admin-reportform')}}">Personal Information</a></li>-->
                                <!--</ul> -->
                                </li>
                                <li>  <a href="{{url('admin-myhealth')}}">My Health</a></li>
                                <li>  <a href="{{url('logout')}}">Logout</a></li>
                              </ul>

                        
                        <!-- Dropdown List  -->
                        <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
                            <a class="dropdown-item" href="/login">
                                <i class="now-ui-icons arrows-1_minimal-right"></i> Login
                            </a>
                            <a class="dropdown-item" href="/registration">
                                <i class="now-ui-icons arrows-1_minimal-right"></i> Registration
                            </a>
                            <a class="dropdown-item" href="/faq">
                                <i class="now-ui-icons arrows-1_minimal-right"></i> FAQ
                            </a>
                        </div> -->
                    </li>
                    <li class="nav-item white-logo-right d-none d-md-block d-lg-block">
                        <a class="ml-3" href="https://www.gainwellindia.com/" target="_blank">
                            <img src="{{URL::asset('public/assets/img/gcpl_sml_logo.png')}}" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
</header>
