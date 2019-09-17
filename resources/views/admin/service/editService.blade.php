@extends('admin.include.layout')

@section('after_styles')

@endsection

@section('body')


    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/service-edit-store')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Edit Service</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Title</label>
                            <input type="text" class="form-control" id="" placeholder="" name="title" value="{{old('title')?old('title'):$blog->title}}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('title')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Image</label>
                            <input type="file" class="form-control" id="" placeholder="" name="image" value="{{old('image')?old('image'):$blog->image}}">
                            @if($blog['image']!='')

                                <img src="{{asset('public/assets/uploads/service/image').'/'.$blog->image}}"  style="width:100px;height:100px;margin-top: 10px;">
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
                                <option value="Active" {{old('status')=='Active'?'Selected':($blog->status=='Active'?'Selected':'')}}>Active</option>
                                <option value="Inactive" {{old('status')=='Inactive'?'Selected':($blog->status=='Inactive'?'Selected':'')}}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email"></label>
                            <div class="custom-control custom-checkbox" style=" padding-top: 20px;">
                                <input type="checkbox" class="custom-control-input" id="customCheck" name="featured"  value="1" {{old('featured')=='1'?'checked':($blog->featured=='1'?'checked':'')}}>
                                <label class="custom-control-label" for="customCheck" style=" padding-top: 5px;">Featured</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Seo Url</label>
                            <input type="text" class="form-control" id="" placeholder="" name="seo_url" value="{{old('seo_url')?old('seo_url'):$blog->seo_url}}">
                            @if($errors->has('seo_url'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('seo_url')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Meta Key</label>
                            <input type="text" class="form-control" id="" placeholder="" name="meta_key" value="{{old('meta_key')?old('meta_key'):$blog->meta_key}}">
                            @if($errors->has('meta_key'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('meta_key')}}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Short Content</label>
                            <textarea id="short_content" placeholder="" name="short_content" >{{old('short_content')?old('short_content'):$blog->short_content}}</textarea>
                            @if($errors->has('short_content'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('short_content')}}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Content</label>
                            <textarea id="content" placeholder="" name="content" >{{old('content')?old('content'):$blog->content}}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('content')}}</div>
                            @endif
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$blog->id}}">
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

    <!--ckeditor for shortcontent -->
    <script src="{{asset('public/assets/admin/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('short_content', {
            //filebrowserUploadUrl: "{{url('admin/ckeditor-upload/')}}?_token={{csrf_token()}}",
            filebrowserImageBrowseUrl: "{{url('laravel-filemanager/')}}?type=Images",
            filebrowserImageUploadUrl: "{{url('/laravel-filemanager/upload')}}?type=Images&_token={{csrf_token()}}",
            filebrowserBrowseUrl: "{{url('laravel-filemanager/')}}?type=Files",
            filebrowserUploadUrl: "{{url('/laravel-filemanager/upload')}}?type=Files&_token={{csrf_token()}}"
        });

    </script>


    }
    <!--ckeditor for content -->
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
