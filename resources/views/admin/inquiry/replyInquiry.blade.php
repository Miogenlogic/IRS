@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.css')}}">

@endsection
@php
  //  print_r($service);die;
@endphp
@section('body')


    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title">Reply to Enquiry</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="name" value="{{old('name')?old('name'):$service->name}}" disabled>

                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Email</label>
                            <input type="text" class="form-control" id="" placeholder="" name="email" value="{{old('email')?old('email'):$service->email}}" disabled>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Phone</label>
                            <input type="text" class="form-control" id="" placeholder="" name="phone" value="{{old('phone')?old('phone'):$service->phone}}" disabled>

                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Service</label>
                          {{-- @if(!isset($service))--}}
                            <input type="text" class="form-control" id="" placeholder="" name="title" value="{{$service->title}}" disabled>
                            {{--@endif--}}
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Doctor</label>
                            @php
                                $doctor=\App\Helpers\UserHelper::userById($service->doctor);
                            @endphp
                            <input type="text" class="form-control" id="" placeholder="" name="username" value="{{$doctor->name}}" disabled>
                        </div>
                    </div>
                   <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Consultation Type</label>
                            @php
                                $type=\App\Helpers\UserHelper::appointmentType($service->service_type);
                            @endphp
                            <input type="text" class="form-control" id="" placeholder="" name="type" value="{{$type->type}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Message</label>
                            <input type="text" class="form-control" id="" placeholder="" name="comment" value="{{old('comment')?old('comment'):$service->comment}}" disabled>

                        </div>
                    </div>

                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Status</label>
                            <select name="status" class="form-control">
                                <option value="Active" {{old('status')=='Active'?'Selected':($service->status=='Active'?'Selected':'')}}>Active</option>
                                <option value="Inactive" {{old('status')=='Confirmed'?'Selected':($service->status=='Confirmed'?'Selected':'')}}>Confirmed</option>
                                <option value="Inactive" {{old('status')=='Rescheduled'?'Selected':($service->status=='Rescheduled'?'Selected':'')}}>Rescheduled</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6" style="clear:both">

                                <div class="form-group">
                                    <label for="pwd"> Request Date</label>
                                    <input type="text" class="form-control datetimepicker" id="bookingdatepicker" placeholder="" name="date" value="{{old('date')?old('date'):$service->date}}" disabled >

                                </div>
                        </div>
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Request Time</label>
                            <input type="text" class="form-control timepicker" id="" placeholder="" name="time" value="{{old('time')?old('time'):$service->time}}" disabled>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd"> Confirmed Date</label>
                            <input type="text" class="form-control datetimepicker" id="confirmeddatepicker" placeholder="" name="date" value="{{old('date')?old('date'):$service->date}}" >

                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Confirmed Time</label>
                            <input type="text" class="form-control timepicker" placeholder="" name="time" value="{{old('time')?old('time'):$service->time}}" >

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="email">Content</label>
                            <textarea class="form-control" id="content"  name="content">{{old('content')}}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('content')}}</div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$service->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button  type="submit" class="btn btn-outline-success">Send </button>
                            <button  type="cancel" class="btn btn-outline-danger">Cancel</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!-- card-end -->

@endsection


@section('after_scripts')
    <script src="{{asset('public/assets/admin/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/admin/vendors/bootstrap-datetimepicker/moment.js')}}"></script>

    <script src="{{asset('public/assets/admin/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            //filebrowserUploadUrl: "{{url('admin/ckeditor-upload/')}}?_token={{csrf_token()}}",
            filebrowserImageBrowseUrl: "{{url('laravel-filemanager/')}}?type=Images",
            filebrowserImageUploadUrl: "{{url('/laravel-filemanager/upload')}}?type=Images&_token={{csrf_token()}}",
            filebrowserBrowseUrl: "{{url('laravel-filemanager/')}}?type=Files",
            filebrowserUploadUrl: "{{url('/laravel-filemanager/upload')}}?type=Files&_token={{csrf_token()}}"
        });

    </script>

  }
    <script type="text/javascript">

        $("#confirmeddatepicker").datetimepicker({
            format: "YYYY-MM-DD"
        });

    </script>


@endsection