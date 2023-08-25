@extends('admin.include.layout')
@section('after_styles')
<!-- <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}"> -->
@endsection


@section('body')
 
        <!--     <div class="container">
                <nav aria-label="breadcrumb" class="breadcrumb-nw">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin-dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div> -->
            <section class="repoting-form dashboard">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <h1><span>Welcome John!</span></h1>
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#incidentInfo" class="active">Incident Information</a></li>
                        <li><a href="{{url('admin-reportform')}}">Personal Information</a></li>
                    </ul>

                     <div class="tab-content">
                        <!-- ============================ Start: Personal Information Tab ============================ -->
                        <div id="incidentInfo" class="tab-pane fade active show active">
                            <h4>Incident Information</h4>
                            <p>welcome</p>
                           <!--  <ul class="incident-information d-flex justify-content-between">
                                @php
                                            $Count=App\Helpers\UserHelper::Count();

                                            @endphp
                                            
                                <li>
                                    <div class="incidentNumberBlock"><span class="incidentNumber">{{ $Count}}</span><a href="{{url('/admin-incident')}}" class="incidentTxt">Total Incidents</a></div>
                                </li>
                                 @php
                                            $Close=App\Helpers\UserHelper::Close();

                                            @endphp
                                <li>
                                    <div class="incidentNumberBlock closedIncident"><span class="incidentNumber">{{ $Close}}</span><a href="{{url('/admin-incident')}}" class="incidentTxt">Closed Incidents</a></div>
                                </li>
                                 @php
                                            $Open=App\Helpers\UserHelper::Open();

                                            @endphp
                                <li>
                                    <div class="incidentNumberBlock ongoingIncident"><span class="incidentNumber">{{$Open}}</span><a href="{{url('/admin-incident')}}" class="incidentTxt">Ongoing Incidents </a></div>
                                </li>
                            </ul> -->
                            <!-- ======= start: searc-hpanel ======= -->
                         <!--    <div class="searc-hpanel">
                                <form action="">
                                    <input type="search" ng-model="searchfilter" id="searchfilter" placeholder="Search for an Incident" class="form-control">
                                    <button type="button"><i class="fa fa-search"></i></button>
                                </form>
                            </div> -->
                            <!-- ======= end: searc-hpanel ======= -->
                            <!-- ========= start table ========= -->
                         <!--    <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                      
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date & Time</th>
                                                    
                                                     <th>Type</th> 
                                                    <th>Location</th>
                                                    <th>Injured Person Status</th>
                                                    <th>City</th>
                                                    <th>Brief Description</th>
                                                    <th>Attachment</th>
                                                    <th>Action</th>
                                                </tr>
                                              
                                    </thead>
                                   
                                        
                                       @if(!empty($tabledata))  
                                                <tbody>
                                                @foreach($tabledata as $table)
                                                    <tr>

                                                <td>{{$table->in_id}}</td>
                                                <td>{{date('d/m/Y',strtotime($table->incident_date))}} {{$table->incident_time}}</td>
                                                <td>{{$table->actiontype}}</td>
                                                <td>{{$table->incident_location}}</td>
                                                <td>{{$table->status_name}}</td>
                                                <td>{{$table->name}}</td>
                                                <td>{{$table->incident_description}}</td>
                                                
                                                <td><a href="{{asset('public/assets/uploads/logo').'/'.$table->image}}">{{$table->image}}</a>       </td>
                                               
                                               
                                               
                                               <td><a href="{{ url('admin-incident-edit').'/'.$table->in_id}}">Edit</a></td>
                                               </tr>
                                                @endforeach
                                                </tbody>
                                                @endif
                                       
                                    
                                </table>
                            </div> -->
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