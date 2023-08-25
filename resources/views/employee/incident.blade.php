@extends('admin.include.layout')
@section('after_styles')

@endsection

@section('body')

<section class="repoting-form">
        <div class="container">
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Incident Reporting</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li><a href="{{url('admin/employee-personalform')}}">Personal Information</a></li>
                        <li><a href="{{url('admin/employee-myhealth')}}">Health &amp; emergency Information</a></li>
                        <li><a data-toggle="tab" href="{{url('admin/employee-incident')}}" class="active">Report Incident</a></li>
                    </ul>
  
                    <div class="tab-content">
                         <div id="incidentInfo" class="tab-pane fade active show active ">
                            <h4>Incident Reporting</h4>						
                            <form method="post" id="inci_report" action="{{url('admin/employee-incidentrep')}}" enctype="multipart/form-data">
                                <ul class="reporting-form incidentInfo">
                                    <li>
                                        <div class="form-group">
                                            <label for="">Employee Name </label>
                                            <input name="empName" type="text" class="form-control" value="{{$tabledata['name']}}" readonly>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Date of Incident </label><span style="color:red">*</span>
                                            <input autocomplete="off" name="Date"  type="text" class="form-control datetimepicker" id="store1"required>
                                        </div>
                                    </li>
                                    <li>

                                        <div class="form-group clockpicker">
                                            <label for="">Time of Incident </label><span style="color:red">*</span>
                                            <input autocomplete="off" id="time" name="Time" type="text" class="form-control timepicker" autocomplete="off"required>
                                        </div>
                                    </li>
                                    <li>
                                         @php $incident=App\Helpers\UserHelper::Incident_type(); @endphp
                                        <div class="form-group">
                                            <label for="">Type of Incident </label><span style="color:red">*</span>
                                          <select class="form-control"  name="Type"required >
                                                    <option></option>
                                                    @foreach($incident as $inci)
                                                    <option value="{{$inci->id}}" >{{$inci->incident_t}}</option>                                                    
                                                     @endforeach
                                                </select>
                                        </div>
                                    </li>
									<li>
                                        @php $status_type=App\Helpers\UserHelper::Status_type(); @endphp 
                                        <div class="form-group">
                                            <label for="">Status of Injured Person </label><span style="color:red">*</span>
                                                <select class="form-control" name="Status"required>
                                                    <option></option>
                                                @foreach($status_type as $sta)
                                                    <option value="{{$sta->id}}">{{$sta->status_name}}</option>
                                                @endforeach                                                     
                                                </select>
                                        </div>
                                    </li>                                    
                                    <li class="textarea">
                                        <div class="form-group">
                                            <label for="">Brief Description of Incident</label><span style="color:red">*</span>
                                            <textarea name="Description" type="text" class="form-control" style="height: 70px !important;" maxlength="500" required></textarea>
											<span id="rchars">500</span> Character(s) Remaining
                                        </div>
                                    </li> 
									<li>
                                        <div class="form-group">
                                            <label for="">Exact Location of Incident </label><span style="color:red">*</span>
                                            <input name="Location" type="text" class="form-control"required>
                                        </div>
                                    </li>	
                                    <li>
                                        <div class="form-group">
                                            <label for="">Click Image1 </label>
                                            <input type="file" name="Image" class="form-control date-picker-doj" data-datepicker-color="primary">
										</div>
                                    </li>
									<li>
                                        <div class="form-group">
                                            <label for="">Click Image2 </label>
                                            <input type="file" name="Image2" class="form-control date-picker-doj" data-datepicker-color="primary">                                          
                                        </div>
                                    </li>
									<li>
                                        <div class="form-group">
                                            <label for="">Click Image3 </label>
                                            <input type="file" name="Image3" class="form-control date-picker-doj" data-datepicker-color="primary">                                          
                                        </div>
                                    </li>
                                    <li>
                                        @php $state=App\Helpers\UserHelper::State(); @endphp 
                                        <div class="form-group">
                                            <label class="state1" for="">State </label><span style="color:red">*</span>
                                                <select class="form-control" id="state1" name="State" required>
                                                 <option> </option>
                                                 @foreach($state as $sta)                                             
                                                    <option value="{{$sta->id}}">{{$sta->name}}</option>
                                                @endforeach                                    
                                                </select>
                                        </div>
                                    </li>
                                    <li>                                       
                                        <div class="form-group">
                                            <label class="dis1" for="">District </label><span style="color:red">*</span>
                                              <select class="form-control" id="dis1" name="District"required>
                                                <option> </option>                                
                                                </select>
                                        </div>
                                    </li>
                                    <li>                                     

                                        <div class="form-group">
                                            <label class="city1" for="">City </label><span style="color:red">*</span>
                                            <select class="form-control" id="city1" name="City"required>                                                   
                                            </select>
                                        </div>
                                    </li>

                                    <input type="hidden" name="_token" value="{{csrf_token()}}">   
                                    <li>
                                        <button type="submit" name="submit" value="submit" class="btn-Dark" id="">Submit</button>
                                        <button type="submit" name="save" value="save" class="btn-Dark" id="">Save as Draft</button>                                       
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
		//startDate: '-{{$datePicker->date_range}}d',
        startDate: '-{{$datePicker->days}}d',
        endDate: "today",
        showOtherMonths: true,
        // selectOtherMonths: true,
       // startDate:'today',
      //minDate: '-30',
       // maxDate: '0' ,
       // minDate:'-3M' ,
        //maxDate: new Date(),
        todayHighlight:true,
        orientation: 'bottom',
     }); 
 
    $('.clockpicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
		default: 'now',		
    // donetext: 'Done',
    });
	
	var timeOptions = {
        'timeFormat': 'h:i A',
		'minTime': getCurrentTime(new Date())
    };
	$('#time').timepicker(timeOptions);

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
<script type="text/javascript">    //ajax
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

$('#inci_report').submit(function() {
    var c = confirm("Are you sure you want to submit?");
	//alert(c);
	//return false;
	//if(c == true){
		//$('#inci_report')[0].reset();
	return c; //you can just return c because it will be true or false
	//}     
});
</script>
@endsection


