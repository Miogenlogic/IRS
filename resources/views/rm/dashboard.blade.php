@extends('admin.include.layout')
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
                    <h1><span>Welcome {{ session('user')['employee_name'] }} ( {{$title}} ) !</span></h1>                   
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#incidentInfo" class="active">Incident Information</a></li>                        
                    </ul>

                     <div class="tab-content">
                        <!-- ============================ Start: Personal Information Tab ============================ -->
                        <div id="incidentInfo" class="tab-pane fade active show active">
                            <h4>Incident Information</h4>
                            <ul class="incident-information d-flex justify-content-between">
								 @php $Countall=App\Helpers\UserHelper::Countall(); @endphp                                            
                                <li>
                                    <div class="incidentNumberBlock"><span class="incidentNumber">{{ $Countall}}</span><a href="{{url('admin/admin-incitable')}}" class="incidentTxt">Total Incidents</a></div>
                                </li>
                                 @php $Pendingrm=App\Helpers\UserHelper::Pendingrm(); @endphp									
                                <li>
                                    <div class="incidentNumberBlock closedIncident"><span class="incidentNumber">{{ $Pendingrm}}</span><a href="{{url('admin/admin-pendrm')}}" class="incidentTxt">Pending Self Incidents</a></div>
                                </li>
                                 @php $Pendingsh=App\Helpers\UserHelper::Pendingsh(); @endphp
                                <li>
                                    <div class="incidentNumberBlock ongoingIncident"><span class="incidentNumber">{{$Pendingsh}}</span><a href="{{url('admin/admin-pendsf')}}" class="incidentTxt">Pending Incidents with Safety Champion</a></div>
                                </li>
								 @php $Close=App\Helpers\UserHelper::Close(); @endphp									
                                <li>
                                    <div class="incidentNumberBlock closedIncident"><span class="incidentNumber">{{ $Close}}</span><a href="{{url('admin/admin-closetable')}}" class="incidentTxt">Closed Incidents</a></div>
								</li>									
                            </ul>
                            <!-- ======= start: searc-hpanel ======= -->
                             <div class="searc-hpanel">
                                <form name="search" id="search" method="get" action="{{url('admin/admin-dashboard')}}">  
									@if($dateRange != '')
										<input autocomplete="off" name="searchdate" type="text" value= "{{$dateRange}}" id="searchdate1" class="form-control">
									@else
										<input autocomplete="off" name="searchdate" type="text" placeholder="Chose Your Start and End Date" id="searchdate1" class="form-control">
									@endif		
									<br>
									<input name="searchbutton" id="searchbutton" type="submit" value="Search" class="btn-Dark">
									<a href="{{url('admin/admin-dashboard')}}" class="btn-Dark"> Back</a>
                                </form>
                            </div> <br>
                           
                            <!-- ======= end: searc-hpanel ======= -->
                            <!-- ========= start table ========= -->
                            <div class="table-responsive">                                
                                <table id="tab_data" class="table table-striped">
                                    <thead>                                      
										<tr>
											<th>#</th>
											<th>Incident Date & Time</th>                                                    
											<th>Type</th> 
											<th>Location</th>
											<th>Injured Person Status</th>
                                            <th>Injured Person Name</th>
											<th>RM Name</th>
											<th>City</th>                                                   
											<th>Attachment</th>
											<th>Status</th>
											<th>Action</th>
										</tr>                                              
                                    </thead>
                                                                           
                                       @if(!empty($tabledata))  
                                                <tbody id="search_data">
                                                @foreach($tabledata as $table)
                                                <tr>
                                                <td>{{$table->in_id}}</td>
                                                <td>{{date('d/m/Y',strtotime($table->incident_date))}} {{$table->incident_time}}</td>
                                                <td>{{$table->actiontype}}</td>
                                                <td>{{$table->incident_location}}</td>
                                                <td>{{$table->status_name}}</td>												
                                                @php $personName = App\Helpers\UserHelper::GetNameFromEmail($table->emp_email); @endphp
                                                <td>{{$personName}}</td>
												@php $RMName = App\Helpers\UserHelper::GetRMName($table->manager_id); @endphp
                                                <td>{{$RMName}}</td>
                                                <td>{{$table->name}}</td>
												<td>
												  <?php 
												  $word = "base64";
												   if(empty($table->image)){
													  
												  }
												 else if(strpos($table->image, $word) !== false){ ?>
													<a href="{{$table->image}}" data-fancybox="fancybox1"><img src="{{$table->image}}" style="hight:50px;width:50px;"/ ></a>
												  <?php } else { ?>	
													<a href="{{asset('public/assets/uploads/logo').'/'.$table->image}}"  data-fancybox="fancybox1"><img src="{{asset('public/assets/uploads/logo').'/'.$table->image}}" style="hight:50px;width:50px;"/ > </a>      
												  <?php } ?>
												  </td>
												
												  @if($table->save_draft == 0)
                                                <td>Save As Draft</td>
                                                @else
												  <td>{{$table->status_e == 0 ? 'Close' :'Open'}}</td>
											   @endif	                                              
												<td><a href="{{ url('admin/rm-incident-edit').'/'.$table->in_id}}">Edit</a> | <a href="{{ url('admin/rm-incident-view').'/'.$table->in_id}}">View</a></td>                                          
                                               </tr>
                                                @endforeach
                                                </tbody>
                                                @endif   
                                </table>
                                <div id="nodata" style="text-align: center;margin-top: 30px;"><label> <strong >No Data Found</strong></label></div>
                            </div>
                            <!-- ========= end table ========= -->
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
    $(document).ready(function () {
    $('.tabs li a').click(function(e) {
        $('.tabs li.active').removeClass('active');
        var $parent = $(this).parent();
        $parent.addClass('active');
        e.preventDefault();
    });
});
    </script>  
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

