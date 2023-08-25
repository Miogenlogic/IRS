@extends('admin.include.layout')
@section('after_styles')
<!-- <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}"> -->
@endsection
@section('body')
 <section class="repoting-form">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Health & Emergency Information</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li><a href="{{url('admin/employee-personalform')}}">Personal Information</a></li>
                        <li><a data-toggle="tab" href="#emergencyInfo" class="active">Health &amp; emergency Information</a></li>
                        <li><a   href="{{url('admin/employee-incident')}}">Report Incident</a></li>
                    </ul>

                    <div class="tab-content">
       <!-- ============================ Start: Emergency Information Tab ============================ -->
                        <div id="emergencyInfo" class="tab-pane fade active show active">
                            <h4>Health & Emergency Information</h4>
                            <form method="post" action="{{url('admin/employee-myhealthedit')}}" enctype="multipart/form-data">
                                <ul class="reporting-form emergencyInfo">
                                    <li>
                                        <div class="form-group">
                                            <label for="">Emergency Contact Person Name</label><span style="color:red">*</span>
                                            <input name="emp_conp" type="text" class="form-control" value="{{$report['emergency_contactname']}} "required>
                                        </div>
                                    </li>
									
									 <li>
                                        <div class="form-group d-flex align-items-center">
                                            <label> Are you suffering from any illness or disease?</label><span style="color:red">*</span>
                                            <!-- Start: on-off-background-radio-btn -->
                                            <div class="r_act_ina" name="diabetic" style="padding-left: 60px;">
                                                @if($report['illness'] == 'yes')
                                                <input type="radio" name="options1" value="yes" checked="checked" class="yes"required>
                                                <input type="radio" name="options1" value="no" class="no"required >
                                                @else
                                                <input type="radio" name="options1" value="yes"  class="yes"required>
                                                <input type="radio" name="options1" value="no" class="no" checked="checked"required>
                                                @endif
                                            </div>
                                            <!-- end: on-off-background-radio-btn -->
                                        </div>
                                    </li>
									
									<li>
									 <div class="form-group">
                                            <label for="">Relationship</label><span style="color:red">*</span>
                                            <input name="relation" type="relation" class="form-control" value="{{$report['relation']}}"required>
                                        </div>                                      
                                    </li>
									
									<li>
                                        <div class="form-group d-flex align-items-center">
                                            <label>Do you have history of Blood Pressure?</label><span style="color:red">*</span>
                                            <!-- Start: on-off-background-radio-btn -->
                                            <div class="r_act_ina" name="bp">
                                                @if($report['bp_problem'] == 'yes')
                                                 <input type="radio" name="options2" value="yes" checked="checked" class="yes"required>
                                                <input type="radio" name="options2" value="no" class="no"required >
                                                @else
                                                <input type="radio" name="options2" value="yes"  class="yes"required>
                                                <input type="radio" name="options2" value="no" class="no" checked="checked"required>
                                                @endif
                                            </div>
                                            <!-- end: on-off-background-radio-btn -->
                                        </div>
                                    </li>
                                    
                                    <li>
									 <div class="form-group">
                                            <label for="">Emergency Contact Number</label><span style="color:red">*</span>
                                            <input name="mobile" type="emp_number" class="form-control" value="{{$report['emergency_number']}}"required>
                                        </div>                                      
                                    </li>
									
									<li>
                                        <div class="form-group d-flex align-items-center">
                                            <label>Are you suffering from any respiratory disorders?</label><span style="color:red">*</span>
                                            <!-- Start: on-off-background-radio-btn -->
                                            <div class="r_act_ina" name="sinus">
                                                @if($report['sinus'] == 'yes')
                                                <input type="radio" name="options3" value="yes" checked="checked" class="yes"required>
                                                <input type="radio" name="options3" value="no" class="no"required >
                                                @else
                                                <input type="radio" name="options3" value="yes"  class="yes"required>
                                                <input type="radio" name="options3" value="no" class="no" checked="checked"required>
                                                @endif                                               
                                            </div>
                                            <!-- end: on-off-background-radio-btn -->
                                        </div>
                                    </li>
									
                                    <li>
                                         <div class="form-group">
                                            <label for="">Blood Group</label><span style="color:red">*</span>
											<select class="form-control"  name="emp_blood"required>
											 <option value="">Select</option>
                                                <option value="A+" {{ $report['blood_group'] == 'A+' ? 'selected' : '' }}>A+</option>
                                                <option value="O+" {{ $report['blood_group'] == 'O+' ? 'selected' : '' }}>O+</option> 
                                                <option value="B+" {{ $report['blood_group'] == 'B+' ? 'selected' : '' }}>B+</option> 
                                                <option value="AB+" {{ $report['blood_group'] == 'AB+' ? 'selected' : '' }}>AB+</option> 
                                                <option value="A-" {{ $report['blood_group'] == 'A-' ? 'selected' : '' }}>A-</option> 
                                                <option value="O-" {{ $report['blood_group'] == 'O-' ? 'selected' : '' }}>O-</option> 
                                                <option value="B-" {{ $report['blood_group'] == 'B-' ? 'selected' : '' }}>B-</option> 
                                                <option value="AB-" {{ $report['blood_group'] == 'AB-' ? 'selected' : '' }}>AB-</option> 
                                            </select> 
                                            <!--<input name="emp_blood" type="text" class="form-control" value="{{$report['blood_group']}}"required >-->
                                        </div>
                                    </li>
									<li>
                                        <div class="form-group d-flex align-items-center">
                                            <label>Are you Diabetic?</label><span style="color:red">*</span>
                                            <!-- Start: on-off-background-radio-btn -->
                                            <div class="r_act_ina" name="diabetic" >
                                                  @if($report['diabetic'] == 'yes')
                                                <input type="radio" name="options4" value="yes" checked="checked" class="yes"required>
                                                <input type="radio" name="options4" value="no" class="no" required>
                                                @else
                                                <input type="radio" name="options4" value="yes"  class="yes"required>
                                                <input type="radio" name="options4" value="no" class="no" checked="checked"required>
                                                @endif
                                            </div>
                                            <!-- end: on-off-background-radio-btn -->
                                        </div>
                                    </li>
                                    
                                    <li>
                                        <div class="form-group">
                                            <label for="">Any other information you want to share? </label><span style="color:red">*</span>
                                            <input name="information" type="text" class="form-control" value="{{$report['information_share']}}" required>
                                        </div>
                                    </li>
									
									<li>
                                        <div class="form-group d-flex align-items-center">
                                            <label>Are you allergic to anything?</label><span style="color:red">*</span>
                                            <!-- Start: on-off-background-radio-btn -->
                                            <div class="r_act_ina" name="allergic">
                                                   @if($report['allergic'] == 'yes')
                                                <input type="radio" name="options5" value="yes" checked="checked" class="yes"required>
                                                <input type="radio" name="options5" value="no" class="no"required >
                                                @else
                                                 <input type="radio" name="options5" value="yes"  class="yes"required>
                                                <input type="radio" name="options5" value="no" class="no" checked="checked"required>
                                                @endif
                                            </div>
                                            <!-- end: on-off-background-radio-btn -->
                                        </div>
                                    </li>									
                                    
									<!--<li>
                                        <div class="form-group">
                                            <label for=""> </label>                                            
                                        </div>
                                    </li>
									
									<li>
                                        <div class="form-group d-flex align-items-center">
                                            <label>Have you taken 1st Dose of COVID Vaccine?</label><span style="color:red">*</span>                                            
                                            <div class="r_act_ina" name="1st_vaccine">
                                                @if($report['first_vaccine'] == 'yes')
                                                <input type="radio" name="options6" value="yes" class="yes" checked="checked" required>
                                                <input type="radio" name="options6" value="no" class="no" required >
                                                @else
                                                 <input type="radio" name="options6" value="yes" class="yes" required>
                                                <input type="radio" name="options6" value="no" class="no" checked="checked" required>
                                                @endif
                                            </div>                                            
                                        </div>
                                    </li>
									
									<li>
                                        <div class="form-group">
                                            <label for=""> </label>                                            
                                        </div>
                                    </li>
									
									<li>
                                        <div class="form-group d-flex align-items-center">
                                            <label>Have you taken 2nd Dose of COVID Vaccine?</label><span style="color:red">*</span>                                            
                                            <div class="r_act_ina" name="2nd_vaccine">
                                                @if($report['second_vaccine'] == 'yes')
                                                <input type="radio" name="options7" value="yes" class="yes" checked="checked" required>
                                                <input type="radio" name="options7" value="no" class="no" required >
                                                @else
                                                 <input type="radio" name="options7" value="yes"  class="yes" required>
                                                <input type="radio" name="options7" value="no" class="no" checked="checked"required>
                                                @endif
                                            </div>                                            
                                        </div>
                                    </li>-->
                                  
                                     <input type="hidden" name="id" value="{{$report['id']}}">
                                     <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <li>
                                       
                                        <button type="submit" class="btn-Dark">Submit</button>
                                    </li>
                                </ul>

                            </form>

                        </div>
                        <!-- ============================ End: Emergency 

                            Information Tab ============================ -->
                 </div>
                </div>
            </div>
        </div>
    </section>
         @endsection
        @section('after_scripts')

         <script type="text/javascript">
    $(document).ready(function () {
    $('.tabs li a').click(function(e) {

        $('.tabs li.active').removeClass('active');

        var $parent = $(this).parent();

        $parent.addClass('active');
        e.preventDefault();
    });
});
    </script>
  
          <!-- =================== start back to top =================== -->
    <script type="text/javascript">
        $(document).ready(function() {
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear'
            };

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });

    </script>
    <a href="#" id="toTop" class="hover-bounce"></a>
    <!-- =================== end back to top =================== -->

    <!-- ================== bootstrap tooltip ================== -->
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>

</body>

</html>
    @endsection