@extends('admin.include.super_layout')
@section('after_styles')
<link href="{{asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{asset('public/assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
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
                    <h1><span>{{$title}}</span> || <span><a href="{{url('admin/add-schamp')}}">Add Location/Broad Function Wise Safety Champion</a></span> </h1>                    
                     <div class="tab-content">                      
                            <!-- ========= start table ========= -->
							<div class="searc-hpanel">
                                <form name="search" id="search" method="get" action="{{url('admin/admin-dashboard')}}">
								<div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-label" style="vertical-align: top">Select Location</label>&nbsp;<span style="color:red; vertical-align: top">*</span>
											@php $locations = App\Helpers\UserHelper::getLocation(); @endphp 
                                            <select class="form-control" id="schamp_loc_code" name="schamp_loc_code">
                                                <option>Please Select</option>
                                                <option value="all">All</option>
                                                @foreach($locations as $ldata)
                                                    <option value="{{$ldata->loc_code}}">{{$ldata->location}}</option>
                                                @endforeach                                                     
                                            </select>                                           
                                        </div>
                                    </div>
                                </div>
								<br>
									<input name="searchbutton" id="searchbutton" type="submit" value="Search" class="btn-Dark">
									<a href="{{url('admin/admin-dashboard')}}" class="btn-Dark"> Back</a>
								</form>
							</div>	
							<br>
                            <!--<div class="table-responsive">-->
                            <div class="table-responsive sticky-scroll"> 							
                                <!--<table id="tab_data" class="table table-striped">-->
                                <table class="table table-hover text-center" id="table1">
                                    <thead>                                      
											<tr>
												<th class="border-top-0" style="font-size:12px;!important">Employee Name</th>
												<!--<th class="border-top-0" style="font-size:12px;!important">Safety Champion1 ID</th>-->
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion1 Name</th>
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion1 Email</th>
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion1 Mobile</th>
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion1 Location</th>
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion1 BFunction</th>
												<!--<th class="border-top-0" style="font-size:12px;!important">Safety Champion2 ID</th>-->											
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion2 Name</th>
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion2 Email</th>
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion2 Mobile</th>
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion2 Location</th>
												<th class="border-top-0" style="font-size:12px;!important">Safety Champion2 BFunction</th>
												<!--<th class="border-top-0" style="font-size:12px;!important">Action</th>->
											</tr>                                              
                                    </thead> 
                                </table>
                                <!--<div id="nodata" style="text-align: center;margin-top: 30px;"><label> <strong >No Data Found</strong></label></div>-->
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
                    url: '{{ url("admin/saftychamp-gettable") }}',
                },
                columns: [
                    //{data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
					{data: 'emp_name', name: 'emp_name'},
                    //{data: 'schamp_id1', name: 'schamp_id1'},                    
                    {data: 'schamp_name1', name: 'schamp_name1'},
                    {data: 'schamp_email1', name: 'schamp_email1'},
                    {data: 'schamp_mobile1', name: 'schamp_mobile1'},
                    {data: 'location1', name: 'location1'},
                    {data: 'bfunc1', name: 'bfunc1'},  
					//{data: 'schamp_id2', name: 'schamp_id2'},                    
                    {data: 'schamp_name2', name: 'schamp_name2'},
                    {data: 'schamp_email2', name: 'schamp_email2'},
                    {data: 'schamp_mobile2', name: 'schamp_mobile2'},
                    {data: 'location2', name: 'location2'},
                    {data: 'bfunc2', name: 'bfunc2'}, 
					//{data: 'action', name: 'action'},
				],
                fixedHeader: true
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>
@endsection