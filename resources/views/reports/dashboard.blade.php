@extends($role == '4' ? 'admin.include.layout' : 'admin.include.super_layout')
@section('after_styles')
@endsection
@section('body')
 
        <section class="repoting-form dashboard">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <h1>Download Report</h1>                   
                     <div class="tab-content">                        
                        <div>	
							<form method="post" action="{{url('admin/gen_report')}}">
							 <ul class="reporting-form incidentInfo">	
								<li> 
									<div class="form-group">
										<label for="">Report Type</label><span style="color:red">*</span>
										<select class="form-control" name="rep_type" style="width:300px;" required> 
											<option value="">Please Select</option>
											<option value="to" {{ $rep_type == 'to' ? 'selected' : ''}}>Total Incident</option> 
											<option value="rm" {{ $rep_type == 'rm' ? 'selected' : ''}}>Pending Incidents with Reporting Manager(s)</option> 
											<option value="sf" {{ $rep_type == 'sf' ? 'selected' : ''}}>Pending Incidents with Safety Champion(s)</option> 
										</select>
									</div>
								</li>
								
								<li>
									<div class="form-group">									
										<label for="">Date of Incident </label><span style="color:red">*</span><br/>
										<label for="">From Date : <input name="incident_from_date" id="incident_date" type="text" value="{{$from_date}}" style="width:200px;" class="form-control datetimepicker" required></label>
										<label for="">To Date :   <input name="incident_to_date" id="incident_date" type="text" value="{{$to_date}}" style="width:200px;" class="form-control datetimepicker" required></label>
									</div>
								</li>
								
								<li>
									<div class="form-group">									
										<label for="">Incident No </label><br/>
										<input name="incident_no" id="incident_no" type="text" value="{{$incident_no}}" style="width:300px;" class="form-control"></label>										
									</div>
								</li>
								
								<li> @php $incident=App\Helpers\UserHelper::Incident_type(); @endphp
									<div class="form-group">
										<label for="">Type of Incident </label>
										<select class="form-control" name="Type" style="width:300px;"> 
											<option value="">Please Select</option>
											@foreach($incident as $inci)
											 <option value="{{$inci->id}}" {{ $Type == $inci->id ? 'selected' : ''}}>{{$inci->incident_t}}</option> 
											@endforeach 
										</select>
									</div>
								</li>	
								<li> @php $status_type=App\Helpers\UserHelper::Status_type(); @endphp
									<div class="form-group">
										<label for="">Status of Injured Person </label>
										<select class="form-control" name="Status" style="width:300px;"> 
											<option value="">Please Select</option>
											@foreach($status_type as $sta)
											<option value="{{$sta->id}}" {{ $Status == $sta->id ? 'selected' : ''}}>{{$sta->status_name}}</option> 
											@endforeach 
										</select>
									</div>
								</li>
								<li> @php $state=App\Helpers\UserHelper::State(); @endphp
									<div class="form-group">
										<label class="state1" for="">State </label>
										<select class="form-control" id="state1" name="State" style="width:300px;"> 
											<option value="">Please Select</option>
											@foreach($state as $sta)
											<option value="{{$sta->id}}" {{ $State == $sta->id ? 'selected' : ''}}>{{$sta->name}}</option> 
											@endforeach 
										</select>
									</div>
								</li>
								<li> @php $district=App\Helpers\UserHelper::District($State); @endphp
									<div class="form-group">
										<label class="dis1" for="">District </label>
										<select class="form-control" id="dis1" name="District" style="width:300px;"> 
											@foreach($district as $dis)
											<option value="{{$dis->id}}">{{$dis->name}}</option> 
											@endforeach 
										</select>
									</div>
								</li>
								<li> @php $city=App\Helpers\UserHelper::City($State); @endphp
									<div class="form-group">
										<label class="city1" for="">City </label>
										<select class="form-control" id="city1" name="City" style="width:300px;"> 
											@foreach($city as $ci)
											<option value="{{$ci->id}}">{{$ci->name}}</option> 
											@endforeach 
										</select>
									</div>
								</li>								
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<li>										
									<button type="submit" name="view_rep" value="view_rep" class="btn-Dark" id="view_rep">View Report</button>
									@if (Request::segment(2)  == 'gen_report')
									<button type="button" name="download_rep" value="download" class="btn-Dark" id="download_rep" onclick="exportReport();">Download Excel</button>
									@endif
									<button type="reset" name="back" value="back" class="btn-Dark" id="back" onclick='location.href ="{{url('admin/manage-report')}}"'>Back</button>
								</li>
							</ul>	
						  </form>
                        </div> 
						
							<!-- ========= start table ========= -->
							
                            <div class="table-responsive">
							
                                <table class="table table-striped">
                                    <thead> 									
                                        <tr>
                                            <th>Incident No.</th>
											<th>Employee ID</th>
											<th>Employee Name</th>
											<th>Zone</th>
											<th>Plant</th>
											<th>Employee SBU</th>
											<th>Employee Branch</th>
											<th>Employee Department</th>
                                            <th>Incident Date & Time</th>                                            
                                            <th>Employee Reported Date & Time</th>                                            
                                            <th>Type of Incident</th> 
                                            <th>Exact Location of Incident</th>
                                            <th>Incident Description</th>
                                            <th>Status of Injured Person</th>
                                            <th>State</th>
                                            <th>District</th>
											<th>City</th>
											<th>RM Name</th>
											<th>RM 1st Action Date & Time</th>
											<th>RM Last Action Date & Time</th>
											<th>RM TAT</th>
											<th>RM Comments</th>
											<th>SH Action Date & Time</th>
											<th>SH TAT</th>
											<th>SH Comments</th>
                                            <th>Incident Status</th>
                                            <!--<th>Action</th>-->
                                        </tr>                                              
                                    </thead>                                 
                                        
										@if(!empty($tabledata) > 0)  
                                            <tbody>
                                            @foreach($tabledata as $table)
                                            <tr>
                                            <td>{{$table->in_id}}</td>
                                            <td>{{$table->emp_id}}</td>	
                                            <td>{{$table->emp_name}}</td>	
											@php $empZone = App\Helpers\UserHelper::GetEmpZone($table->emp_email);@endphp
                                            <td>{{$empZone}}</td>	
                                            <td>{{$table->plant}} - {{$table->plant_name}}</td>	
                                            <td>{{$table->sbu}}</td>	
                                            <td>{{$table->plant_name}}</td>	
                                            <td>{{$table->b_func}}</td>	
                                            <td>{{date('d/m/Y',strtotime($table->incident_date))}} {{$table->incident_time}}</td>
											<td>{{date('d/m/Y',strtotime($table->emp_crdt))}}</td>
                                            <td>{{$table->actiontype}}</td>
                                            <td>{{$table->incident_location}}</td>
                                            <td>{{$table->incident_description}}</td>
                                            <td>{{$table->status_name}}</td>                                            
                                            <td>{{$table->staname}}</td>
                                            <td>{{$table->disname}}</td>
                                            <td>{{$table->cityname}}</td>
											@php $RMName = App\Helpers\UserHelper::GetRMName($table->manager_id); @endphp
                                            <td>{{$RMName}}</td>
											@php $RMFirstComment = App\Helpers\UserHelper::GetRM1stComment($table->in_id); @endphp
                                            <td>{{$RMFirstComment}}</td> 
											@php $RMlcmnt = App\Helpers\UserHelper::GetRMLastComment($table->in_id); 
												$rmLst = explode("-", $RMlcmnt);
												$RMLastcmnt = $rmLst[0];
												$RMcmnt = $rmLst[1];
											@endphp
											<td>{{$RMLastcmnt}}</td> 
											@php	
												
													$empCrDt = strtotime($table->emp_crdt);	
													$var1 = substr($RMFirstComment,0,10);
													$date1 = str_replace('/', '-', $var1);
													$RMLastCmntdt = strtotime($date1);
													$RMTAT = (($RMLastCmntdt - $empCrDt)/86400);	
												
											@endphp
											<td>{{$RMTAT}}</td> 	
											<td>{{$RMcmnt}}</td> 	
											<td>@if($table->sf_date != '')
													{{date('d/m/Y',strtotime($table->sf_date))}} {{$table->sf_time}}
												@endif
											</td> 
											@php
												
													$to = strtotime($table->sf_date);	
													$var = substr($RMLastcmnt,0,10);
													$date = str_replace('/', '-', $var);
													$RMLastcmntdt = strtotime($date);
													$SFTAT = (($to - $RMLastcmntdt)/86400);
												
											@endphp		
											<td>@if($table->sf_date != '')
													{{$SFTAT}}
												@endif
											</td> 
											<?php
											if($table->extra_info == 'yes'){
												$shCmnt = $table->need_informationsh;
											}else{
												$shCmnt = App\Helpers\UserHelper::GetSFComment($table->in_id);
											}?>											
											<td>{{$shCmnt}}</td> 
                                            <td>{{$table->status_e == 0 ? 'Close' :'Open'}}</td>  
											<!--<td><a href="{{ url('admin/admin-view').'/'.$table->in_id}}">View</a></td>-->
                                            </tr>
                                            @endforeach											
                                            </tbody>
                                        @else 
											<tbody>
											  <tr>
											    <td colspan='27' align ="center">No data found</td>
											  </tr>
											</tbody>
                                        @endif  
                                </table>
                            </div>
                            <!-- ========= end table ========= -->						
                    </div>
                </div>
            </div>
        </div>
    </section>

 @endsection
 @section('after_scripts')
