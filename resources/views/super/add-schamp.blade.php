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
                    <h1><span>{{$title}}</span></h1>                    
                     <div class="tab-content">     
                            <form action="{{url('admin/add-schamp-save')}}" method="post">	
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-label" style="vertical-align: top">Select Location</label>&nbsp;<span style="color:red; vertical-align: top">*</span>
											@php $locations = App\Helpers\UserHelper::getLocation(); @endphp 
                                            <select class="form-control-multi" id="schamp_loc_code" name="schamp_loc_code[]" size="10" multiple>
                                                <option value=" ">Please Select</option>
                                                <option value="all">All</option>
                                                @foreach($locations as $ldata)
                                                    <option value="{{$ldata->loc_code}}">{{$ldata->location}}</option>
                                                @endforeach                                                     
                                            </select>                                           
                                        </div>
                                    </div>
                                </div>
								
								<div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-label" style="vertical-align: top">Select Broad Function</label>
											@php $sbf = App\Helpers\UserHelper::getBF(); @endphp 
                                            <select class="form-control-multi" id="schamp_b_func_id" name="schamp_b_func_id[]" size="10" multiple>
                                                <option value=" ">Please Select</option>
                                                <option value="all">All</option>
                                                @foreach($sbf as $sdata)
                                                    <option value="{{$sdata->b_func_id}}">{{$sdata->b_func}}</option>
                                                @endforeach                                                     
                                            </select>                                           
                                        </div>
                                    </div>
                                </div>
								
								<div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-label">Select Safety Champion 1</label>&nbsp;<span style="color:red">*</span>
											@php $schamps = App\Helpers\UserHelper::getsChamp(); @endphp 
                                            <select class="form-control" id="schamp_id1" name="schamp_id1" required>
                                                <option value=" ">Please Select</option>
                                                @foreach($schamps as $scdata)
                                                    <option value="{{$scdata->emp_no}}">{{$scdata->name}}-{{$scdata->emp_no}}</option>
                                                @endforeach                                                     
                                            </select>                                           
                                        </div>
                                    </div>
                                </div>
								
								<div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-label">Select Safety Champion 2</label>
											@php $schamps = App\Helpers\UserHelper::getsChamp(); @endphp 
                                            <select class="form-control" id="schamp_id2" name="schamp_id2">
                                                <option value=" ">Please Select</option>
                                                @foreach($schamps as $scdata)
                                                    <option value="{{$scdata->emp_no}}">{{$scdata->name}}-{{$scdata->emp_no}}</option>
                                                @endforeach                                                     
                                            </select>                                           
                                        </div>
                                    </div>
                                </div>
								
                            <div class="row">
                                <div class="col-md-12 text-centers">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="statid" value="{{$incistatID}}">
                                    <button type="reset" class="btn btn-danger" onclick='location.href ="{{url('admin/saftchamp-list')}}"'>Cancel</button>
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