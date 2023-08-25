@extends('admin.include.layout')
@section('after_styles')

@endsection
<!--  <?php //dd($report);exit;?>  -->
        @section('body')
        <section class="repoting-form">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('admin/admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
            </ol>
            <div class="card">
                <div class="card-body">
                   <!--  <ul class="nav nav-tabs">
                        <li><a  id="Personal" data-toggle="tab" href="#peronalInfo" class="active"  >Personal Information</a></li>
                        <li><a  id="Health"  href="{{url('admin/admin-myhealth')}}">Health &amp; Emergency Information</a></li>
                        <li><a  id="Incident" href="{{url('admin/admin-incident')}}">Incident</a></li>
                    </ul> -->

                    <div class="tab-content">
 <!-- ============================ Start: Personal Information Tab ============================ -->

                        <div id="peronalInfo" class="tab-pane fade active show active">
                            <h4>Change Password</h4>
                            <form method="post" action="{{url('admin/admin-changepssincident')}}" enctype="multipart/form-data">
                                  @if (session('success'))
                           <div style="color: red;font-size: 16px;display: inline-block;">
                                     {{ Session('success') }}
                                  </div>
                                                @endif
                                 <ul class="reporting-form peronalInfo"> 
                                    
                           
                                    <li>
                                        <div class="form-group">
                                            <label for="">New Password</label>
                                            <input name="password" type="password" class="form-control" placeholder="Enter your new password" required>
                                        </div>
                                    @if($errors->has('password'))

                                <div class="invalid-feedback" style="display:block;">{{$errors->first('password')}}</div>

                            @endif
                                    </li>
                                    <li>
                                        <div class="form-group">
                                            <label for="">Confirm Password</label>
                                            <input name="password_confirmation" type="password" class="form-control" placeholder="Enter your confirm password" required>
                                        </div>
                                          @if($errors->has('password_confirmation'))

                                <div class="invalid-feedback" style="display:block;">{{$errors->first('password_confirmation')}}</div>

                            @endif
                                    </li>
                                   
                                   
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <li>
                                       <!--  <button type="submit" class="btn-Primary" home>Save</button> -->
                                        <button type="submit" class="btn-Dark">Submit</button>
                                    </li>

                                </ul>
                            </form>
                          
                        </div>
                        <!-- ============================ End: Personal Information Tab ============================ -->
          </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
 @section('after_scripts')
          <script type="text/javascript">

           $('.datetimepicker1').datepicker({  

       format: 'dd/mm/yyyy',
        autoclose: true,
       
        // startDate:'today',
         orientation: 'bottom'

     }); 
    </script>
    @endsection
