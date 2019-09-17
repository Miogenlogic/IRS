@php
    $settings=App\Helpers\UserHelper::getHeaderFooter();
@endphp

<footer>
    <div class="footer mt-2">
        <div class="container">
            <div class="row py-1 py-md-2 px-lg-0">
                <div class="col-lg-4 footer-col1">
                    <div class="row flex-column flex-md-row flex-lg-column">
                        <div class="col-md col-lg-auto"  style="padding: 0px">
                            <div class="footer-logo">
                                <?php
                                $str = $settings['footer-address'];
                                echo htmlspecialchars_decode($str);
                                ?>
                        </div>
                            <div class="mt-2 mt-lg-0"></div>

                        </div>


                        <div>
                            <div class="footer-text mt-1 mt-lg-2">
                                <p>To receive email releases, simply provide
                                    <br>us with your email below</p>
                                <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                                </div>
                                <form id="requestNewsletter" class="footer-subscribe">
                                  <div class="col" style="padding: 0px">
                                    <div class="input-group">
                                    <span><i class="icon-user"></i></span>
                                        <input name="name" type="text" class="form-control" placeholder="Your Name">

                                    </div>
                                    <span id="error_name" style="display: none;">Field is required</span>
                                  </div>
                                  <div class="col" style="padding: 0px;">
                                    <div class="input-group mt-1">
                                        <span><i class="icon-black-envelope"></i></span>
                                        <input name="subscribe_mail" type="text" class="form-control" placeholder="Your Email" />
                                    </div>
                                    <span id="error_subscribe_mail" style="display: none;">Field is required</span>
                                  </div>
                                    <div class="mt-2" style="width: 300px">
                                        <button type="button" onclick="requestNewsletter();" class="btn btn-sm btn-hover-fill">Subscribe</button>
                                    </div>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            <div class="col-sm-6 col-lg-4">
                <h3>Quick Link</h3>
                <div class="h-decor"></div>
                <div class="footer-post d-flex">
                    <div class="footer-post-text">
                        <div class="footer-post-title"><a href="{{url('about')}}">About Us</a></div>
                    </div>
                </div>
                <div class="footer-post d-flex">
                    <div class="footer-post-text">
                        <div class="footer-post-title"><a href="{{url('services')}}">Offered Services</a></div>
                    </div>
                </div>
                <div class="footer-post d-flex">
                    <div class="footer-post-text">
                        <div class="footer-post-title"><a href="{{url('services')}}">Services Details</a></div>
                    </div>
                </div>
                <div class="footer-post d-flex">
                    <div class="footer-post-text">
                        <div class="footer-post-title"><a href="{{url('contact')}}">Contact Us</a></div>
                    </div>
                </div>
                <div class="footer-post d-flex">
                    <div class="footer-post-text">
                        <div class="footer-post-title"><a href="#" class="btn-link" data-toggle="modal" data-target="#modalDisclaimer">Disclaimer</a></div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4">
                <h3>Our Contacts</h3>
                <div class="h-decor"></div>
                <ul class="icn-list">
                    <li style="padding: 0px;">
                        <a href="{{url('contact')}}" class="btn btn-xs btn-gradient"><i class="icon-placeholder2"></i><span>Get directions on the map</span><i class="icon-right-arrow"></i></a>
                    </li>
                    <li><i class="icon-telephone"></i><b><span class="phone"><span class="text-nowrap">{{$settings['phone1']}}</span>, <span class="text-nowrap">{{$settings['phone2']}}</span></span></b></li>
                    <li><i class="icon-black-envelope"></i><a href="mailto:info@biopedclinic.net">{{$settings['email']}}</a></li>
                </ul>

                <div class="footer-social " style="margin-top: 20px">
                    <a href="http://www.facebook.com/sharer.php?u={{url()->current()}}" target="_blank" style="text-decoration:none">
                        <img src="http://image.noelshack.com/fichiers/2015/25/1434621881-iconmonstr-facebook-4-icon-32.png" alt="Facebook">
                    </a>
                    <a href="https://twitter.com/share?url={{url()->current()}}" target="_blank" style="text-decoration:none">
                        <img src="http://image.noelshack.com/fichiers/2015/25/1434621881-iconmonstr-twitter-4-icon-32.png" alt="Twitter">
                    </a>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{url()->current()}}" target="_blank" style="text-decoration:none">
                        <img src="http://image.noelshack.com/fichiers/2015/25/1434621881-iconmonstr-linkedin-4-icon-32.png" alt="LinkedIn">
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row text-center text-md-left">
                <div class="col-sm">Copyright © 2019 <a href="#">BioPedClinic</a></div>
                <div class="col-sm-auto ml-auto"><span class="d-none d-sm-inline">For emergency cases&nbsp;&nbsp;&nbsp;</span><i class="icon-telephone"></i>&nbsp;&nbsp;<b>{{$settings['phone1']}}</b></div>
            </div>
        </div>
    </div>