<script type="text/javascript">
$('.datetimepicker').datepicker({
	format: 'dd/mm/yyyy',
	autoclose: true,
	//startDate:'today',
	//endDate: "today",	
	todayHighlight: true,
	orientation: 'bottom'
});

$(function() {
	var d = new Date(),
		h = d.getHours(),
		m = d.getMinutes();
	if(h < 10) h = '0' + h;
	if(m < 10) m = '0' + m;
	$('#zatime').each(function() {
		$(this).attr({
			'value': h + ':' + m
		});
	});
});

$('#state1').change(function(event) {
	var model = $(this).val();	
	$.ajax({
		url: '{{ url("/admin/admin-statecity") }}',
		type: 'POST',
		data: {
			model: model,
			'_token': '{{csrf_token()}}'
		},
	}).done(function(response) {		
		$('.city1').show();
		$('#city1').html(response);		
		console.log("success");
	}).fail(function() {
		console.log("error");
	}).always(function() {
		console.log("complete");
	});
});

$('#state1').change(function(event) {
	var model = $(this).val();	
	$.ajax({
		url: '{{ url("/admin/admin-statedis") }}',
		type: 'POST',
		data: {
			model: model,
			'_token': '{{csrf_token()}}'
		},
	}).done(function(response) {		
		$('.dis1').show();
		$('#dis1').html(response);		
		console.log("success");
	}).fail(function() {
		console.log("error");
	}).always(function() {
		console.log("complete");
	});
});

function exportReport(){
	var url = 'http://myapps.gainwellindia.com/Incident-Reporting/public/assets/uploads/IncidentReport.xlsx';
	window.open(url, '_blank');	
}
       
</script>
@endsection