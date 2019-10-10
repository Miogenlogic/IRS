@extends('admin.include.layout')

@section('after_styles')

@endsection

@section('body')


    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/cms-edit-store')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Edit CMS</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Page</label>
                            <input type="text" class="form-control" id="" placeholder="" name="page" value="{{old('page')?old('page'):$cms->page}} " disabled>
                            @if($errors->has('page'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('page')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Title</label>
                            <input type="text" class="form-control" id="" placeholder="" name="title" value="{{old('title')?old('title'):$cms->title}}">
                            @if($errors->has('title'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('title')}}</div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Seo Url</label>
                            <input type="text" class="form-control" id="" placeholder="" name="seo_url" value="{{old('seo_url')?old('seo_url'):$cms->seo_url}} ">
                            @if($errors->has('seo_url'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('seo_url')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Meta Key</label>
                            <input type="text" class="form-control" id="" placeholder="" name="meta_key" value="{{old('meta_key')?old('meta_key'):$cms->meta_key}}">
                            @if($errors->has('meta_key'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('meta_key')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Meta Description</label>
                            <input type="text" class="form-control" id="" placeholder="" name="meta_description" value="{{old('meta_description')?old('meta_description'):$cms->meta_description}}">
                            @if($errors->has('meta_description'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('meta_description')}}</div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Image</label>
                            <input type="file" class="form-control" id="" placeholder="" name="image" value="{{old('image')?old('image'):$cms->image}}" >
                            @if($cms['image']!='')

                                <img src="{{asset('public/assets/uploads/cms/image').'/'.$cms->image}}"  style="width:100px;height:100px;margin-top: 10px;">
                                <input type="checkbox" value="remove" name="img_rem"> Remove Image
                            @endif
                            @if($errors->has('image'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('image')}}</div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Content</label>
                            <textarea id="content" placeholder="" name="content" >{{old('content')?old('content'):$cms->content}}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('content')}}</div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$cms->id}}">
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