</div>
<!--//footer-->
    <div class="backToTop js-backToTop">
        <i class="icon icon-up-arrow"></i>
    </div>
<div class="modal modal-form modal-form-sm fade" id="modalQuestionForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <button aria-label='Close' class='close' data-dismiss='modal'>
                <i class="icon-error"></i>
            </button>
            <div class="modal-body">
                <div class="modal-form">
                    <h3>Ask a Question</h3>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form class="mt-15" id="questionForm">
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
                            <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Your Name*" />
                        </div>
                        <span id="error_name" style="display: none;">Field is required</span>
                        <div class="input-group">
								<span>
									<i class="icon-email2"></i>
								</span>
                            <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Your Email*" />
                        </div>
                        <span id="error_email" style="display: none;">Field is required</span>
                        <div class="input-group">
								<span>
									<i class="icon-smartphone"></i>
								</span>
                            <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Your Phone" />
                        </div>

                        <textarea name="message" class="form-control" placeholder="Your comment*"></textarea>

                        <div class="text-right mt-2">
                            <button type="button" onclick="questionForm();" class="btn btn-sm btn-hover-fill">Ask Now</button>
                        </div>
                        <input type="hidden"  name="_token" value="{{csrf_token()}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-form fade" id="modalBookingForm">
    <div class="modal-dialog">
        <div class="modal-content">
            <button aria-label='Close' class='close' data-dismiss='modal'>
                <i class="icon-error"></i>
            </button>
            <div class="modal-body">
                <div class="modal-form">
                    <h3>Book an Appointment</h3>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form class="mt-15" id="bookingForm">
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
                            <input type="text" name="bookingname" class="form-control" autocomplete="off" placeholder="Your Name*" />
                        </div>
                        <span id="error_bookingname" style="display: none;">Field is required</span>

                        <div class="row row-xs-space mt-1">
                            <div class="col-sm-6">
                                <div class="input-group">
										<span>
											<i class="icon-email2"></i>
										</span>
                                    <input type="text" name="bookingemail" class="form-control" autocomplete="off" placeholder="Your Email*" />
                                </div>
                                <span id="error_bookingemail" style="display: none;">Field is required</span>
                            </div>
                            <div class="col-sm-6 mt-1 mt-sm-0">
                                <div class="input-group">
										<span>
											<i class="icon-smartphone"></i>
										</span>
                                    <input type="text" name="bookingphone" class="form-control" autocomplete="off" placeholder="Your Phone" />
                                </div>

                            </div>
                        </div>
                        <div class="row row-xs-space mt-1">
                            <div class="col-sm-6">
                                <div class="input-group">
										<span>
											<i class="icon-birthday"></i>
										</span>
                                    <input type="text" name="bookingage" class="form-control" autocomplete="off" placeholder="Your age" />
                                </div>

                            </div>
                        </div>
                        <div class="selectWrapper input-group mt-1">
								<span>
									<i class="icon-tooth"></i>
								</span>
                            <select name="bookingservice" class="form-control">
                                <option selected="selected" disabled="disabled">Select Service</option>
                                <option value="Cosmetic Dentistry">Cosmetic Dentistry</option>
                                <option value="General Dentistry">General Dentistry</option>
                                <option value="Orthodontics">Orthodontics</option>
                                <option value="Children`s Dentistry">Children`s Dentistry</option>
                                <option value="Dental Implants">Dental Implants</option>
                                <option value="Dental Emergency">Dental Emergency</option>
                            </select>
                        </div>
                        <span id="error_bookingservice" style="display: none;">Field is required</span>
                        <div class="input-group flex-nowrap mt-1">
								<span>
									<i class="icon-calendar2"></i>
								</span>
                            <div class="datepicker-wrap">
                                <input name="bookingdate" type="text" class="form-control datetimepicker" id="bookingdatepicker" placeholder="date" value="">

                            <span id="error_bookingdate" style="display: none;">Field is required</span>
                            </div>
                        </div>
                        <div class="input-group flex-nowrap mt-1">
								<span>
									<i class="icon-clock"></i>
								</span>
                            <div class="datepicker-wrap">
                                <input name="bookingtime" type="text" class="form-control timepicker" placeholder="Time">

                            <span id="error_bookingtime" style="display: none;">Field is required</span>
                            </div>
                        </div>

                        <textarea name="bookingmessage" class="form-control" placeholder="Your comment"></textarea>


                        <div class="text-right mt-2">
                            <button type="button"  onclick="bookingForm();" class="btn btn-sm btn-hover-fill">Book now</button>
                        </div>
                        <input type="hidden"  name="_token" value="{{csrf_token()}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="modalDisclaimer">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Disclaimer</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p>People may benefit from HBOT as an adjunctive therapy alongside their conventional medical treatments. It is always recommended that clients consult their doctors if there is any medical problem before commencing HBOT.</p>
                    <p>We confirm that there is no intention implied or otherwise that HBOT is given so with the intention of it being a cure, diagnosis or as a preventative for any disease. Any references, studies or testimonials on this website and discussed at our clinic do not imply that similar results will occur when the same therapy is experienced by another.</p>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade modal-scroll" id="AppointmentModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-center">Get Appointment</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="#">
                        <!-- Appointment Type -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="form-header">Appointment Type</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="radio" class="" id="virtualConsultation" name="appointmentType" value="virtualAppointment">
                                    <label class="custom-control-label" for="virtualConsultation">Virtual Consultation</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="radio" class="" id="physicalConsultation" name="appointmentType" value="physicalAppointment">
                                    <label class="custom-control-label" for="physicalConsultation">Physical Consultation</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="radio" class="" id="DiagnosticAppointment" name="appointmentType" value="diagnosticAppointment">
                                    <label class="custom-control-label" for="DiagnosticAppointment">Diagnostic Appointment</label>
                                </div>
                            </div>
                        </div><!-- /row -->

                        <!-- Hidden Div - If selects appointment type it will open -->
                        <div class="row appointmentDoctorDiv">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Select Doctor</label>
                                    <select name="doctorList" class="form-control">
                                        <option selected>---</option>
                                        <option value="Dr. John Doe">Dr. John Doe</option>
                                        <option value="Dr. Lorem">Dr. Lorem</option>
                                        <option value="Dr. Ipsum">Dr. Ipsum</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- show hide based on radio value -->

                        <!-- Date & Time -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="form-header">Select Date & Time Slot</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectdate">Select Date</label>
                                    <input type="text" class="form-control"  name="daterange">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Select Time Slot</label>
                                    <select name="doctorList" class="form-control">
                                        <option value="">--</option>
                                        <option value="Morning (8 AM to 12 PM)">Morning (8 AM to 12 PM)</option>
                                        <option value="Afternoon (1 PM to 4 PM)">Afternoon (1 PM to 4 PM)</option>
                                        <option value="Evening (5 PM to 9 PM)">Evening (5 PM to 9 PM)</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /Row -->

                        <!-- Patient Information -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="form-header">Patient Information</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Patient Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Mobile Number</label>
                                    <input type="phone" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" class="form-control" name="age">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="doctorList" class="form-control">
                                        <option selected>---</option>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="residential">Country</label>
                                    <select name="country" class="form-control">
                                        <option selected>---</option>
                                        <option value="India">India</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="residential">City</label>
                                    <select name="city" class="form-control">
                                        <option selected>---</option>
                                        <option value="City1">City1</option>
                                        <option value="City 2">City 2</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- /Row -->

                        <!-- Privacy Check -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="form-header">Health Record Permission</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="checkbox" class="" id="privacyCheck" name="example1">
                                    <label class="custom-control-label" for="privacyCheck">Allow this Doctor to access your health record?</label>
                                </div>
                            </div>
                        </div><!-- /Row -->
                    </form>

                    <hr>

                    <div class="row">
                        <div class="col-md-12 ext-help">
                            <small><strong class="imp-small">Note:</strong> The conformation of appointment will be confirmed by our backend team and it is subject to availability of doctors or time slot.</small>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-sm not-action-btn" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-sm action-btn text-uppercase">Request Appointment</button>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- /Appointemnt Modal -->



    <!-- Upload Health Record Modal -->
    <div class="modal fade modal-scroll" id="HealthRecordFile">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Upload Health Record</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <input type="file" class="form-control" id="customFile">

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="custom-file-label" for="customFile">Record type</label>
                                    <select class="form-control">
                                        <option>-- Type --</option>
                                        <option>Prescription</option>
                                        <option>Test record</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="pull-left">
                        <button type="button" class="btn btn-sm not-action-btn" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="pull-right">

                        <button type="button" class="btn btn-sm action-btn text-uppercase">Upload File</button>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- /Upload Health Record Modal -->

</footer>
<!-- Vendors -->
<script src="{{URL::asset('public/assets/frontend/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/jquery-migrate/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/cookie/jquery.cookie.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/moment.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/popper/popper.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/waypoints/sticky.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/slick/slick.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/scroll-with-ease/jquery.scroll-with-ease.min.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/countTo/jquery.countTo.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/form-validation/jquery.form.js')}}"></script>
<script src="{{URL::asset('public/assets/frontend/vendor/form-validation/jquery.validate.min.js')}}"></script>
<!-- Custom Scripts -->
<script src="{{URL::asset('public/assets/frontend/js/app.js')}}"></script>

<script src="{{URL::asset('public/assets/frontend/form/forms.js')}}"></script>

<script type="text/javascript">
    function requestForm() {
        var  requestname = $("[name='requestname']").val();
        var  requestemail = $("[name='requestemail']").val();
        var  requestphone = $("[name='requestphone']").val();
        var  requestservice = $("[name='requestservice']").val();
        var  requestdate = $("[name='requestdate']").val();
        var  requesttime = $("[name='requesttime']").val();
        var  error=0;

        if(requestname == ""){
            $('#error_requestname').show();
            error++;
        }
        else{
            $('#error_requestname').hide();
        }

        if(requestemail == ""){
            $('#error_requestemail').show();
            error++;
        }
        else{
            $('#error_requestemail').hide();
        }
        if(requestphone == ""){
            $('#error_requestphone').show();
            error++;
        }
        else{
            $('#error_requestphone').hide();
        }
        if(requestservice == ""){
            $('#error_requestservice').show();
            error++;
        }
        else{
            $('#error_requestservice').hide();
        }
        if(requestdate == ""){
            $('#error_requestdate').show();
            error++;
        }
        else{
            $('#error_requestdate').hide();
        }
        if(requesttime == ""){
            $('#error_requesttime').show();
            error++;
        }
        else{
            $('#error_requesttime').hide();
        }
        if(error==0){
            $.ajax({
                type: "POST",
                url: "{{url('request-add')}}",
                data: $("#requestForm").serialize(),
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        $("[name='requestname']").val('');
                        $("[name='requestemail']").val('');
                        $("[name='requestphone']").val('');
                        $("[name='requestservice']").val('');
                        $("[name='requestdate']").val('');
                        $("[name='requesttime']").val('');
                        alert('Your message was sent successfully!');

                    } else {
                        printErrorMsg('error');
                    }
                }
            });
        }
    }

</script>

<script type="text/javascript">

    $("#datepicker").datetimepicker({
        format: "YYYY-MM-DD"
    });
</script>

<script type="text/javascript">
    function bookingForm() {
        var  bookingname = $("[name='bookingname']").val();
        var  bookingemail = $("[name='bookingemail']").val();
        var  bookingphone = $("[name='bookingphone']").val();
        var  bookingage = $("[name='bookingage']").val();
        var  bookingservice = $("[name='bookingservice']").val();
        var  bookingdate = $("[name='bookingdate']").val();
        var  bookingtime = $("[name='bookingtime']").val();
        var  bookingmessage = $("[name='bookingmessage']").val();
        var  error=0;

        if(bookingname == ""){
            $('#error_bookingname').show();
            error++;
        }
        if(bookingemail == ""){
            $('#error_bookingemail').show();
            error++;
        }
        if(bookingphone == ""){
            $('#error_bookingphone').show();
            error++;
        }
        if(bookingservice == ""){
            $('#error_bookingservice').show();
            error++;
        }
        if(bookingdate == ""){
            $('#error_bookingdate').show();
            error++;
        }
        if(bookingtime == ""){
            $('#error_bookingtime').show();
            error++;
        }
        if(bookingmessage == ""){
            $('#error_bookingmessage').show();
            error++;
        }
        //alert(1)
        //if(error==0)

            $.ajax({
                type: "POST",
                url: "{{url('booking-add')}}",
                data: $("#bookingForm").serialize(),
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        alert('Your message was sent successfully!');
                        $("[name='bookingname']").val('');
                        $("[name='bookingemail']").val('');
                        $("[name='bookingphone']").val('');
                        $("[name='bookingage']").val('');
                        $("[name='bookingservice']").val('');
                        $("[name='bookingdate']").val('');
                        $("[name='bookingtime']").val('');
                        $("[name='bookingmessage']").val('');
                        $("#modalBookingForm").modal('hide');
                    }
                    else {
                        printErrorMsg('error');
                    }
                }
            });


    }

</script>

<script type="text/javascript">

    $("#bookingdatepicker").datetimepicker({
        format: "YYYY-MM-DD"
    });
</script>


<script type="text/javascript">
    function questionForm1() {
        var  name = $("[name='name']").val();
        var  email = $("[name='email']").val();
        var  phone = $("[name='phone']").val();
        var  message = $("[name='message']").val();
        var  error=0;

        if(name == ""){
            $('#error_name').show();
            error++;
        }
        if(email == ""){
            $('#error_email').show();
            error++;
        }
        if(phone == ""){
            $('#error_phone').show();
            error++;
        }
        if(message == ""){
            $('#error_message').show();
            error++;
        }

        //alert(1)
        //if(error==0)

        $.ajax({
            type: "POST",
            url: "{{url('ask-add')}}",
            data: $("#questionForm1").serialize(),
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    alert('Your message was sent successfully!');
                    $("[name='name']").val('');
                    $("[name='email']").val('');
                    $("[name='phone']").val('');
                    $("[name='message']").val('');
                    //$("#modalQuestionForm").modal('hide');
                }
                else {
                    printErrorMsg('error');
                }
            }
        });


    }

</script>


<script type="text/javascript">
    function contactForm() {
        var  name = $("[name='name']").val();
        var  email = $("[name='email']").val();
        var  phone = $("[name='phone']").val();
        var  message = $("[name='message']").val();
        var  error=0;

        if(name == ""){
            $('#error_name').show();
            error++;
        }

        if(email == ""){
            $('#error_email').show();
            error++;
        }
        if(phone == ""){
            $('#error_phone').show();
            error++;
        }
        if(message == ""){
            $('#error_message').show();
            error++;
        }

        //alert(1)
        //if(error==0)

        $.ajax({
            type: "POST",
            url: "{{url('contact-add')}}",
            data: $("#contactForm").serialize(),
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    alert('Your message was sent successfully!');
                    $("[name='name']").val('');
                    $("[name='email']").val('');
                    $("[name='phone']").val('');
                    $("[name='message']").val('');
                }
                else {
                    printErrorMsg('error');
                }
            }
        });


    }

</script>


<script type="text/javascript">
    function questionForm() {
        var  name = $("[name='name']").val();
        var  email = $("[name='email']").val();
        var  phone = $("[name='phone']").val();
        var  message = $("[name='message']").val();
        var  error=0;

        if(name == ""){
            $('#error_name').show();
            error++;
        }
        if(email == ""){
            $('#error_email').show();
            error++;
        }
        if(phone == ""){
            $('#error_phone').show();
            error++;
        }
        if(message == ""){
            $('#error_message').show();
            error++;
        }

        //alert(1)
        //if(error==0)

        $.ajax({
            type: "POST",
            url: "{{url('askquetion-add')}}",
            data: $("#questionForm").serialize(),
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    alert('Your message was sent successfully!');
                    $("[name='name']").val('');
                    $("[name='email']").val('');
                    $("[name='phone']").val('');
                    $("[name='message']").val('');
                    $("#modalQuestionForm").modal('hide');
                }
                else {
                    printErrorMsg('error');
                }
            }
        });


    }

</script>


<script type="text/javascript">
    function requestNewsletter() {
        var  name = $("[name='name']").val();
        var  subscribe_mail = $("[name='subscribe_mail']").val();
        var  error=0;
        if(name == ""){
            $('#error_name').show();
            error++;
        }
        else{
            $('#error_name').hide();
        }

        if(subscribe_mail == ""){
            $('#error_subscribe_mail').show();
            error++;
        }
        else{
            $('#error_subscribe_mail').hide();
        }
        if(error==0){
            $.ajax({
                type: "POST",
                url: "{{url('emil-add')}}",
                data: $("#requestNewsletter").serialize(),
                success: function (data) {
                    if (data=='Success') {
                        $("[name='name']").val('');
                        $("[name='subscribe_mail']").val('');
                        alert('Your message was sent successfully!');

                    } else if(data=='duplicate'){
                        alert('You have already subscribed.');
                    }else if(data=='failure'){
                        alert('Failed to subscribe, please try again.');
                    }
                }
            });
        }
    }

</script>
