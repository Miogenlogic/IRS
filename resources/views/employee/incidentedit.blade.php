@extends('admin.include.layout') 
@section('after_styles')
@endsection
@section('body')  

@if ($role == '2') 
@php $read = " ";@endphp 
@else 
@php $read = "disabled";@endphp 
@endif 
@if ($flag == 'view')
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
						<form method="post" id="inci_report" action="{{url('admin/employee-incident-editstore')}}" enctype="multipart/form-data">
							<ul class="reporting-form incidentInfo">
								<li>
									<div class="form-group">
										<label for="">Employee Name </label> <?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<input name="empName" type="text" class="form-control" value="{{$edit[0]['name']}}" readonly> </div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Date of Incident </label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<input name="Date" id="date1234" type="text" class="form-control datetimepicker" value="{{date('d/m/Y',strtotime($edit[0]['incident_date']))}}" {{$read}} autocomplete="off" required> </div>
								</li>
								<li>
									<div class="form-group clockpicker">
										<label for="">Time of Incident </label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<input name="Time" id="time" type="text" class="form-control" value="{{$edit[0]['incident_time']}}" {{$read}} autocomplete="off" required> </div>
								</li>
								<li> @php $incident=App\Helpers\UserHelper::Incident_type(); @endphp
									<div class="form-group">
										<label for="">Type of Incident </label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<select class="form-control" name="Type" {{$read}} required> @foreach($incident as $inci)
											<option value="{{$inci->id}}" {{ $edit[0]['inc_type'] == $inci->id ? 'selected' : ''}} >{{$inci->incident_t}}</option> @endforeach </select>
									</div>
								</li>
								<li> @php $status_type=App\Helpers\UserHelper::Status_type(); @endphp
									<div class="form-group">
										<label for="">Status of Injured Person </label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<select class="form-control" name="Status" {{$read}} required> @foreach($status_type as $sta)
											<option value="{{$sta->id}}" {{ $edit[0]['injured_status'] == $sta->id ? 'selected' : ''}} >{{$sta->status_name}}</option> @endforeach </select>
									</div>
								</li>								
								<li class="textarea">
									<div class="form-group">
										<label for="">Brief Description of Incident</label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<textarea name="Description" type="text" class="form-control" {{$read}} style="height: 70px !important;" maxlength="500">{{$edit[0]['incident_description']}}</textarea>
										<span id="rchars">500</span> Character(s) Remaining
									</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Exact Location of Incident </label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<input name="Location" type="text" class="form-control" value="{{$edit[0]['incident_location']}}" {{$read}} required> </div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Click Image1 </label>
										<div style="position: relative;">
											<input type="file" name="Image" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit[0]['image']}}" {{$read}}> @if($edit[0]['image']!='')
											<?php 
											$word = "base64";		  
											if(strpos($edit->image, $word) !== false){ ?> <img src="{{$edit[0]['image']}}" style="hight:50px;width:50px;" />
												<?php } else { ?> <a href="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image']}}" data-fancybox="fancybox1"><img src="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image']}}" style="hight:50px;width:50px;"/ > </a>
													<?php } ?>
														<!-- <a href="{{asset('public/assets/uploads/logo').'/'.$edit->image}}" style="position: absolute; top: 50%;right: 15px;transform: translateY(-50%);">{{$edit->image}}</a>-->
										</div> @endif 
									</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Click Image2 </label>
										<div style="position: relative;">
											<input type="file" name="Image2" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit[0]['image2']}}" {{$read}}> @if($edit[0]['image2']!='')
											<?php 
											$word = "base64";		  
											if(strpos($edit->image2, $word) !== false){ ?> <img src="{{$edit[0]['image2']}}" style="hight:50px;width:50px;" />
												<?php } else { ?> <a href="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image2']}}" data-fancybox="fancybox1"><img src="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image2']}}" style="hight:50px;width:50px;"/ > </a>
													<?php } ?>
														<!-- <a href="{{asset('public/assets/uploads/logo').'/'.$edit->image}}" style="position: absolute; top: 50%;right: 15px;transform: translateY(-50%);">{{$edit->image}}</a>-->
										</div> @endif 
									</div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Click Image3 </label>
										<div style="position: relative;">
											<input type="file" name="Image3" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit[0]['image3']}}" {{$read}}> @if($edit[0]['image3']!='')
											<?php 
											$word = "base64";		  
											if(strpos($edit->image3, $word) !== false){ ?> <img src="{{$edit[0]['image3']}}" style="hight:50px;width:50px;" />
												<?php } else { ?> <a href="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image3']}}" data-fancybox="fancybox1"><img src="{{asset('public/assets/uploads/logo').'/'.$edit[0]['image3']}}" style="hight:50px;width:50px;"/ > </a>
													<?php } ?>
														<!-- <a href="{{asset('public/assets/uploads/logo').'/'.$edit->image}}" style="position: absolute; top: 50%;right: 15px;transform: translateY(-50%);">{{$edit->image}}</a>-->
										</div> @endif 
									</div>
								</li>
								<li> @php $state=App\Helpers\UserHelper::State(); @endphp
									<div class="form-group">
										<label class="state1" for="">State </label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<select class="form-control" id="state1" name="State" {{$read}} required> @foreach($state as $sta)
											<option value="{{$sta->id}}" {{$edit[0]['state']== $sta->id ? 'selected' : ''}}>{{$sta->name}}</option> @endforeach </select>
									</div>
								</li>
								<li> @php $district=App\Helpers\UserHelper::District($edit[0]['state']); @endphp
									<div class="form-group">
										<label class="dis1" for="">District </label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<select class="form-control" id="dis1" name="District" {{$read}} required> @foreach($district as $dis)
											<option value="{{$dis->id}}" {{$edit[0]['district'] == $dis->id ? 'selected' : ''}} >{{$dis->name}}</option> @endforeach </select>
									</div>
								</li>
								<li> @php $city=App\Helpers\UserHelper::City($edit[0]['state']); @endphp
									<div class="form-group">
										<label class="city1" for="">City </label><?php if($flag != 'view'){?><span style="color:red">*</span> <?php }?>
										<select class="form-control" id="city1" name="City" {{$read}} required> @foreach($city as $ci)
											<option value="{{$ci->id}}" {{$edit[0]['city'] == $ci->id ? 'selected' : ''}}>{{$ci->name}}</option> @endforeach </select>
									</div>
								</li>
								<input type="hidden" name="id" value="{{$edit[0]['id']}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<li>
									@if($flag != 'View')										
										@if($edit[0]['save_draft'] == '1')											
											<button type="submit" name="submit" value="submit" class="btn-Dark" id="" hidden>Submit</button>
											@if(($edit[0]['manager_reject'] == 'Y') && ($flag != 'view'))
												<input type="hidden" name="manager_reject" value="N">
												<button type="submit" name="submit" value="submit" class="btn-Dark" id="">Submit</button>
											@endif	
										@else											
											<?php if($mode != 'View'){ ?>
											<button type="submit" name="submit" value="submit" class="btn-Dark" id="">Submit</button>	
											<button type="submit" name="save" value="save" class="btn-Dark" id="">Save as Draft</button>	
											<?php } ?>											
										@endif
									@endif
							</ul>
						</form>
						
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>						
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>												
						<p><strong >Reporting Manager comments table</strong></p>
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
												<td> {{date('d/m/Y',strtotime($rmedt['rm_date']))}} </td>
												<td>{{$rmedt['rm_time']}}</td>
												<td>{{$rmedt['rm_comment']}}</td>
											</tr> 
										@endforeach 
									</tbody> 
									@endif 		
								@endif	
						</table>
						
						<p><strong >Safety Champion comments table</strong></p>
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
											<td> {{date('d/m/Y',strtotime($shedt['comment_date']))}} </td>
											<td>{{$shedt['comment_time']}}</td>
											<td>{{$shedt['comment_name']}}</td>
										</tr> 
									@endforeach 
								@endif	
									@if($edit[0]['extra_info'] == 'yes')
										<tr>
											<td> {{date('d/m/Y',strtotime($edit[0]['safety_date']))}} </td>
											<td>{{$edit[0]['safety_time']}}</td>
											<td>{{$edit[0]['need_informationsh']}}</td>
										</tr> 
									@endif
									</tbody> 
							</table>
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
	startDate: '-{{$datePicker->days}}d',
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

$('#inci_report').submit(function() {
    var c = confirm("Are you sure you want to submit?");
    return c; //you can just return c because it will be true or false
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