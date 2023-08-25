@extends('admin.include.layout') 
@section('after_styles')
@endsection
 @section('body')  
<?php //echo $role;?>
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
										<label for="">Employee Name </label><span style="color:red">*</span>
										<input name="empName" type="text" class="form-control" value="{{$edit[0]['name']}}" readonly> </div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Date of Incident </label><span style="color:red">*</span>
										<input name="Date" id="date1234" type="text" class="form-control datetimepicker" value="{{date('d/m/Y',strtotime($edit[0]['incident_date']))}}" {{$read}} autocomplete="off" required> </div>
								</li>
								<li>
									<div class="form-group clockpicker">
										<label for="">Time of Incident </label><span style="color:red">*</span>
										<input name="Time" id="time" type="text" class="form-control" value="{{$edit[0]['incident_time']}}" {{$read}} autocomplete="off" required> </div>
								</li>
								<li> @php $incident=App\Helpers\UserHelper::Incident_type(); @endphp
									<div class="form-group">
										<label for="">Type of Incident </label><span style="color:red">*</span>
										<select class="form-control" name="Type" {{$read}} required> @foreach($incident as $inci)
											<option value="{{$inci->id}}" {{ $edit->inc_type == $inci->id ? 'selected' : ''}} >{{$inci->incident_t}}</option> @endforeach </select>
									</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Exact Location of Incident </label><span style="color:red">*</span>
										<input name="Location" type="text" class="form-control" value="{{$edit[0]['incident_location']}}" {{$read}} required> </div>
								</li>
								<li class="textarea">
									<div class="form-group">
										<label for="">Brief Description of Incident</label><span style="color:red">*</span>
										<textarea name="Description" type="text" class="form-control" {{$read}} style="height: 70px !important;" required>{{$edit[0]['incident_description']}}</textarea>
									</div>
								</li>
								<li> @php $status_type=App\Helpers\UserHelper::Status_type(); @endphp
									<div class="form-group">
										<label for="">Status of Injured Person </label><span style="color:red">*</span>
										<select class="form-control" name="Status" {{$read}} required> @foreach($status_type as $sta)
											<option value="{{$sta->id}}" {{ $edit[0]['injured_status'] == $sta->id ? 'selected' : ''}} >{{$sta->status_name}}</option> @endforeach </select>
									</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Click Image </label><span style="color:red">*</span>
										<div style="position: relative;">
											<input type="file" name="Image" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit[0]['image']}}" {{$read}}> @if($edit[0]['image']!='')
											<?php 
										$word = "base64";
		  
										if(strpos($edit->image, $word) !== false){ ?> <img src="{{$edit[0]['image']}}" style="hight:50px;width:50px;" />
												<?php } else { ?> <a href="{{asset('public/assets/uploads/logo').'/'.$edit->image}}"><img src="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image']}}" style="hight:50px;width:50px;"/ > </a>
													<?php } ?>
														<!-- <a href="{{asset('public/assets/uploads/logo').'/'.$edit->image}}" style="position: absolute; top: 50%;right: 15px;transform: translateY(-50%);">{{$edit->image}}</a>--></div> @endif </div>
								</li>
								<li> @php $state=App\Helpers\UserHelper::State(); @endphp
									<div class="form-group">
										<label class="state1" for="">State </label><span style="color:red">*</span>
										<select class="form-control" id="state1" name="State" {{$read}} required> @foreach($state as $sta)
											<option value="{{$sta->id}}" {{$edit[0]['state']== $sta->id ? 'selected' : ''}}>{{$sta->name}}</option> @endforeach </select>
									</div>
								</li>
								<li> @php $district=App\Helpers\UserHelper::District($edit[0]['state']); @endphp
									<div class="form-group">
										<label class="dis1" for="">District </label><span style="color:red">*</span>
										<select class="form-control" id="dis1" name="District" {{$read}} required> @foreach($district as $dis)
											<option value="{{$dis->id}}" {{$edit[0]['district'] == $dis->id ? 'selected' : ''}} >{{$dis->name}}</option> @endforeach </select>
									</div>
								</li>
								<li> @php $city=App\Helpers\UserHelper::City($edit[0]['state']); @endphp
									<div class="form-group">
										<label class="city1" for="">City </label><span style="color:red">*</span>
										<select class="form-control" id="city1" name="City" {{$read}} required> @foreach($city as $ci)
											<option value="{{$ci->id}}" {{$edit[0]['city'] == $ci->id ? 'selected' : ''}}>{{$ci->name}}</option> @endforeach </select>
									</div>
								</li>
								<input type="hidden" name="id" value="{{$edit['id']}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<li>
									<!-- if manager comment in incidet then this button will be disabled{{$edit->save_draft}}
									@if(!empty($edit->action_comment) && $role == '6')
									<button type="submit" name="submit" value="submit" class="btn-Dark" id="" disabled hidden>Submit</button> 
									@elseif($role == '2' ||$role == '3' ||$role == '4' || $role == '5')
									<button type="submit" name="submit" value="submit" class="btn-Dark" id="" disabled hidden>Submit</button> 
									@elseif($edit->save_draft == '0')
									<button type="submit" name="submit" value="submit" class="btn-Dark" id="" {{$read}} disabled hidden>Submit</button> 
									@elseif($edit->status_e == '0')
									<button type="submit" name="submit" value="submit" class="btn-Dark" id="" {{$read}} disabled hidden>Submit</button> @else
									<button type="submit" name="submit" value="submit" class="btn-Dark" id="">Submit</button>
									<button type="submit" name="save" value="save" class="btn-Dark" id="">Save as Draft</button> @endif </li> -->
									@if($role == '2')
									<button type="submit" name="submit" value="submit" class="btn-Dark" id="">Submit</button>									
									@if($edit->save_draft == '0')
									<button type="submit" name="save" value="save" class="btn-Dark" id="">Save as Draft</button>
									@endif
									@endif
							</ul>
						</form>
						
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>
						<!-- ============================ Start: Reporting Mannager ============================ -->
						@if($role == '3')
						<form method="post" action="{{url('admin/rm-rmcomment')}}" enctype="multipart/form-data">
							<div style="margin-top: 20px;">
								<label> <strong class="bold" style="font-size: 19px;padding: 5px 20px;border: 1px solid #e6e5e5;color: coral;">Reporting Manager </strong></label>
							</div>
							@if($role == '3')
							<ul style="margin-top: 0;">
								<li>
									<div class="form-group">
										<label for="">Date of Action </label><span style="color:red">*</span>
										<input name="managerdate" type="text" id="date12" class="form-control datetimepicker1r" value="{{$todayDate}}" autocomplete="off" required readonly> </div>
								</li>
								<li>
									<div class="form-group ">
										<label for="">Time of Action </label><span style="color:red">*</span>
										<input name="managertime" type="time" class="form-control " id="reporttime" value="now" {{$reado}} autocomplete="off" required style="font-size: 3em;" readonly> </div>
								</li> @if($edit->extra_info == 'yes')
								<li class="textarea">
									<label>SH/AH needs extra information for this incident..</label>
									<div class="form-group">
										@if(isset($edit->need_informationsh))
										<label for="">SH needs information </label>
										<textarea name="shneedsinfo" type="text" class="form-control " {{$reado}} style="height: 60px !important;">{{$edit->need_informationsh}}</textarea>
										@else
										<label for="">AH needs information </label>
										<textarea name="ahneedsinfo1" type="text" class="form-control " {{$readonly}} style="height: 60px !important;">{{$edit->need_informationah}}</textarea>
										@endif
									</div>
								</li> @endif
								<li class="textarea">
									<div class="form-group">
										<label for="">Corrective Action </label><span style="color:red">*</span>
										<textarea name="managercomment" type="text" class="form-control timepicker1"  required style="height: 60px !important;"></textarea>
									</div>
								</li>
								<input type="hidden" name="id" value="{{$edit[0]['id']}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<li> 
									@if($has_comment== NULL)
										<button type="submit" name="submit1" value="submit1" class="btn-Dark" id="">Submit</button>
									@elseif($sh_main_cmnt[0]['extra_info']!=NULL)
										<button type="submit" name="submit2" value="submit2" class="btn-Dark" id="">Submit</button>
									@elseif($rm_cmnt_close!=NULL)
										<button type="submit" name="submit2" value="submit2" class="btn-Dark" id="">Submit</button>
									@endif
								
								</li>
							</ul>
							@endif
							<!--<table class="table table-striped">
								<thead>
									<tr>
										<th>Date</th>
										<th>Time</th>
										<th>Comment</th>
									</tr>
								</thead> @if(!empty($rmedit))
								<tbody> @foreach($rmedit as $rmedt)
									<tr>
										<td> {{date('d/m/Y',strtotime($rmedt['rm_date']))}} </td>
										<td>{{$rmedt['rm_time']}}</td>
										<td>{{$rmedt['rm_comment']}}</td>
									</tr> @endforeach </tbody> @endif 
							</table>-->
							
						</form> @endif
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>					
						<p><strong >Reporting Manager comments table</strong></p>
						<table class="table table-striped">
								<thead>
									<tr>
										<th>Date</th>
										<th>Time</th>
										<th>Comment</th>
									</tr>
								</thead> @if(!empty($rmedit))
								<tbody> @foreach($rmedit as $rmedt)
									<tr>
										<td> {{date('d/m/Y',strtotime($rmedt['rm_date']))}} </td>
										<td>{{$rmedt['rm_time']}}</td>
										<td>{{$rmedt['rm_comment']}}</td>
									</tr> @endforeach </tbody> @endif 
						</table>
						
						<p><strong >Safety Head comments table</strong></p>
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
											<td> {{date('d/m/Y',strtotime($shedt['sf_date']))}} </td>
											<td>{{$shedt['sf_time']}}</td>
											<td>{{$shedt['sf_comment']}}</td>
										</tr> 
									@endforeach 
									<tr>
										<td> {{date('d/m/Y',strtotime($sh_main_cmnt[0]['safety_date']))}} </td>
										<td>{{$sh_main_cmnt[0]['safety_time']}}</td>
										<td>{{$sh_main_cmnt[0]['need_informationsh']}}</td>
									</tr> 									
									</tbody> 
								@endif 
							</table>
						</div>
						</div>
						</div>
					</div>
