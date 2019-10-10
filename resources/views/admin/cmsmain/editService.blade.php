@extends('admin.include.layout')

@section('after_styles')

@endsection

@php
//print_r($cms);die;
@endphp
@section('body')


    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/cms-service-edit-store')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Edit Service</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Page</label>
                            <input type="text" class="form-control" id="" placeholder="" name="page" value="{{old('page')?old('page'):$cmsmain->page}} " disabled>
                            @if($errors->has('page'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('page')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd"> Page Title</label>
                            <input type="text" class="form-control" id="" placeholder="" name="title" value="{{old('title')?old('title'):$cmsmain->title}}">
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
                            <input type="text" class="form-control" id="" placeholder="" name="seo_url" value="{{old('seo_url')?old('seo_url'):$cmsmain->seo_url}} ">
                            @if($errors->has('seo_url'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('seo_url')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Meta Key</label>
                            <input type="text" class="form-control" id="" placeholder="" name="meta_key" value="{{old('meta_key')?old('meta_key'):$cmsmain->meta_key}}">
                            @if($errors->has('meta_key'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('meta_key')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Meta Description</label>
                            <input type="text" class="form-control" id="" placeholder="" name="meta_description" value="{{old('meta_description')?old('meta_description'):$cmsmain->meta_description}}">
                            @if($errors->has('meta_description'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('meta_description')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Status</label>
                            <select name="status" class="form-control">
                                <option value="Active" {{old('status')=='Active'?'Selected':($cmsmain->status=='Active'?'Selected':'')}}>Active</option>
                                <option value="Inactive" {{old('status')=='Inactive'?'Selected':($cmsmain->status=='Inactive'?'Selected':'')}}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6" style="clear:both">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Image</label>
                            <input type="file" class="form-control" id="" placeholder="" name="image" value="" >
                            @if($cmsmain['image']!='')

                                <img src="{{asset('public/assets/uploads/cmspage/image').'/'.$cmsmain->image}}"  style="width:100px;height:100px;margin-top: 10px;">
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
                            <label for="pwd">About Service</label>
                            <textarea id="content1" placeholder="" name="content{{$cms[0]->id}}" >{{old('content')?old('content'):$cms[0]->content}}</textarea>
                            @if($errors->has('content'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('content')}}</div>
                            @endif
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$cmsmain->id}}">
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
        CKEDITOR.replace('content1', {
            //filebrowserUploadUrl: "{{url('admin/ckeditor-upload/')}}?_token={{csrf_token()}}",
            filebrowserImageBrowseUrl: "{{url('laravel-filemanager/')}}?type=Images",
            filebrowserImageUploadUrl: "{{url('/laravel-filemanager/upload')}}?type=Images&_token={{csrf_token()}}",
            filebrowserBrowseUrl: "{{url('laravel-filemanager/')}}?type=Files",
            filebrowserUploadUrl: "{{url('/laravel-filemanager/upload')}}?type=Files&_token={{csrf_token()}}"
        });

    </script>


    }



@endsection
