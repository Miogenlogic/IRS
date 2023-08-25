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
                    <!--<h1><span>Welcome {{ session('user')['employee_name'] }}!</span></h1>-->
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#incidentInfo" class="active">{{$title}}</a></li>
                    </ul>

                     <div class="tab-content">
                        <!-- ============================ Start: Personal Information Tab ============================ -->
                        <div id="incidentInfo" class="tab-pane fade active show active">
                            <h4>{{$title}}</h4>                           
                            <!-- ======= start: searc-hpanel ======= -->
                            <!--  <div class="searc-hpanel">
                                <form action="">
                                    <input type="search" ng-model="searchfilter" id="searchfilter" placeholder="Search for an Incident" class="form-control">
                                    <button type="button"><i class="fa fa-search"></i></button>
                                </form>
                            </div> -->
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
                                                @php $personName = App\Helpers\UserHelper::GetNameFromEmail($table->emp_email); @endphp
                                                <td>{{$personName}}</td> 
												@php $RMName = App\Helpers\UserHelper::GetRMName($table->manager_id); @endphp
												<td>{{$RMName}}</td>
                                                <td>{{$table->name}}</td>                                                        
                                                <td>
                                                    <?php 
                                                    $word = "base64";
                                                    if(empty($table->image)){
                                                        
                                                    }elseif(strpos($table->image, $word) !== false){ ?>
                                                        <a href="{{$table->image}}" data-fancybox="fancybox5"><img src="{{$table->image}}" style="hight:50px;width:50px;"/ ></a>
                                                    <?php } else { ?>	
                                                        <a href="{{asset('public/assets/uploads/logo').'/'.$table->image}}"  data-fancybox="fancybox5"><img src="{{asset('public/assets/uploads/logo').'/'.$table->image}}" style="hight:50px;width:50px;"/ > </a>      
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