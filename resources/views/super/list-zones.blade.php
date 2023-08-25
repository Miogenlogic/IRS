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
                    <h1><span>{{$title}}</span>  || <span><a href="{{url('admin/zones-upload')}}" class="incidentTxt">Upload Zone Data</a></span></h1>                   
                     <div class="tab-content">                      
                            <!-- ========= start table ========= -->
                            <!--<div class="table-responsive">-->
                            <div class="table-responsive sticky-scroll">                                
                                <!--<table id="tab_data" class="table table-striped">-->
                                <table class="table table-hover text-center" id="table1">
                                    <thead>                                      
											<tr>
												<th class="border-top-0">Plnt</th>													
												<th class="border-top-0">Name 1</th>
												<th class="border-top-0">Street</th>
												<th class="border-top-0">Street 2</th>
												<th class="border-top-0">Street 3</th>
												<th class="border-top-0">Street 4</th>													
												<th class="border-top-0">City</th>
												<th class="border-top-0">District</th>
												<th class="border-top-0">Postal Code</th>
												<th class="border-top-0">Description</th>
												<th class="border-top-0">CCd</th>												                                             
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
                    url: '{{ url("admin/zones-getZonesTable") }}',
                },
                columns: [
                    //{data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                    {data: 'Plnt', name: 'Plnt'},                    
                    {data: 'Name1', name: 'Name1'},
                    {data: 'Street', name: 'Street'},
                    {data: 'Street2', name: 'Street2'},
                    {data: 'Street3', name: 'Street3'},
                    {data: 'Street4', name: 'Street4'},                    
                    {data: 'City', name: 'City'},
                    {data: 'District', name: 'District'},
                    {data: 'PostalCode', name: 'PostalCode'},
                    {data: 'Description', name: 'Description'},
                    {data: 'CCd', name: 'CCd'},                    
				],
                fixedHeader: true
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>
@endsection