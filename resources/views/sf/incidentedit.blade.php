@extends('admin.include.layout') 
@section('after_styles')
@endsection
@section('body')  
@if ($role == '2') 
@php $read = " ";@endphp 
@else 
@php $read = "disabled";@endphp 
@endif 

<section class="repoting-form">
	<div class="container">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
			<li class="breadcrumb-item active" aria-current="page">Incident Reporting</li>
		</ol>
		<div class="card">
			<div class="card-body">				
				<div class="tab-content">
					<div id="incidentInfo" class="tab-pane fade active show">
						<h4>Incident Reporting</h4>
						<form method="post" action="{{url('admin/admin-incident-editstore')}}" enctype="multipart/form-data">
							<ul class="reporting-form incidentInfo">
								<li>
									<div class="form-group">
										<label for="">Employee Name </label>
										<input name="empName" type="text" class="form-control" value="{{$edit[0]['name']}}" readonly> </div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Date of Incident </label>
										<input name="Date" id="date1234" type="text" class="form-control datetimepicker" value="{{date('d/m/Y',strtotime($edit[0]['incident_date']))}}" {{$read}} autocomplete="off" required> </div>
								</li>
								<li>
									<div class="form-group clockpicker">
										<label for="">Time of Incident </label>
										<input name="Time" id="time" type="text" class="form-control" value="{{$edit[0]['incident_time']}}" {{$read}} autocomplete="off" required> </div>
								</li>
								<li> @php $incident=App\Helpers\UserHelper::Incident_type(); @endphp
									<div class="form-group">
										<label for="">Type of Incident </label>
										<select class="form-control" name="Type" {{$read}} required> @foreach($incident as $inci)
											<option value="{{$inci->id}}" {{ $edit[0]['inc_type'] == $inci->id ? 'selected' : ''}} >{{$inci->incident_t}}</option> @endforeach </select>
									</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Exact Location of Incident </label>
										<input name="Location" type="text" class="form-control" value="{{$edit[0]['incident_location']}}" {{$read}} required> </div>
								</li>
								<li class="textarea">
									<div class="form-group">
										<label for="">Brief Description of Incident</label>
										<textarea name="Description" type="text" class="form-control" {{$read}} style="height: 70px !important;" required>{{$edit[0]['incident_description']}}</textarea>
									</div>
								</li>
								<li> @php $status_type=App\Helpers\UserHelper::Status_type(); @endphp
									<div class="form-group">
										<label for="">Status of Injured Person </label>
										<select class="form-control" name="Status" {{$read}} required> @foreach($status_type as $sta)
											<option value="{{$sta->id}}" {{ $edit[0]['injured_status'] == $sta->id ? 'selected' : ''}} >{{$sta->status_name}}</option> @endforeach </select>
									</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Image1 </label>
										<div style="position: relative;">
											<input type="file" name="Image" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit[0]['image']}}" {{$read}}> @if($edit[0]['image']!='')
											<?php 
										$word = "base64";
		  
										if(strpos($edit[0]['image'], $word) !== false){ ?> <img src="{{$edit[0]['image']}}" style="hight:50px;width:50px;" />
												<?php } else { ?> <a href="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image']}}" data-fancybox="fancybox1"><img src="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image']}}" style="hight:50px;width:50px;"/ > </a>
													<?php } ?>
									</div> @endif </div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Image2 </label>
										<div style="position: relative;">
											<input type="file" name="Image2" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit[0]['image2']}}" {{$read}}> @if($edit[0]['image2']!='')
											<?php 
										$word = "base64";
		  
										if(strpos($edit[0]['image2'], $word) !== false){ ?> <img src="{{$edit[0]['image2']}}" style="hight:50px;width:50px;" />
												<?php } else { ?> <a href="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image2']}}" data-fancybox="fancybox1"><img src="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image2']}}" style="hight:50px;width:50px;"/ > </a>
													<?php } ?>
									</div> @endif </div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Image3 </label>
										<div style="position: relative;">
											<input type="file" name="Image3" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit[0]['image']}}" {{$read}}> @if($edit[0]['image3']!='')
											<?php 
										$word = "base64";
		  
										if(strpos($edit[0]['image3'], $word) !== false){ ?> <img src="{{$edit[0]['image3']}}" style="hight:50px;width:50px;" />
												<?php } else { ?> <a href="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image3']}}" data-fancybox="fancybox1"><img src="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image3']}}" style="hight:50px;width:50px;"/ > </a>
													<?php } ?>
									</div> @endif </div>
								</li>
								<li> @php $state=App\Helpers\UserHelper::State(); @endphp
									<div class="form-group">
										<label class="state1" for="">State </label>
										<select class="form-control" id="state1" name="State" {{$read}} required> @foreach($state as $sta)
											<option value="{{$sta->id}}" {{$edit[0]['state']== $sta->id ? 'selected' : ''}}>{{$sta->name}}</option> @endforeach </select>
									</div>
								</li>
								<li> @php $district=App\Helpers\UserHelper::District($edit[0]['state']); @endphp
									<div class="form-group">
										<label class="dis1" for="">District </label>
										<select class="form-control" id="dis1" name="District" {{$read}} required> @foreach($district as $dis)
											<option value="{{$dis->id}}" {{$edit[0]['district'] == $dis->id ? 'selected' : ''}} >{{$dis->name}}</option> @endforeach </select>
									</div>
								</li>
								<li> @php $city=App\Helpers\UserHelper::City($edit[0]['state']); @endphp
									<div class="form-group">
										<label class="city1" for="">City </label>
										<select class="form-control" id="city1" name="City" {{$read}} required> @foreach($city as $ci)
											<option value="{{$ci->id}}" {{$edit[0]['city'] == $ci->id ? 'selected' : ''}}>{{$ci->name}}</option> @endforeach </select>
									</div>
								</li>
								<input type="hidden" name="id" value="{{$edit[0]['id']}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
							</ul>
						</form>
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>
						<br/>
						<div style="margin-top: 20px;">
							<label> <strong class="bold" style="font-size: 19px;padding: 5px 20px;border: 1px solid #e6e5e5;color: coral;">Reporting Manager comments table</strong></label>
						</div>						
						<table class="table table-striped">
								<thead>
									<tr>
										<th>Date</th>
										<th>Time</th>
										<th>Comment</th>
									</tr>
								</thead> 								
								@if(isset($edit[0]['rm_rej_cmnt']) && ($edit[0]['rm_rej_cmnt'] != ' '))
									<tbody>
									<tr>
										<td> {{date('d/m/Y',strtotime($edit[0]['action_date']))}} </td>
										<td>{{$edit[0]['action_time']}}</td>
										<td>{{$edit[0]['rm_rej_cmnt']}}</td>
									</tr> 
									</tbody> 
								@else
								  @if(!empty($rmedit))
									<tbody> 
										@foreach($rmedit as $rmedt)
										<tr>
											<td>{{date('d/m/Y',strtotime($rmedt['rm_date']))}} </td>
											<td>{{$rmedt['rm_time']}}</td>
											<td>{{$rmedt['rm_comment']}}</td>
										</tr> 
										@endforeach 
									</tbody> 
								  @endif 	
								@endif	
						</table>
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>
						<br/>
						<div style="margin-top: 20px;">
							<label> <strong class="bold" style="font-size: 19px;padding: 5px 20px;border: 1px solid #e6e5e5;color: coral;">Safety Champion comments table</strong></label>
						</div>						
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Date</th>
										<th>Time</th>
										<th>Comment</th>
									</tr>
								</thead> 								
								@if(!empty($shedit))
									<tbody> 
									@foreach($shedit as $shedt)									
										<tr>
											<td>{{date('d/m/Y',strtotime($shedt['sf_date']))}} </td>
											<td>{{$shedt['sf_time']}}</td>
											<td>{{$shedt['sf_comment']}}</td>
										</tr> 
									@endforeach 
								@endif
								
									@if($edit[0]['extra_info'] == 'yes')
									<tr>
										<td>{{date('d/m/Y',strtotime($edit[0]['safety_date']))}} </td>
										<td>{{$edit[0]['safety_time']}}</td>
										<td>{{$edit[0]['need_informationsh']}}</td>
									</tr> 
									@endif	
									</tbody> 								 
						</table>
						
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div><br/>						
						<!-- ============================ Start: Safety Head ============================ -->						
						@if( $flag != 'view')
						@if( $role == '4')
						<form method="post" action="{{url('admin/sf-shcomment')}}" enctype="multipart/form-data">
							<div style="margin-top: 20px;">
								<label> <strong class="bold" style="font-size: 19px;padding: 5px 20px;border: 1px solid #e6e5e5;color: coral;">Safety Champion</strong></label>
							</div>
							
							<ul style="margin-top: 0;">
								<li>
									<div class="form-group">
										<label for="">Date of Action</label><span style="color:red">*</span> 										
										<input name="safetydate" type="text" id="date12sahead" class="form-control datetimepicker1r" value="{{$todayDate}}" autocomplete="off" required {{$isComment}} readonly> 
									</div>										
								</li>
								<li>
									<div class="form-group ">
										<label for="">Time of Action </label><span style="color:red">*</span>									
										<input {{$isComment}} name="safetytime" id="satime" type="time" class="form-control " value="now" autocomplete="off" required readonly>
										</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Incident Close</label><span style="color:red">*</span>
										<select {{$isComment}} class="form-control" id="inci_close" name="inci_close" required>
											<!--<option value="1" {{$edit->status_e == '1' ?'Selected':''}}>Open</option>
											<option value="0" {{$edit->status_e == '0' ?'Selected':''}}>Close</option>-->
											<option value="1" {{$edit->status_e == '1' ?'Selected':''}}>Reject</option>
											<option value="0" {{$edit->status_e == '0' ?'Selected':''}}>Accept</option>
										</select>
									</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Additional Information</label><span style="color:red">*</span>
										<select {{$isComment}} class="form-control" onchange="Extra(event)" name="needinfo" id="needinfo" required>
											<option value="no" {{$edit->extra_info == 'no' ?'Selected':''}}>No</option>
											<option value="yes" {{$edit->extra_info == 'yes' ?'Selected':''}}>Yes</option>											
										</select>
									</div>
								</li>
								
								<li class="textarea">
									<div class="form-group" id="sf_cmnt">
										<label for="">Comment </label><span style="color:red">*</span> 
										@if(!empty($edit->safety_comment))
										<textarea {{$isComment}} name="safetycomment" type="text" id="safety_comment" class="form-control" maxlength="500" required style="height: 60px !important;">{{$edit->safety_comment}}</textarea> 
										<span id="rchars">500</span> Character(s) Remaining
										@else
										<textarea {{$isComment}} name="safetycomment" type="text" id="safety_comment" class="form-control" maxlength="500" required style="height: 60px !important;"></textarea> 
										<span id="rchars">500</span> Character(s) Remaining
										@endif 
									</div>
								</li>
								
								<li class="textarea" id="shneed">
									<div class="form-group">
										<label for="">Proposed Corrective Actions</label><span style="color:red">*</span> 
										@if(!empty($edit->need_informationsh))
										<textarea {{$isComment}} name="shneed" id="shneed_inf" type="text" class="form-control" maxlength="500" style="height: 60px !important;">{{$edit->need_informationsh}}</textarea> 
										<span id="rchars1">500</span> Character(s) Remaining
										@else
										<textarea {{$isComment}} name="shneed" id="shneed_inf" type="text" class="form-control" maxlength="500" style="height: 60px !important;"></textarea> 
										<span id="rchars1">500</span> Character(s) Remaining
										@endif										
									</div>
								</li>
															
								<input type="hidden" name="id" value="{{$edit[0]['id']}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<li>						
									<button {{$isComment}} type="submit" class="btn-Dark" name="submitsf" value="submitsf" id="">Submit </button>
								</li>
							</ul>							
						 </form>
						  @endif
						@endif
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
	endDate: "today",
	//startDate:'today',
	todayHighlight: true,
	orientation: 'bottom'
});
//  $('.timepicker').datetimepicker({
//     format: 'HH:mm:ss'
// }); 
$('.clockpicker').clockpicker({
	placement: 'bottom',
	align: 'left',
	autoclose: true
		// donetext: 'Done',
});
// manager 
$('.datetimepicker1r').datepicker({
	format: 'dd/mm/yyyy',
	autoclose: true,
	endDate: "today",
	startDate: 'today',
	orientation: 'bottom'
});
//time
//rm
$(function() {
	var d = new Date(),
		h = d.getHours(),
		m = d.getMinutes();
	if(h < 10) h = '0' + h;
	if(m < 10) m = '0' + m;
	$('input[type="time"][value="now"]').each(function() {
		$(this).attr({
			'value': h + ':' + m
		});
	});
});


