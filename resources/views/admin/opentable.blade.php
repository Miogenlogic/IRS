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
                            <h4>Incident Information Table</h4>
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
                                                @php
                                                $personName = App\Helpers\UserHelper::GetNameFromEmail($table->emp_email);
                                                @endphp
                                                <td>{{$personName}}</td>
                                                <td>{{$table->name}}</td>                  
                                                <td>
                                                <?php 
                                                $word = "base64";
                                                if(empty($table->image)){
                                                    
                                                }
                                                else if(strpos($table->image, $word) !== false){ ?>
                                                    <a href="{{$table->image}}" data-fancybox="fancybox4"><img src="{{$table->image}}" style="hight:50px;width:50px;"/ ></a>
                                                <?php } else { ?>	
                                                    <a href="{{asset('public/assets/uploads/logo').'/'.$table->image}}"  data-fancybox="fancybox4"><img src="{{asset('public/assets/uploads/logo').'/'.$table->image}}" style="hight:50px;width:50px;"/ > </a>      
                                                <?php } ?>
                                                </td>                                               
                                                <td>{{$table->status_e == 0 ? 'Close' :'Open'}}</td>
                                                <td><a href="{{ url('admin/admin-incident-edit').'/'.$table->in_id}}">Edit</a></td>                                            
                                                </tr>
                                                @endforeach
                                                </tbody>
                                                @else 
                                                <tbody>
                                                <tr>
                                                <td colspan='9' align ="center">No data found</td>
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