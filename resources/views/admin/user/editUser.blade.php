@extends('admin.include.layout')

@section('after_styles')

@endsection
@php
    //$userSession=Session::get('user');
    $country=App\Helpers\UserHelper::country();
    //dd($userSession);
//print_r();die;
@endphp

@section('body')
    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/user-edit-store')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Edit User</h4>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="name" value="{{old('name')?old('name'):$user_detail->name}} ">
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Email</label>
                            <input type="text" class="form-control" id="" placeholder="" name="email" value="{{old('email')?old('email'):$user->email}} ">
                            @if($errors->has('email'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="email">User Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="username" value="{{old('username')?old('username'):$user->username}} " >
                            @if($errors->has('username'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('username')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" id="" placeholder="" name="password"  >
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if($user->user_type != 'admin')
                        <div class="col-md-6" style="clear:both;margin-bottom: 1rem;font-size: 0.875rem;">
                            <div class="form-group" style="margin-bottom:0.5rem">
                                <label for="pwd">User Type</label>
                                <select name="user_type" class="form-control">

                                    @foreach($role as $valrole)
                                        <option value="{{$valrole->id.'-'.$valrole->name}}" {{(old('user_type')!=$user->user_type)?($valrole->name==$user->user_type)?'selected=selected':'': 'selected=selected'}}>{{$valrole->display_name}}</option>

                                    @endforeach

                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Address</label>
                            <textarea class="form-control" rows="4" id="" placeholder="" name="address" >{{old('address')?old('address'):$user_detail->address}}</textarea>
                            @if($errors->has('address'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('address')}}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Status</label>
                            <select name="status" class="form-control">
                                <option value="Active" {{old('status')=='Active'?'Selected':($user->status=='Active'?'Selected':'')}}>Active</option>
                                <option value="Inactive" {{old('status')=='Inactive'?'Selected':($user->status=='Inactive'?'Selected':'')}}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Age</label>
                            <input type="text" class="form-control datepicker" id="" placeholder="" name="age" value="{{old('age')?old('age'):$user_detail->age}} ">
                            @if($errors->has('age'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('age')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6" style="clear:both">
                    <div class="form-group">
                        <label for="pwd">Image</label>
                        <input type="file" class="form-control" id="" placeholder="" name="image" value="{{old('image')?old('image'):$user_detail->image}}">
                        @if($user_detail['image']!='')

                            <img src="{{asset('public/assets/uploads/user/image').'/'.$user_detail->image}}"  style="width:100px;height:100px;margin-top: 10px;">

                        @endif
                        @if($errors->has('image'))
                            <div class="invalid-feedback" style="display:block;">{{$errors->first('image')}}</div>
                        @endif
                    </div>
                </div>




                    <div class="col-md-6" style="clear:both;margin-bottom:1rem;font-size: 0.875rem;">
                        <div class="form-group" style="margin-bottom:0.5rem">
                            <label for="pwd">Gender</label>
                            <select name="gender" class="form-control">
                                <option value="MALE" {{old('gender')=='MALE'?'Selected':($user_detail->gender=='MALE'?'Selected':'')}}>MALE</option>
                                <option value="FEMALE" {{old('FEMALE')=='FEMALE'?'Selected':($user_detail->gender=='FEMALE'?'Selected':'')}}>FEMALE</option>
                            </select>
                        </div>

                    </div>

                </div>


                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Country</label>
                            <select name="usercountry" id="usercountry" class="form-control">

                                <option selected="selected" disabled="disabled">Select Country For Phonecode</option>
                                @foreach($country as $wks)
                                    <option value="{{$wks->id.'-'.$wks->phonecode}}" {{(old('country_id')==$user_detail->country_id)? 'selected':($wks->phonecode==$user_detail->country_id?'Selected':'')}}>{{$wks->country}}</option>


                                @endforeach
                            </select>
                        </div>
                    </div>


                            <div class="col-md-6" style="clear:both">
                                <div class="form-group">
                                    <label style="position: relative;
    right: 54px;" for="email">Mobile</label>
                                    <input style="margin-top: 22px;
    width: 12%;
    float: left;" type="text" id="xyz" class="form-control" value="{{old('country_id')?old('country_id'):$user_detail->country_id}}" readonly >
                                    <input style="  width: 88%;
    float: left;" type="text" class="form-control" id="" placeholder="enter" name="phone" value="{{old('phone')?old('phone'):$user_detail->phone}} ">

                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback" style="display:block;">{{$errors->first('phone')}}</div>
                                    @endif
                                </div>
                            </div>


                </div>

                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{$user->id}}">

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
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'//,
            //startDate: 'd'
        });
    </script>-->
    <script type="text/javascript">
        $("#usercountry").change(function(){
            var countryCode=$(this).val();
            var res = countryCode.split("-");
            $("#xyz").val('+'+res[1]);
        });
    </script>



@endsection
