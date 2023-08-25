@extends('admin.include.super_layout')
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
                    <h1><span>Incident Status Type</span></h1>                    
                     <div class="tab-content">     
                            <form action="{{url('admin/add-incistat-save')}}" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-label">{{$title}}</label>
                                            <input name="status_name" class="form-control" id="days" type="text" placeholder="{{$title}}" value="{{$incistatus}}">                                           
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-md-12 text-centers">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="statid" value="{{$incistatID}}">
                                    <button type="reset" class="btn btn-danger" onclick='location.href ="{{url('admin/incistat-list')}}"'>Cancel</button>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
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
                    {data: 'plant', name: 'plant'} ,
                    {data: 'plant_name', name: 'plant_name'} ,                    
                    {data: 'doj', name: 'doj'} ,
                    {data: 'ret_res_dt', name: 'ret_res_dt'} ,
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