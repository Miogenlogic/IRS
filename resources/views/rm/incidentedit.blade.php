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
		  
										if(strpos($edit->image, $word) !== false){ ?> <img src="{{$edit[0]['image']}}" style="hight:50px;width:50px;" />
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
											<input type="file" name="Image3" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit[0]['image3']}}" {{$read}}> @if($edit[0]['image3']!='')
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
							</ul>
						</form>
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>
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
												<td> {{date('d/m/Y',strtotime($rmedt['rm_date']))}} </td>
												<td>{{$rmedt['rm_time']}}</td>
												<td>{{$rmedt['rm_comment']}}</td>
											</tr> 
										@endforeach 
										</tbody> 
									@endif		
								@endif		
						</table>
						<br/>
						<div style="margin-top: 20px;">
							<label><strong class="bold" style="font-size: 19px;padding: 5px 20px;border: 1px solid #e6e5e5;color: coral;">Safety Champion comments table</strong></label>
						</div>						
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Date</th>
										<th>Time</th>
										<th>Comment</th>
									</tr>
								</thead>
								<?php //dd($sh_main_cmnt);?>
								@if(!empty($shedit))
									<tbody> 
									@foreach($shedit as $shedt)
										<tr>
											<td> {{date('d/m/Y',strtotime($shedt['sf_date']))}} </td>
											<td>{{$shedt['sf_time']}}</td>
											<td>{{$shedt['sf_comment']}}</td>
										</tr> 
									@endforeach 
								@endif 	
									@if($edit[0]['extra_info'] == 'yes')
									<tr>
										<td> {{date('d/m/Y',strtotime($sh_main_cmnt[0]['safety_date']))}} </td>
										<td>{{$sh_main_cmnt[0]['safety_time']}}</td>
										<td>{{$sh_main_cmnt[0]['need_informationsh']}}</td>
									</tr> 
									@endif	
									</tbody> 
								
							</table>
							
						<br/>
						<div style="width: 100%;height: 2px;background: #e6e5e5;"></div>
						<!-- ============================ Start: Reporting Mannager ============================ -->
						@if ($flag != 'view')
						@if($role == '3')
						<form method="post" action="{{url('admin/rm-rmcomment')}}" enctype="multipart/form-data">
							<div style="margin-top: 20px;">
								<label> <strong class="bold" style="font-size: 19px;padding: 5px 20px;border: 1px solid #e6e5e5;color: coral;">Reporting Manager</strong></label>
							</div>
							@if($role == '3')
							<ul style="margin-top: 0;">
								<li>
									<div class="form-group">
										<label for="">Date of Action </label><span style="color:red">*</span>
										<input name="managerdate" type="text" id="date12" class="form-control datetimepicker1r" value="{{$todayDate}}" autocomplete="off" required readonly> </div>
								</li>
								<li>
									<div class="form-group">
										<label for="">Time of Action </label><span style="color:red">*</span>
										<input name="managertime" type="time" class="form-control " id="reporttime" value="now" {{$reado}} autocomplete="off" required style="font-size: 3em;" readonly> 
									</div>
								</li> 
								@if($edit->extra_info == 'yes')
								<li class="textarea">
									<label>Safety Head needs extra information for this incident..</label>
									<div class="form-group">										
										<label for="">SH needs information </label>
										<textarea name="shneedsinfo" type="text" class="form-control " {{$reado}} style="height: 60px !important;">{{$edit->need_informationsh}}</textarea>										
									</div>
								</li> @endif
								<li class="textarea">
									<div class="form-group">
										<label for="">Corrective Action </label><span style="color:red">(*Mandatory when Submit)</span>
										<textarea id="managercomment" name="managercomment" type="text" class="form-control timepicker1" maxlength="500" style="height: 60px !important;"></textarea>
										<span id="rchars">500</span> Character(s) Remaining
									</div>
								</li>
								
								<li class="textarea">
									<div class="form-group">
										<label for="">Rejection Comment </label><span style="color:red">(*Mandatory when Reject)</span>
										<textarea id ="rm_rej_cmnt" name="rm_rej_cmnt" type="text" class="form-control timepicker1" maxlength="500" style="height: 60px !important;"></textarea>
										<!--<span id="rj_chars">500</span> Character(s) Remaining-->
									</div>
								</li>
								
								<input type="hidden" name="id" value="{{$edit[0]['id']}}">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<li> 
									@if($has_comment== NULL)
										<button type="submit" name="submit1" value="submit1" class="btn-Dark" id="submit1" onclick="return success();">Submit</button>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" name="reject1" value="reject1" class="btn-Dark" id="reject1" onclick="return reject();">Reject</button>										
									@elseif($sh_main_cmnt[0]['extra_info']!=NULL)
										<button type="submit" name="submit2" value="submit2" class="btn-Dark" id="submit2" onclick="return success();">Submit</button>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									    <button type="submit" name="reject2" value="reject2" class="btn-Dark" id="reject2" onclick="return reject();">>Reject</button>										
									@elseif($rm_cmnt_close!=NULL)
										<button type="submit" name="submit2" value="submit2" class="btn-Dark" id="submit2" onclick="return success();">Submit</button>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" name="reject2" value="reject2" class="btn-Dark" id="reject2" onclick="return reject();">>Reject</button>
									@endif
								
								</li>								
							</ul>
							@endif
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


function reject(){
	var rej_cmnt = $('#rm_rej_cmnt').val();	
	if(rej_cmnt == ''){
		alert('Please enter rejection comment');
		$("#rm_rej_cmnt").focus();
		return false;
	}
}

function success(){
	var apv_cmnt = $('#managercomment').val();
	if(apv_cmnt == ''){
		alert('Please enter corrective comment');
		$("#managercomment").focus();
		return false;
	}
}

/*var maxLength = 500;
$('#rm_rej_cmnt').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  $('#rj_chars').text(textlen);
});*/

</script>
@endsection