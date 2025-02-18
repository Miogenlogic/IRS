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
                    <h1><span>{{$title}}</span></h1>                    
                     <div class="tab-content">     
                            <form action="{{url('admin/edit-repDays-save')}}" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-label">Employee Escalation Timeline</label>
                                            <input name="emp_days" class="form-control" id="emp_days" type="text" placeholder="No of Days" value="{{old('emp_days')?:$repDays->emp_days}}">
                                            @if($errors->has('emp_days'))
                                                <div class="alert alert-danger mt-2" style="display:block;">{{$errors->first('emp_days')}}</div>
                                            @endif
                                        </div>
										<div class="form-group">
                                            <label for="" class="form-label">Reporting Manager Escalation Timeline</label>
                                            <input name="rm_days" class="form-control" id="rm_days" type="text" placeholder="No of Days" value="{{old('rm_days')?:$repDays->rm_days}}">
                                            @if($errors->has('rm_days'))
                                                <div class="alert alert-danger mt-2" style="display:block;">{{$errors->first('rm_days')}}</div>
                                            @endif
                                        </div>
										<div class="form-group">
                                            <label for="" class="form-label">Safety Head Escalation Timeline</label>
                                            <input name="sh_days" class="form-control" id="sh_days" type="text" placeholder="No of Days" value="{{old('sh_days')?:$repDays->sh_days}}">
                                            @if($errors->has('sh_days'))
                                                <div class="alert alert-danger mt-2" style="display:block;">{{$errors->first('sh_days')}}</div>
                                            @endif
                                        </div>
										<div class="form-group">
                                            <label for="" class="form-label">MD Desk Email</label>
                                            <input name="md_desk_email" class="form-control" id="md_desk_email" type="text" placeholder="MD Desk Email" value="{{old('md_desk_email')?:$repDays->md_desk_email}}">
                                            @if($errors->has('md_desk_email'))
                                                <div class="alert alert-danger mt-2" style="display:block;">{{$errors->first('md_desk_email')}}</div>
                                            @endif
                                        </div>
										<div class="form-group">
                                            <label for="" class="form-label">Default Safety Champion ID <span>*<span></label>
                                            <input name="def_schamp_id" class="form-control" id="def_schamp_id" type="text" placeholder="Default Safety Champion ID" value="{{old('def_schamp_id')?:$repDays->def_schamp_id}}" required>
                                            @if($errors->has('def_schamp_id'))
                                                <div class="alert alert-danger mt-2" style="display:block;">{{$errors->first('def_schamp_id')}}</div>
                                            @endif
                                        </div>
										<!--<div class="form-group">
                                            <label for="" class="form-label">Safety Head ID(s) <span>*<span></label>
                                            <input name="safety_id" class="form-control" id="safety_id" type="text" placeholder="Safety Head ID(s)" value="{{old('safety_id')?:$repDays->safety_id}}" required>
                                            @if($errors->has('safety_id'))
                                                <div class="alert alert-danger mt-2" style="display:block;">{{$errors->first('safety_id')}}</div>
                                            @endif
                                        </div>-->
										<div class="form-group">
                                            <label for="" class="form-label">Admin CC Email</label>
                                            <input name="admin_cc_email" class="form-control" id="admin_cc_email" type="text" placeholder="Admin CC Email" value="{{old('admin_cc_email')?:$repDays->admin_cc_email}}">
                                            @if($errors->has('admin_cc_email'))
                                                <div class="alert alert-danger mt-2" style="display:block;">{{$errors->first('admin_cc_email')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-md-12 text-centers">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="reset" class="btn btn-danger" onclick='location.href ="{{url('admin/edit-backDate')}}"'>Cancel</button>
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