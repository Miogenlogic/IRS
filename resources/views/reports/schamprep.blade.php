@extends($role == '4' ? 'admin.include.layout' : 'admin.include.super_layout')
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
                    <h1>{{$title}}</h1>                   
                     <div class="tab-content">                        
                        <div>	
							<form id="sc_champ" name="sc_champ" method="post" action="{{url('admin/gen_screport')}}">
							 <ul class="reporting-form incidentInfo">	
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<li>	
									<label for="" class="form-label" style="vertical-align: top">Select Location</label>
											@php $locations = App\Helpers\UserHelper::getLocation(); @endphp 
                                            <select class="form-control" id="schamp_loc_code" name="schamp_loc_code">
                                                <option value="">Please Select</option>
                                                <option value="all">All</option>
                                                @foreach($locations as $ldata)
                                                    <option value="{{$ldata->loc_code}}">{{$ldata->location}}</option>
                                                @endforeach                                                     
                                            </select> 	
								</li>
								
								<li>	
									<label for="" class="form-label" style="vertical-align: top">Select Broad Function</label>
											@php $sbf = App\Helpers\UserHelper::getBF(); @endphp 
                                            <select class="form-control" id="schamp_b_func_id" name="schamp_b_func_id">
                                                <option value="">Please Select</option>
                                                <option value="all">All</option>
                                                @foreach($sbf as $sdata)
                                                    <option value="{{$sdata->b_func_id}}">{{$sdata->b_func}}</option>
                                                @endforeach                                                     
                                            </select>
								</li>
								
								<li>	
									<label for="" class="form-label" style="vertical-align: top">Select Employee</label>
										@php $schamps = App\Helpers\UserHelper::getsChamp(); @endphp 
										<select class="form-control" id="emp_code" name="emp_code">
											<option value="">Please Select</option>
											<option value="all">All</option>
											@foreach($schamps as $scdata)
												<option value="{{$scdata->emp_no}}">{{$scdata->name}}-{{$scdata->emp_no}}</option>
											@endforeach                                                     
										</select>
								</li>
								
								<li>	
									<button type="submit" name="download_rep" value="download" class="btn-Dark" id="download_rep" onclick="return validate();">Download</button>
								</li>
							</ul>	
						  </form>
                        </div> 				
                    </div>
                </div>
            </div>
        </div>
    </section>

 @endsection
 @section('after_scripts')
<script type="text/javascript">
function exportReport(){
	window.open("{{url('public/assets/uploads/IncidentReport.xlsx')}}", '_blank');
} 

function validate(){
	var loc   = $('#schamp_loc_code').val();
	var bfunc = $('#schamp_b_func_id').val();
	var emp   = $('#emp_code').val();
	if((loc == '') && (bfunc == '') && (emp == '')){
		alert('Please select atleast one selection criteria');
		return false;
	}
}      
</script>
@endsection