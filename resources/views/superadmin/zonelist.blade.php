@extends('admin.include.super_layout')
@section('after_styles')
<!-- <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}"> -->
<link href="{{asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('public/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
@endsection

@section('body') 
       <section class="repoting-form dashboard">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Incident List</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <h1><span>Welcome Super Admin!</span></h1>
                    <ul class="nav nav-tabs">
                        <li><a data-toggle="tab" href="#incidentInfo" class="active">Report</a></li>                       
                    </ul>

                     <div class="tab-content">
                        <!-- ============================ Start: Personal Information Tab ============================ -->
                        <div id="incidentInfo" class="tab-pane fade active show active">
                            <h4>{{$title}}</h4>
                            <!-- ========= start table ========= -->
                            <div class="table-responsive sticky-scroll">                                 
                                <!--<table id="tab_data" class="table table-striped">-->
                                <table class="table table-hover text-center" id="table1">
                                    <thead>                                      
                                                <tr>
                                                    <!--<th>Id</th>-->                                             
                                                    <th>Employee Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>                                                   
                                                    <th>Type of Incident</th>
                                                    <th>Exact Location of Incident</th>
                                                    <th>Brief Description of Incident</th>
                                                    <th>Status of Injured Person</th>
                                                    <th>Image</th>
                                                    <th>State</th>
                                                    <th>District</th>
                                                    <th>City</th>
                                                    <th>Date of Action(RM)</th>
                                                    <th>Time of Action(RM)</th>
                                                    <th>Corrective Action(RM)</th>                                                    
                                                    <th>Date of Action(SH)</th>
                                                    <th>Time of Action(SH)</th>
                                                    <th>Corrective Action(SH)</th>                                                    
                                                    <th>Status</th>
                                                </tr>                                              
                                    </thead>   
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
	<script src="{{asset('public/assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js" type="text/javascript"></script>
	
	 <script>
        $(document).ready(function(){
            $('#table1').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/super-incigetTable") }}',
                },
                columns: [
                    //{data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                    {data: 'employee_name', name: 'employee_name'},                    
                    {data: 'incident_date', name: 'incident_date'},
                    {data: 'incident_time', name: 'incident_time'},
                    {data: 'actiontype', name: 'actiontype'} ,
                    {data: 'incident_location', name: 'incident_location'} ,
                    {data: 'incident_description', name: 'incident_description'} ,                    
                    {data: 'status_name', name: 'status_name'} ,
                    {data: 'image', name: 'image'} ,
                    {data: 'staname', name: 'staname'} ,
                    {data: 'disname', name: 'disname'} ,
                    {data: 'cityname', name: 'cityname'} ,
                    {data: 'rm_date', name: 'rm_date'} ,
                    {data: 'rm_time', name: 'rm_time'} ,
                    {data: 'rm_comment', name: 'rm_comment'} ,                    
                    {data: 'safety_date', name: 'safety_date'} ,
                    {data: 'safety_time', name: 'safety_time'} ,
                    {data: 'safety_comment', name: 'safety_comment'} ,
                    {data: 'status_e', name: 'status_e'} ,  
				],
                fixedHeader: true
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>
        
 @endsection