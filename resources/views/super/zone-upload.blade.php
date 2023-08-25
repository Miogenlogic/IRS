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
                            <form action="{{url('admin/zone-save')}}" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="">Upload File </label><span style="color:red">*</span>
                                            <input type="file" name="zone_file" class="form-control date-picker-doj" data-datepicker-color="primary" required >                                          
                                        </div>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-md-12 text-centers">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <button type="reset" class="btn btn-danger" onclick='location.href ="{{url('admin/zones-list')}}"'>Cancel</button>
                                    <button type="submit" class="btn btn-success">Upload</button>
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
	<script>
		
	</script>
@endsection