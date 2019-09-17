@extends('admin.include.layout')

@section('after_styles')

@endsection

@section('body')

    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/settings-save')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Edit Settings</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="option">Logo</label>
                            <input type="file" class="form-control" id="" placeholder="" name="setting[logo]" value="">
                            @if($settings['logo'] != '')
                                <img src="{{asset('public/assets/uploads/logo').'/'.$settings['logo']}}"  style="width:100px;height:100px;margin-top: 10px;">
                            @endif
                            @if($errors->has('logo'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('logo')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Logo Title</label>
                            <input type="text" class="form-control" id="" placeholder="" name="setting[logo-title]" value="{{old('logo-title')?old('logo-title'):$settings['logo-title']}}">
                            @if($errors->has('logo-title'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('logo-title')}}</div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="option">Phone1</label>
                            <input type="text" class="form-control" id="" placeholder="" name="setting[phone1]" value="{{old('phone1')?old('phone1'):$settings['phone1']}}">
                            @if($errors->has('phone1'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('phone1')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Phone2</label>
                            <input type="text" class="form-control" id="" placeholder="" name="setting[phone2]" value="{{old('phone2')?old('phone2'):$settings['phone2']}}">
                            @if($errors->has('phone2'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('phone2')}}</div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Footer Address</label>
                            <textarea id="footer-address" placeholder="" name="setting[footer-address]" >{{old('footer-address')?old('footer-address'):$settings['footer-address']}}</textarea>
                            @if($errors->has('footer-address'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('footer-address')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Header Address</label>
                            <textarea id="top-address" placeholder="" name="setting[top-address]" class="form-control">{{old('top-address')?old('top-address'):$settings['top-address']}}</textarea>
                            @if($errors->has('top-address'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('top-address')}}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="" placeholder="" name="setting[email]" value="{{old('email')?old('email'):$settings['email']}}">
                            @if($errors->has('email'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Facebook Link</label>
                            <input type="text" class="form-control" id="" placeholder="" name="setting[facebook]" value="{{old('facebook')?old('facebook'):$settings['facebook']}}">
                            @if($errors->has('facebook'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('facebook')}}</div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Twitter Link</label>
                            <input type="text" class="form-control" id="" placeholder="" name="setting[twitter]" value="{{old('twitter')?old('twitter'):$settings['twitter']}}">
                            @if($errors->has('twitter'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('twitter')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Instagram Link</label>
                            <input type="text" class="form-control" id="" placeholder="" name="setting[instagram]" value="{{old('instagram')?old('instagram'):$settings['instagram']}}">
                            @if($errors->has('instagram'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('instagram')}}</div>
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
        CKEDITOR.replace('footer-address', {
            //filebrowserUploadUrl: "{{url('admin/ckeditor-upload/')}}?_token={{csrf_token()}}",
            filebrowserImageBrowseUrl: "{{url('laravel-filemanager/')}}?type=Images",
            filebrowserImageUploadUrl: "{{url('/laravel-filemanager/upload')}}?type=Images&_token={{csrf_token()}}",
            filebrowserBrowseUrl: "{{url('laravel-filemanager/')}}?type=Files",
            filebrowserUploadUrl: "{{url('/laravel-filemanager/upload')}}?type=Files&_token={{csrf_token()}}"
        });

    </script>


  }



@endsection
