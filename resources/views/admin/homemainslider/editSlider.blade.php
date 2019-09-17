@extends('admin.include.layout')

@section('after_styles')

@endsection

@section('body')


    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/main-slider-edit-store')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Edit SLIDER</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="name" value="{{old('name')?old('name'):$homeslider->name}}">
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Image</label>
                            <input type="file" class="form-control" id="" placeholder="" name="image" value="{{old('image')?old('image'):$homeslider->image}}">
                            @if($homeslider['image']!='')

                                <img src="{{asset('public/assets/uploads/slider/image').'/'.$homeslider->image}}"  style="width:100px;height:100px;margin-top: 10px;">
                                <input type="checkbox" value="remove" name="img_rem"> Remove Image
                            @endif
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
                                <option value="Active" {{old('status')=='Active'?'Selected':($homeslider->status=='Active'?'Selected':'')}}>Active</option>
                                <option value="Inactive" {{old('status')=='Inactive'?'Selected':($homeslider->status=='Inactive'?'Selected':'')}}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="clear:both">
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Content</label>
                            <textarea id="content" placeholder="" name="content" >{{old('content')?old('content'):$homeslider->content}}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('content')}}</div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$homeslider->id}}">
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


  }



@endsection
