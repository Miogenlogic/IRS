@extends('admin.include.layout')

@section('after_styles')

@endsection
@php
    $service=App\Helpers\UserHelper::service();
@endphp


@section('body')


    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">


            <form method="post" action="{{url('admin/service-modal-add-store')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Add Modal Content</h4>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Modal Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="model_name" value="{{old('model_name')}} ">
                            @if($errors->has('model_name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('model_name')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Modal Title</label>
                            <input type="text" class="form-control" id="" placeholder="" name="model_title" value="{{old('model_title')}} ">
                            @if($errors->has('model_title'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('model_title')}}</div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="email">Service</label>
                            <select name="service_id" id="" class="form-control bookingservice">

                                <option selected="selected" disabled="disabled">Select Service*</option>

                                @foreach($service as $wks)

                                    <option value="{{$wks->id}}">{{$wks->title}}</option>

                                @endforeach
                            </select>
                                @if($errors->has('service_id'))
                                    <div class="invalid-feedback" style="display:block;">{{$errors->first('service_id')}}</div>
                                @endif

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

                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button  type="submit" class="btn btn-outline-success">Submit</button>
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





@endsection