$(document).ready(function() {	
	if($('#needinfo').val() == 'yes') {
		$('#inci_close').val('1');
		$('#inci_close').attr('disabled', true);		
		$('#shneed_inf').attr('required', true);
		$('#safety_comment').attr('required', false);
		// $('#extrainfo').show();
	} else {
		$('#inci_close').attr('disabled', false);
		$('#shneed_inf').attr('required', false);
		$('#safety_comment').attr('required', true);
		$('#shneed').hide();
	}
});

function Extra(e) {
	//console.log(e.target.value)
	if(e.target.value == 'yes') {
		$('#inci_close').val('1');
		$('#inci_close').attr('disabled', true);
		$('#shneed_inf').attr('required', true);
		$('#safety_comment').attr('required', false);
		$('#shneed').show();
		$('#sf_cmnt').hide();
		// $('#inci_close').prop('readonly', true);
	} else {
		$('#inci_close').attr('disabled', false);
		$('#shneed_inf').attr('required', false);
		$('#safety_comment').attr('required', true);
		$('#shneed').hide();
		$('#sf_cmnt').show();
	}
}
$('#needinfo').change(function(e) {
	var valueinfo = document.getElementById('needinfo').value;
	// var part2 = document.getElementById('satime').value;
	//console.log(valueinfo);
	if(valueinfo == 'yes') {
		$('#safety_comment').prop('required', false);
	} else {
		$('#safety_comment').prop('required', true);
	}
});

var maxLength = 500;
$('#shneed_inf').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  $('#rchars1').text(textlen);
});

</script> 
@endsection