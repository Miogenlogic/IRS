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
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
            <div class="card">
                <div class="card-body">
                    <h1><span>Employee List</span></h1>                    
                     <div class="tab-content">                      
                            <!-- ========= start table ========= -->
                            <!--<div class="table-responsive">-->
                            <div class="table-responsive sticky-scroll">                                
                                <!--<table id="tab_data" class="table table-striped">-->
                                <table class="table table-hover text-center" id="table1">
                                    <thead>                                      
											<tr>
												<th class="border-top-0">Emp No</th>													
												<th class="border-top-0">Name</th>
												<th class="border-top-0">Grade</th>
												<th class="border-top-0">Designation</th>
												<th class="border-top-0">SBU</th>
												<th class="border-top-0">B Func</th>													
												<th class="border-top-0">RPT Code</th>
												<th class="border-top-0">RPT to</th>
												<th class="border-top-0">Sap Ter</th>
												<th class="border-top-0">Territory</th>
												<th class="border-top-0">Loc Code</th>
												<th class="border-top-0">Location</th>
												<th class="border-top-0">Plant Code</th>
												<th class="border-top-0">Plant Name</th>													
												<th class="border-top-0">DOJ</th>
												<th class="border-top-0">DOR</th>
												<th class="border-top-0">Telephone No</th>
												<th class="border-top-0">Email</th>                                                  
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
                    url: '{{ url("admin/employee-getTable") }}',
                },
                columns: [
                    //{data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                    {data: 'emp_no', name: 'emp_no'},                    
                    {data: 'name', name: 'name'},
                    {data: 'grade', name: 'grade'},
                    {data: 'desg', name: 'desg'} ,
                    {data: 'sbu', name: 'sbu'} ,
                    {data: 'b_func', name: 'b_func'} ,                    
                    {data: 'rpt_code', name: 'rpt_code'} ,
                    {data: 'rpt_to', name: 'rpt_to'} ,
                    {data: 'sap_ter', name: 'sap_ter'} ,
                    {data: 'territory', name: 'territory'} ,
                    {data: 'loc_code', name: 'loc_code'} ,
                    {data: 'location', name: 'location'} ,
                    {data: 'plant', name: 'plant' orderable:false, searchable:false} ,
                    {data: 'plant_name', name: 'plant_name' orderable:false, searchable:false} ,                    
                    {data: 'doj', name: 'doj'} ,
                    {data: 'ret_res_dt', name: 'ret_res_dt' orderable:false, searchable:false} ,
                    {data: 'tphn_no1', name: 'tphn_no1'} ,
                    {data: 'email', name: 'email'} ,  
				],
                fixedHeader: true
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>
@endsection