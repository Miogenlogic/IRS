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
							<form method="post" action="{{url('admin/gen_hreport')}}">
							 <ul class="reporting-form incidentInfo">	
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<li>	
									<button type="submit" name="download_rep" value="download" class="btn-Dark" id="download_rep">Download Health Information</button>									
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
</script>
@endsection