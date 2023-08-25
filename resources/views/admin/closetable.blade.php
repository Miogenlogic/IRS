@extends($role == '1' ? 'admin.include.super_layout' : 'admin.include.layout')
@section('after_styles')

@endsection
@section('body') 
     
    <section class="repoting-form dashboard">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Incident Information Table</li>
            </ol>
            <div class="card">
                <div class="card-body">                   
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#incidentInfo" class="active">Incident Information Table</a></li>                     
                    </ul>

                     <div class="tab-content">
                        <!-- ============================ Start: Personal Information Tab ============================ -->
                        <div id="incidentInfo" class="tab-pane fade active show active">
                            <h4>Closed Incident Information Table</h4>
                           
                            <!-- ======= start: searc-hpanel ======= -->
                             <div class="searc-hpanel">
                                <form name="search" id="search" method="get" action="{{url('admin/admin-closetable')}}">  
									@if($dateRange != '')
										<input autocomplete="off" name="searchdate" type="text" value= "{{$dateRange}}" id="searchdate1" class="form-control">
									@else
										<input autocomplete="off" name="searchdate" type="text" placeholder="Chose Your Start and End Date" id="searchdate1" class="form-control">
									@endif		
									<br>
									<input name="searchbutton" id="searchbutton" type="submit" value="Search" class="btn-Dark">
									<a href="{{url('admin/admin-closetable')}}" class="btn-Dark"> Back</a>
                                </form>
                            </div> <br>
                           
                            <!-- ======= end: searc-hpanel ======= -->
                            <!-- ========= start table ========= -->
							
                            <div class="table-responsive">
                                <table class="table table-striped">
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
                                        
                                    @if(count($tabledata) > 0)  
                                            <tbody>
                                            @foreach($tabledata as $table)
                                            <tr>
                                            <td>{{$table->in_id}}</td>
                                            <td>{{date('d/m/Y',strtotime($table->incident_date))}} {{$table->incident_time}}</td>
                                            <td>{{$table->actiontype}}</td>
                                            <td>{{$table->incident_location}}</td>
                                            <td>{{$table->status_name}}</td>
                                            @php $personName = App\Helpers\UserHelper::GetNameFromEmail($table->emp_email);@endphp
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
                                                <a href="{{$table->image}}" data-fancybox="fancybox6"><img src="{{$table->image}}" style="hight:50px;width:50px;"/ ></a>
                                            <?php } else { ?>	
                                                <a href="{{asset('public/assets/uploads/logo').'/'.$table->image}}"  data-fancybox="fancybox6"><img src="{{asset('public/assets/uploads/logo').'/'.$table->image}}" style="hight:50px;width:50px;"/ > </a>      
                                            <?php } ?>
                                            </td>                                             
                                            <td>{{$table->status_e == 0 ? 'Close' :'Open'}}</td>  
											<td><a href="{{ url('admin/admin-view').'/'.$table->in_id}}">View</a></td>
                                            </tr>
                                            @endforeach
											<tr><td colspan= "11" align="center">{{ $tabledata->onEachSide(2)->links() }}</td></tr>
                                            </tbody>
                                            @else 
												<tbody>
												<tr>
												<td colspan='11' align ="center">No data found</td>
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
        </div>
    </section>


         @endsection
        @section('after_scripts')

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

    </script>
    <a href="#" id="toTop" class="hover-bounce"></a>
    <!-- =================== end back to top =================== -->

    <!-- ================== bootstrap tooltip ================== -->
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
    @endsection