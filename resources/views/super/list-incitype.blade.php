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
                    <h1><span>{{$title}}</span> || <span><a href="{{url('admin/add-incitype')}}">Add Incident Type</a></span></h1>                   
                     <div class="tab-content">
                            <!-- ========= start table ========= -->
                            <!--<div class="table-responsive">-->
                            <div class="table-responsive sticky-scroll">   
                                <!--<table id="tab_data" class="table table-striped">-->
                                <table class="table table-hover text-center" id="table1">
                                    <thead>                                      
											<tr>
												<th class="border-top-0">ID</th>													
												<th class="border-top-0">Incident Type</th>
												<th class="border-top-0">Auto Close Status</th>		
												<th class="border-top-0">Status</th>		
												<th class="border-top-0">Action</th>													
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
                    url: '{{ url("admin/incitype-getInciTypeTable") }}',
                },
                columns: [
                    //{data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                    {data: 'id', name: 'id'},                    
                    {data: 'incident_t', name: 'incident_t'},
					{data: 'auto_close', name: 'auto_close'},	
					{data: 'status', name: 'status'},	
                    {data: 'action', name: 'incident_t'},                                       
				],
                fixedHeader: true
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>
@endsection