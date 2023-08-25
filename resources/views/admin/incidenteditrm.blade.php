@extends('admin.include.layout')
@section('after_styles')
<!-- <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}"> -->
@endsection


@section('body')

@if ($role == '3')
@php $readonly="";@endphp
@else
@php $readonly="disabled";@endphp
@endif
@if ($edit['action_comment'] != '' && $edit['zonal_comment'] != '')
@php $isComment="";@endphp
@else
@php $isComment="disabled";@endphp
@endif


<section class="repoting-form">
        <div class="container">
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Incident Reporting</li>
            </ol>
            <div class="card">
                <div class="card-body">
                  <!--  <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#peronalInfo" class="active">Personal Information</a></li>
                        <li><a data-toggle="tab" href="#emergencyInfo">Health &amp; emergenct Information</a></li>
                        <li><a data-toggle="tab" href="#incidentInfo">Incident</a></li>
                    </ul> -->
  
                    <div class="tab-content">
                         <div id="incidentInfo" class="tab-pane fade active show">
                            <h4>Incident Reporting</h4>
                            
                                   <form method="post" action="{{url('admin/admin-incident-editstore')}}" enctype="multipart/form-data">
                                <ul class="reporting-form incidentInfo">
                                    <li>
                                        <div class="form-group">
                                            <label for="">Employee Name </label><span style="color:red">*</span>
                                            <input name="empName" type="text" class="form-control" value="{{$edit['employee_name']}}"  required>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Date of Incident </label><span style="color:red">*</span>
                                           <input name="Date" type="text"  class="form-control datetimepicker" value="{{date('d/m/Y',strtotime($edit->incident_date))}}"  autocomplete="off" required>
                                        </div>
                                    </li>
                                    <li>

                                        <div class="form-group clockpicker">
                                            <label for="">Time of Incident </label><span style="color:red">*</span>
                                              <input  name="Time" type="text" class="form-control" value="{{$edit['incident_time']}}"  autocomplete="off" required>
                                        </div>
                                    </li>
                                    <li>
                                         @php
                                         $incident=App\Helpers\UserHelper::Incident_type();
                            
                                          @endphp
                                        <div class="form-group">
                                            <label for="">Type of Incident </label><span style="color:red">*</span>
                                           <select class="form-control" name="Type"  required>
                                                   
                                                    @foreach($incident as $inci)
                                                    <option  value="{{$inci->id}}" {{ $edit->inc_type == $inci->id ? 'selected' : ''}} >{{$inci->incident_t}}</option>

                                                   @endforeach
                                                   
                                                </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Exact Location of Incident </label><span style="color:red">*</span>
                                             <input name="Location" type="text" class="form-control" value="{{$edit['incident_location']}}"  required>
                                        </div>
                                    </li>
                                    <li class="textarea">
                                        <div class="form-group">
                                            <label for="">Brief Description of Incident</label><span style="color:red">*</span>
                                             <textarea name="Description" type="text" class="form-control"  style="height: 70px !important;"required>{{$edit['incident_description']}}</textarea> 
                                        </div>
                                    </li>
                                    <li>
                                        @php
                                         $status_type=App\Helpers\UserHelper::Status_type();
                            
                                          @endphp 

                                        <div class="form-group">
                                            <label for="">Status of Injured Person </label><span style="color:red">*</span>
                                                 <select class="form-control" name="Status"  required>
                                                        @foreach($status_type as $sta)
                                                        <option value="{{$sta->id}}" {{ $edit->injured_status == $sta->id ? 'selected' : ''}}
                                                            >{{$sta->status_name}}</option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Click Image </label><span style="color:red">*</span>
                                            <div style="position: relative;">
                                                <input type="file" name="Image" class="form-control date-picker-doj" data-datepicker-color="primary" value="{{$edit['image']}}">

                                                    @if($edit['image']!='')
													 <?php 
										$word = "base64";
		  
										if(strpos($edit->image, $word) !== false){ ?>
										<img src="{{$edit->image}}" style="hight:50px;width:50px;"/ >
										<?php } else { ?>	
										<a href="{{asset('public/assets/uploads/logo').'/'.$edit->image}}"><img src="{{asset('public/assets/uploads/logo').'/'.$edit->image}}" style="hight:50px;width:50px;"/ > </a>      
										<?php } ?>
                                                  <!--  <a href="{{asset('public/assets/uploads/logo').'/'.$edit->image}}" style="position: absolute; top: 50%;right: 15px;transform: translateY(-50%);">{{$edit->image}}</a>-->

                                            </div>
                                                    @endif
                                        </div>
                                    </li>
                                    <li>
                                        @php
                                         $state=App\Helpers\UserHelper::State();
                            
                                          @endphp 
                                        <div class="form-group">
                                            <label class="state1" for="">State </label><span style="color:red">*</span>
                                                                         
                                              <select class="form-control" id="state1" name="State"  required>
                                                        @foreach($state as $sta)
                                                        <option value="{{$sta->id}}" {{$edit-> state== $sta->id ? 'selected' : ''}}>{{$sta->name}}</option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                    </li>
                                    <li>
                                        @php
                                         $district=App\Helpers\UserHelper::District($edit->state);
                            
                                          @endphp 
                                        <div class="form-group">
                                            <label class="dis1" for="">District </label><span style="color:red">*</span>
                                           
                             
                                              <select class="form-control" name="District" id="dis1" required>
                                                        @foreach($district as $dis)
                                                        <option value="{{$dis->id}}" {{$edit->district == $dis->id ? 'selected' : ''}} >{{$dis->name}}</option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                    </li>
                                    <li>
                                      
									 @php
                                         $city=App\Helpers\UserHelper::City($edit->state);
                            
                                          @endphp 

                                        <div class="form-group">
                                            <label class="city1" for="">City </label><span style="color:red">*</span>
                                             <select class="form-control" id="city1" name="City"  required>
                                                         @foreach($city as $ci)

                                                        <option value="{{$ci->id}}" {{$edit->city == $ci->id ? 'selected' : ''}}>{{$ci->name}}</option>
                                                        @endforeach
 

                                                    </select>
                                        </div>
                                    </li>

                                <input type="hidden" name="id" value="{{$edit['id']}}">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <li>
    <!-- if manager comment in incidet then this button will be disabled -->
                                     @if(!empty($edit->action_comment))

                                    <button type="submit" name="submit" value="submit"  class="btn-Dark" id="" disabled hidden>Submit</button>

                                   
                                    @elseif($edit->save_draft == '1')
                                     <button type="submit" name="submit" value="submit"  class="btn-Dark" id="" disabled hidden >Submit</button>
                                    @elseif($edit->status_e == '0')
									  <button type="submit" name="submit" value="submit"  class="btn-Dark" id="" disabled hidden >Submit</button>
                                    @else
                                    <button type="submit" name="submit" value="submit" class="btn-Dark" id="" >Submit</button>
                                    <button type="submit" name="save" value="save" class="btn-Dark" id="" >Save as Draft</button>
                                    @endif
                                       
                                    </li>
                                </ul>
                            </form>
                           
 
                        </div>
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
         todayHighlight:true,
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
       //startDate:'today',
         orientation: 'bottom'

     }); 
	
   
</script>
<script type="text/javascript">
    //ajax
$('#state1').change(function(event) {
    var model = $(this).val();
    //alert(model);
    console.log(model);

    $.ajax({

        url: '{{ url("/admin/admin-statecity") }}',

        type: 'POST',

        data: {model:model,'_token':'{{csrf_token()}}'},

    })

        .done(function(response) {
          //  console.log(response);



            $('.city1').show();

            $('#city1').html(response);




            //mctype= jQuery.parseJSON(response);

            console.log("success");

        })

        .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });



});
</script>
  <script type="text/javascript">
    //ajax
$('#state1').change(function(event) {
    var model = $(this).val();
    //alert(model);
    console.log(model);

    $.ajax({

        url: '{{ url("/admin/admin-statedis") }}',

        type: 'POST',

        data: {model:model,'_token':'{{csrf_token()}}'},

    })

        .done(function(response) {
          //  console.log(response);



            $('.dis1').show();

            $('#dis1').html(response);




            //mctype= jQuery.parseJSON(response);

            console.log("success");

        })

        .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });



});
</script>
    

 @endsection