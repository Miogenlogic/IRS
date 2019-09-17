@extends('admin.include.layout')

@section('after_styles')

@endsection

@section('body')


    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">


            <form method="post" action="{{url('admin/main-slider-add-save')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Add SLIDER</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="name" value="{{old('name')}} ">
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Image</label>
                            <input type="file" class="form-control" id="" placeholder="" name="image" value="{{old('image')}} ">
                            @if($errors->has('image'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('image')}}</div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Status</label>
                            <select name="status" class="form-control">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="clear:both">
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
		
		$( document ).ready(function() {
			$('.datepicker').datepicker({
				format: 'yyyy-mm-dd'//,
				//startDate: '-3d'
			});
		});
		
    </script>





@endsection