</section> @endsection @section('after_scripts')
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
	 
//time
//za
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

//time
//sa
$(function() {
	var d = new Date(),
		h = d.getHours(),
		m = d.getMinutes();
	if(h < 10) h = '0' + h;
	if(m < 10) m = '0' + m;
	/*$('#satime').each(function() {
		$(this).attr({
			'value': h + ':' + m
		});
	});*/
});

//time
//ah
$(function() {
	var d = new Date(),
		h = d.getHours(),
		m = d.getMinutes();
	if(h < 10) h = '0' + h;
	if(m < 10) m = '0' + m;
	/*$('#ahtime').each(function() {
		$(this).attr({
			'value': h + ':' + m
		});
	});*/
});
   
//rm
$('#date12').change(function(e) {
	var part1 = document.getElementById('date1234').value.split("/");
	var part2 = document.getElementById('date12').value.split("/");
	var d1 = new Date(part1[2], part1[1] - 1, part1[0]);
	var d2 = new Date(part2[2], part2[1] - 1, part2[0]);
	if(document.getElementById('date12').value.length == 10) {
		if(d2 >= d1) {
			// console.log('hi');
		} else {
			document.getElementById('date12').value = '';
			alert('Please enter  date > incident date');
		}
	}
});
//za
$('#date12za').change(function(e) {
	var part1 = document.getElementById('date1234').value.split("/");
	var part2 = document.getElementById('date12za').value.split("/");
	var d1 = new Date(part1[2], part1[1] - 1, part1[0]);
	var d2 = new Date(part2[2], part2[1] - 1, part2[0]);
	if(document.getElementById('date12za').value.length == 10) {
		if(d2 >= d1) {
			// console.log('hi');
		} else {
			document.getElementById('date12za').value = '';
			alert('Please enter  date > incident date');
		}
	}
});
//sa
$('#date12sahead').change(function(e) {
	var part1 = document.getElementById('date1234').value.split("/");
	var part2 = document.getElementById('date12sahead').value.split("/");
	var d1 = new Date(part1[2], part1[1] - 1, part1[0]);
	var d2 = new Date(part2[2], part2[1] - 1, part2[0]);
	if(document.getElementById('date12sahead').value.length == 10) {
		if(d2 >= d1) {
			//console.log('hi');
		} else {
			document.getElementById('date12sahead').value = '';
			alert('Please enter  date > incident date');
		}
	}
});
$('#date12adminhead').change(function(e) {
	var part1 = document.getElementById('date1234').value.split("/");
	var part2 = document.getElementById('date12adminhead').value.split("/");
	var d1 = new Date(part1[2], part1[1] - 1, part1[0]);
	var d2 = new Date(part2[2], part2[1] - 1, part2[0]);
	if(document.getElementById('date12adminhead').value.length == 10) {
		if(d2 >= d1) {
			// console.log('hi');
		} else {
			document.getElementById('date12adminhead').value = '';
			alert('Please enter  date > incident date');
		}
	}
});
</script>
<script type="text/javascript">
//ajax
$('#state1').change(function(event) {
	var model = $(this).val();
	//alert(model);
	//  console.log(model);
	$.ajax({
		url: '{{ url("/admin/admin-statecity") }}',
		type: 'POST',
		data: {
			model: model,
			'_token': '{{csrf_token()}}'
		},
	}).done(function(response) {
		//  console.log(response);
		$('.city1').show();
		$('#city1').html(response);
		//mctype= jQuery.parseJSON(response);
		console.log("success");
	}).fail(function() {
		console.log("error");
	}).always(function() {
		console.log("complete");
	});
});
</script>
<script type="text/javascript">
//ajax
$('#state1').change(function(event) {
	var model = $(this).val();
	//alert(model);
	// console.log(model);
	$.ajax({
		url: '{{ url("/admin/admin-statedis") }}',
		type: 'POST',
		data: {
			model: model,
			'_token': '{{csrf_token()}}'
		},
	}).done(function(response) {
		//  console.log(response);
		$('.dis1').show();
		$('#dis1').html(response);
		//mctype= jQuery.parseJSON(response);
		console.log("success");
	}).fail(function() {
		console.log("error");
	}).always(function() {
		console.log("complete");
	});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	if($('#needinfo1').val() == 'yes') {
		$('#inci_close1').attr('disabled', true);
		$('#ahneed_inf').attr('required', true);
		$('#admin_comment').attr('required', false);
		// $('#extrainfo').show();
	} else {
		$('#inci_close1').attr('disabled', false);
		$('#ahneed_inf').attr('required', false);
		$('#admin_comment').attr('required', true);
		$('#ahneed').hide();
	}
	if($('#needinfo').val() == 'yes') {
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
		$('#inci_close').attr('disabled', true);
		$('#shneed_inf').attr('required', true);
		$('#safety_comment').attr('required', false);
		$('#shneed').show();
		// $('#inci_close').prop('readonly', true);
	} else {
		$('#inci_close').attr('disabled', false);
		$('#shneed_inf').attr('required', false);
		$('#safety_comment').attr('required', true);
		$('#shneed').hide();
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

function ExtraAh(e) {
	//  console.log(e.target.value)
	if(e.target.value == 'yes') {
		$('#inci_close1').attr('disabled', true);
		$('#ahneed_inf').attr('required', true);
		$('#admin_comment').attr('required', false);
		$('#ahneed').show();
		// $('#inci_close').prop('readonly', true);
	} else {
		$('#inci_close1').attr('disabled', false);
		$('#ahneed_inf').attr('required', false);
		$('#admin_comment').attr('required', true);
		$('#ahneed').hide();
	}
}
$('#needinfo1').change(function(e) {
	var valueinfo = document.getElementById('needinfo1').value;
	// var part2 = document.getElementById('satime').value;
	//console.log(valueinfo);
	if(valueinfo == 'yes') {
		$('#admin_comment').prop('required', false);
		
	} else {
		$('#admin_comment').prop('required', true);
	}
});
// $('#needinfo1').change(function(e) {
//    var valueinfo = document.getElementById('needinfo1').value;
//   // hide all optional elements
//   if(valueinfo == 'yes')
// {
//   $('#extrainfo').show();
// }else{
//    $('#extrainfo').hide();
// }
//   });
</script> @endsection