$('#searchfilter').keypress(function(e) { 
    if(e.keyCode==13 && e.target.value!=""){
          var clickEvent = new MouseEvent("click", {
    "view": window,
    "bubbles": true,
    "cancelable": false
});
        var elem = document.getElementById("searchbutton");
        elem.dispatchEvent(clickEvent);
    }
    return e.keyCode != 13;
});
 $(document).ready(function() {
            $("#searchicon").hide();
                });
//search

    function searchDown(e){
        //page not loading
        // e.preventDefault();
        // e.stopPropagation();
        console.log(e);
        if(e.target.value == ""){
             $("#searchicon").hide();
            console.log('success1')
             $.ajax({
        url: '{{ url("/admin/admin-table") }}',
        type: 'GET',
        data: {'_token':'{{csrf_token()}}'},
    })

        .done(function(response) {
            $('#search_data').show();
            $('#nodata').hide();
            $('#search_data').html(response);
            console.log(response);
      })
         .fail(function() {
            console.log("error");
        })

        .always(function() {
            console.log("complete");
        });

    }else{
        $("#searchicon").show();
     //    if(e.key == "Enter"){
     // var elem = document.getElementById("searchbutton");
     //    if (typeof elem.onclick == "function") {
     //         elem.onclick.apply(elem);
     //        }
     //    }
    }        
    }

  function OnSearch(input,e){
    console.log(e);
     // e.preventDefault();
    console.log(input.value);
    if(input.value==""){
         $("#searchicon").hide();
     $.ajax({
        url: '{{ url("/admin/admin-table") }}',
        type: 'GET',
        data: {'_token':'{{csrf_token()}}'},
    })

        .done(function(response) {
            $('#search_data').show();
            $('#nodata').hide();
            $('#search_data').html(response);
            console.log(response);
      })
         .fail(function() {
            console.log("error");
        })

        .always(function() {
            console.log("complete");
        });

    }else{
        var clickEvent = new MouseEvent("click", {
    "view": window,
    "bubbles": true,
    "cancelable": false
});
        var elem = document.getElementById("searchbutton");
        elem.dispatchEvent(clickEvent);
        
    }
    }

$(document).ready(function() {
            $("#nodata").hide();
  });
$('#searchbutton').click(function(event) {
    var search = $('#searchfilter').val();
    //alert(model);
    console.log('hi');
     $.ajax({
        url: '{{ url("/admin/admin-search") }}',
        type: 'POST',
        data: {search:search,'_token':'{{csrf_token()}}'},
    })
        .done(function(response) {
          //  console.log(response);
          if(response.length==0){        
           //  $("#nodata").hide();
           //  document.getElementById('nodata').style.display = 'none';
           //  let output = '<div style="text-align: center;margin-top: 30px;">'+'<label> <strong >'+'No Data Found'+'</strong></label>'+'</div>';
            $('#nodata').show();
            $('#search_data').hide();
          }else{
            $('.search_data').show();
            $('#search_data').html(response);
          }    
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
    <a href="#" id="toTop" class="hover-bounce"></a>
    <!-- =================== end back to top =================== -->

    <!-- ================== bootstrap tooltip ================== -->
    <script>
    function dateDown(e){
        console.log(e.target.value);
        if(e.target.value == ""){
            console.log('success');
                $.ajax({
        url: '{{ url("/admin/admin-table") }}',
        type: 'GET',
        data: {'_token':'{{csrf_token()}}'},
    })

      .done(function(response) {
            $('#search_data').show();
            $('#nodata').hide();
            $('#search_data').html(response);
            console.log(response);
      })
         .fail(function() {
            console.log("error");
        })

        .always(function() {
            console.log("complete");
        });           
        }
 }
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });


    </script>

   <input type="text" class="form-control" name="datefilter" />
<script type="text/javascript">
    $(function() {
            $('input[name="searchdate"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
            }
        });

        $('input[name="searchdate"]').on('apply.daterangepicker', function(ev, picker) {

                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));


               //get data
               let startdate=picker.startDate.format('YYYY-MM-DD');
               let enddate=picker.endDate.format('YYYY-MM-DD');
                //console.log(startdate,enddate);
                // var todate= 
                $.ajax({

                  url: '{{ url("/admin/admin-todate") }}',

                 type: 'POST',

                 data: {startdate:startdate,enddate:enddate,'_token':'{{csrf_token()}}'},

                 })
                 .done(function(response) {


              if(response.length==0){
        
           //  $("#nodata").hide();
           //  document.getElementById('nodata').style.display = 'none';
           //  let output = '<div style="text-align: center;margin-top: 30px;">'+'<label> <strong >'+'No Data Found'+'</strong></label>'+'</div>';
            $('#nodata').show();
            $('#search_data').hide();
          }else{
            $('.search_data').show();
            $('#search_data').html(response);
          }

            // $('#nodata').hide();
            // $('#search_data').html(response);
            // $('#search_data').show();

            console.log(response);
      })
         .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });
                //end data


                });

        $('input[name="searchdate"]').on('cancel.daterangepicker', function(ev, picker) {
               $(this).val('');
               console.log(ev);
               //mycode
                $.ajax({

        url: '{{ url("/admin/admin-table") }}',

        type: 'GET',

        data: {'_token':'{{csrf_token()}}'},

    })

        .done(function(response) {


            $('#search_data').show();
            $('#nodata').hide();
            $('#search_data').html(response);

            console.log(response);
      })
         .fail(function() {

            console.log("error");

        })

        .always(function() {

            console.log("complete");

        });


               //endmycode
               


  });

});
</script>
    @endsection