@extends('admin.include.layout')
@section('after_styles')
<!-- <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}"> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/> -->

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
                        <li><a href="{{url('admin/admin-reportform')}}">Personal Information</a></li>
                        <li><a href="{{url('admin/admin-myhealth')}}">Health &amp; emergency Information</a></li>
                        <li><a data-toggle="tab" href="{{url('admin/admin-incident')}}" class="active">Incident</a></li>
                    </ul>
  
                    <div class="tab-content">
                         <div id="incidentInfo" class="tab-pane fade active show active ">
                            <h4>Incident Reporting</h4>
						
                                   <form method="post" action="{{url('admin/admin-incident-store')}}" enctype="multipart/form-data">
                                <ul class="reporting-form incidentInfo">
                                    <li>
                                        <div class="form-group">
                                            <label for="">Employee Name </label>
                                            <input name="empName" type="text" class="form-control" value="{{$Employee_name}}" readonly>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-group" >
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
                                         @php
                                         $incident=App\Helpers\UserHelper::Incident_type();
                            
                                          @endphp
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
                                        <div class="form-group">
                                            <label for="">Exact Location of Incident </label><span style="color:red">*</span>
                                            <input name="Location" type="text" class="form-control"required>
                                        </div>
                                    </li>
                                    <li class="textarea">
                                        <div class="form-group">
                                            <label for="">Brief Description of Incident</label><span style="color:red">*</span>
                                            <textarea name="Description" type="text" class="form-control" style="height: 70px !important;"required></textarea>
                                        </div>
                                    </li>
                                    <li>
                                        @php
                                         $status_type=App\Helpers\UserHelper::Status_type();
                            
                                          @endphp 

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
                                    <li>
                                        <div class="form-group">
                                            <label for="">Click Image </label><span style="color:red">*</span>
                                            <input type="file" name="Image" class="form-control date-picker-doj" data-datepicker-color="primary" required >
                                            
                                        </div>
                                    </li>
                                    <li>
                                        @php
                                         $state=App\Helpers\UserHelper::State();
                            
                                          @endphp 
                                        <div class="form-group">
                                            <label class="state1" for="">State </label><span style="color:red">*</span>
                                                                         
                                                                           
                                                <select class="form-control" id="state1" name="State" required>
                                                <option></option>
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
                                                <option></option>
                                               
                                                                                                 
                                                </select>
                                        </div>
                                    </li>
                                    <li>
                                      

                                        <div class="form-group">
                                            <label class="city1" for="">City </label><span style="color:red">*</span>
                                            <select class="form-control" id="city1" name="City"required >
                                               
                                                    <!-- <option  >Delhi </option>
                                                    <option >Bangalore </option>
                                                                                                 -->
                                                </select>
                                        </div>
                                    </li>

                                    <input type="hidden" name="_token" value="{{csrf_token()}}">   
                                    <li>
                                        <button type="submit" name="submit" value="submit" class="btn-Dark" id="" >Submit</button>
                               <button type="submit" name="save" value="save"class="btn-Dark" id="" >Save as Draft</button>
                                       
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
		startDate: '-{{$datePicker->date_range}}d',
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
//     $('.datetimepicker').click(function(){
//         console.log('hit')
//     var popup =$(this).offset();
//     var popupTop = popup.top - 40;
//     $('.ui-datepicker').css({
//       'top' : popupTop
//      });
// });
    //  $('.timepicker').datetimepicker({

    //     format: 'HH:mm:ss'

    // });  
    $('.clockpicker').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true
    // donetext: 'Done',
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
<!-- <script>
    $(document).ready(function(){
        var date_input=$('input[name="Date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script> -->
    
    @endsection
<!-- </script> -->

