  <header>
        <!-- start header-top -->
        <!--<div class="header-top d-none d-md-block">-->
        <div class="header-top clearfix">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="header-left">
                            <a href="tel:18004193356"><i class="fa fa-phone circle-icon"></i> Toll Free: 1800 419 3356</a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ul class="social-icons float-sm-right">
                            <li><a href="https://www.facebook.com/gainwellcat" target="_blank"><i class="fa fa-facebook circle-icon" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/gainwellcat" target="_blank"><i class="fa fa-twitter circle-icon" aria-hidden="true"></i></a></li>
                            <li><a href="https://linkedin.com/company/gainwellcat/" target="_blank"><i class="fa fa-linkedin circle-icon" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.youtube.com/c/GainwellCAT" target="_blank"><i class="fa fa-youtube-play circle-icon" aria-hidden="true"></i></a></li>
                            <li><a href="https://instagram.com/gainwellcat/" target="_blank"><i class="fa fa-instagram circle-icon" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header-top -->
        <!-- start header-navbar -->
        <div class="header-navbar">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-logo1" href="{{url('admin/admin-dashboard')}}"><img src="{{URL::asset('public/assets/img/logo.gif')}}" alt=""></a>
                    <a class="navbar-logo2 d-none d-lg-block" href="{{url('admin/admin-dashboard')}}"><img src="{{URL::asset('public/assets/img/cat75.png')}}" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main-navbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('admin/admin-dashboard')}}"><i class="fa fa-shopping-bag" aria-hidden="true"></i>Home</a>
                            </li>
                            @if($role == '2')
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('admin/employee-incident')}}"><i class="fa fa-align-center" aria-hidden="true"></i>Report Incident</a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i>{{ session('user')['employee_name'] }}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown01">                                    
									<a class="dropdown-item" href="{{url('admin/admin-changepass')}}">Change Password</a>
									@if(session('user')['role_id']==4)
									<a class="dropdown-item" href="{{url('admin/manage-report')}}">Manage Report</a>
									<a class="dropdown-item" href="{{url('admin/health-report')}}">Download Health Information Report</a>									
									@endif
                                    <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
                                </div>
                            </li>
                        </ul>
                        <a class="navbar-logo3 d-none d-lg-block" href="{{url('admin/admin-dashboard')}}"><img src="{{URL::asset('public/assets/img/gcpl_sml_logo.png')}}" alt=""></a>
                    </div>
                </div>
            </nav>
        </div>
		<!--saheli-->
  <!-- Modal Body -->
	<div class="modal" id="myModal">
	  <div class="modal-dialog">
		<div class="modal-content">
		<form method="post" action="{{url('admin/admin-changeDateRange')}}" enctype="multipart/form-data">
		  <!-- Modal body -->
		  <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<label>Please enter the date range:<span style="color:red">*</span></label><br>
			<input type="text" name="date_range" placeholder="Enter date range in days" required><br>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" style="background:black" data-dismiss="modal">Close</button>
			<input type="hidden" name="_token" value="{{csrf_token()}}"> 
			<button type="submit" class="btn btn-primary" style="background:black">Submit</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<!-- Modal Body Ends -->
	<!--saheli-->
        <!-- end header-navbar -->
    </header>