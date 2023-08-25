@extends('admin.include.layout')
@section('after_styles')
<link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}">
@endsection
<!--  <?php //dd($report);exit;?>  -->
        @section('body')
        <section class="repoting-form">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Personal Information</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li><a  id="Personal" data-toggle="tab" href="#peronalInfo" class="active">Personal Information</a></li>
                        <li><a  id="Health"  href="{{url('admin/admin-myhealth')}}">Health &amp; Emergency Information</a></li>
                        <li><a  id="Incident" href="{{url('admin/admin-incident')}}">Incident</a></li>
                    </ul>

                    <div class="tab-content">
 <!-- ============================ Start: Personal Information Tab ============================ -->
                        <div id="peronalInfo" class="tab-pane fade active show active">
                            <h4>Personal Information</h4>
                            <form method="post" action="{{url('admin/admin-reporteditstore')}}" enctype="multipart/form-data">
                                <ul class="reporting-form peronalInfo">
                                    <li>
                                        <div class="form-group">
                                            <label for="">Employee ID</label><span style="color:red">*</span>
                                            <input name="empId" type="text" class="form-control" value="{{$report['emp_no']}}"disabled>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Employee Name</label>
                                            <input name="emp_name" type="text" class="form-control" value="{{$report['name']}}" disabled>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Grade</label><span style="color:red">*</span>
                                            <input name="grade" type="text" class="form-control" value="{{$report['grade']}}"disabled>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Email ID</label><span style="color:red">*</span>
                                            <input name="email_id" type="text" class="form-control" value="{{$report['email']}}"disabled>
                                        </div>
                                    </li>
									<li>
                                        <div class="form-group">
                                            <label for="">DOB</label><span style="color:red">*</span>
                                            <input type="text" name="dob" class="form-control date-picker-dob datetimepicker1" data-datepicker-color="primary" value="{{date('d/m/Y',strtotime($empExtra['employee_dob']))}}"required>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Age</label><span style="color:red">*</span>
                                            <input name="age" type="text" class="form-control" value="{{$empExtra['employee_age']}}"required>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Sex</label><span style="color:red">*</span>
											<select class="form-control"  name="sex"required>
											 <option value="">Select</option>
                                                <option value="M" {{ $empExtra['employee_sex'] == 'M' ? 'selected' : '' }}>Male</option>
                                                <option value="F" {{ $empExtra['employee_sex'] == 'F' ? 'selected' : '' }}>Female</option> 
                                            </select>                                            
                                        </div>
                                    </li>                                    
                                    <li>
                                        <div class="form-group">
                                            <label for="">DOJ</label><span style="color:red">*</span>
                                            <input type="text" name="doj" class="form-control date-picker-doj datetimepicker1" data-datepicker-color="primary" value="{{date('d/m/Y',strtotime($report['doj']))}}"disabled>
                                        </div>
                                    </li>                                   
                                    <li>
                                        <div class="form-group">
                                            <label for="">Designation</label><span style="color:red">*</span>
											<input name="desig" type="text" class="form-control" value="{{$report['desg']}}"disabled>                                          
                                        </div>
                                    </li>
									<li>
                                        <div class="form-group">
                                            <label for="">SBU</label><span style="color:red">*</span>
                                            <input name="sbu" type="text" class="form-control" value="{{$report['sbu']}}"disabled>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Department</label><span style="color:red">*</span>
                                            <input name="department" type="text" class="form-control" value="{{$report['b_func']}}"disabled>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Branch</label><span style="color:red">*</span>
                                            <input name="salesOffice" type="text" class="form-control" value="{{$report['plant_name']}}"disabled>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Zone</label><span style="color:red">*</span>
                                            <input name="zone" type="text" class="form-control" value="{{$report['employee_zone']}}"required>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Primary Mobile number</label><span style="color:red">*</span>
                                            <input name="mobile" type="number" class="form-control" value="{{$report['tphn_no1']}}"required>
                                        </div>
                                    </li>
									<li>
                                        <div class="form-group">
                                            <label for="">Secondary Mobile number</label>
                                            <input name="mobile" type="number" class="form-control" value="{{$report['tphn_no1']}}"disabled>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Reporting Manager</label>											
                                            <input name="reportingManager" type="text" class="form-control" value="@if(!empty($report['rpt_to'])){{$report['rpt_to']}}@endif" disabled>
                                        </div>
                                    </li>
                                    <li>
                                         <div class="form-group">
                                            <label for="">Address</label><span style="color:red">*</span>
                                            <input name="address" type="textarea " class="form-control" rows="4" cols="50" value="{{$empExtra['employee_address']}}"required>
                                        </div>                                      
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Safety Head</label>
                                            <input name="safetyHead" type="text" class="form-control" value="@if(!empty($safety->safety)){{$safety->safety}}@endif" disabled>
                                        </div>
                                    </li>
                                        <input type="hidden" name="id" value="{{$report['id']}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <li>
                                       <!--  <button type="submit" class="btn-Primary" home>Save</button> -->
                                        <button type="submit" class="btn-Dark">Submit</button>
                                    </li>
                                </ul>
                            </form>

                        </div>
                        <!-- ============================ End: Personal Information Tab ============================ -->
          </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
 @section('after_scripts')
          <script type="text/javascript">

           $('.datetimepicker1').datepicker({  

       format: 'dd/mm/yyyy',
        autoclose: true,
       
        // startDate:'today',
         orientation: 'bottom'

     }); 
    </script>
    @endsection