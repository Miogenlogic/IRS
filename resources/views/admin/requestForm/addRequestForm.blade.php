@extends('admin.include.layout')

@section('after_styles')

    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.css')}}">
    <style>
        .datepicker.datepicker-dropdown .datepicker-days table.table-condensed thead tr th.dow, .datepicker.datepicker-inline .datepicker-days table.table-condensed thead tr th.dow{font-weight: bold !important;}
    </style>
@endsection

@section('body')
    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/request-form-add-store')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title"> Add Request Form</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="email">Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="name" value="">
                            @if($errors->has('name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('name')}}</div>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Email</label>
                            <input type="text" class="form-control" id="" placeholder="" name="email" value="">
                            @if($errors->has('email'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('email')}}</div>
                            @endif
                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for=email">Select Service</label>
                            <select name="select_service" class="form-control">
                                <option selected="selected" disabled="disabled">Select Service</option>
                                <option value="Cosmetic Dentistry">Cosmetic Dentistry</option>
                                <option value="General Dentistry">General Dentistry</option>
                                <option value="Orthodontics">Orthodontics</option>
                                <option value="Children`s Dentistry">Children`s Dentistry</option>
                                <option value="Dental Implants">Dental Implants</option>
                                <option value="Dental Emergency">Dental Emergency</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Phone</label>
                            <input type="text" class="form-control" id="" placeholder="" name="phone" value="">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('phones')}}</div>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="row row-sm-space mt-1">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="pwd">Date</label>
                            <input type="text" class="form-control datepicker" id="datepicker" placeholder="" name="date" value="">
                            @if($errors->has('date'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('date')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 mt-1 mt-sm-0">
                        <div class="form-group">
                            <label for="pwd">Time</label>
                            <input type="text" class="form-control timepicker" id="timepicker" placeholder="" name="time" value="">
                            @if($errors->has('time'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('time')}}</div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button  type="submit" class="btn btn-outline-success">Request</button>
                            <button  type="cancel" class="btn btn-outline-danger">Cancel</button>
                        </div>
                    </div>


            </form>
        </div>
    </div>
    <!-- card-end -->

@endsection


@section('after_scripts')
    <script src="{{URL::asset('public/assets/admin/vendors/bootstrap-datetimepicker/moment.js')}}"></script>
    <script src="{{URL::asset('public/assets/admin/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>

    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: 'd',
            autoclose: 'true'
        });
    </script>


    <script type="text/javascript">
        $('.timepicker').datetimepicker({
            format: 'LT'
        });

    </script>

@endsection
