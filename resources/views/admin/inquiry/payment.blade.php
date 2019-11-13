@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/admin/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.css')}}">

@endsection
@php

    $userSession=Session::get('user');

@endphp
@section('body')


    <!-- Last Records from Every scenerio -->
    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('admin/payment-invoice-save')}}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-12">
                        <h4 style="padding:2px;" class="card-title">Payment Details</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="name" value="{{$pay->name}}" disabled>
                            @if($errors->has('page'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('page')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">
                        <div class="form-group">
                            <label for="pwd">Email</label>
                            <input type="text" class="form-control" id="" placeholder="" name="email" value="{{$pay->email}}" disabled>
                            @if($errors->has('page'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('page')}}</div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Transaction Id</label>
                            <input type="text" class="form-control" id="" placeholder="" name="transaction_id" value="">
                            @if($errors->has('transaction_id'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('transaction_id')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Transaction Mode</label>
                            <input type="text" class="form-control" id="" placeholder="" name="transaction_mode" value="">
                            @if($errors->has('transaction_mode'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('transaction_mode')}}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Operator Name</label>
                            <input type="text" class="form-control" id="" placeholder="" name="operator_name" value="">
                            @if($errors->has('operator_name'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('operator_name')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Payment Status</label>
                            <input type="text" class="form-control" id="" placeholder="" name="payment_status" value="">
                            @if($errors->has('payment_status'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('payment_status')}}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Total Amount</label>
                            <input type="text" class="form-control" id="" placeholder="" name="amount" value="">
                            @if($errors->has('amount'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('amount')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Amount</label>
                            <input type="text" class="form-control" id="" placeholder="" name="uncleared_amount" value="">
                            @if($errors->has('uncleared_amount'))
                                <div class="invalid-feedback" style="display:block;">{{$errors->first('uncleared_amount')}}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Discount Type</label>
                            <select name="status" class="form-control">
                                <option value="A">A</option>
                                <option value="P">P</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Discount value</label>
                            <input type="text" class="form-control" id="" placeholder="" name="comment" value="">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="clear:both">

                        <div class="form-group">
                            <label for="pwd">Discount Amount</label>
                            <input type="text" class="form-control" id="" placeholder="" name="comment" value="">

                        </div>
                    </div>
                </div>-->




                <div class="row">
                    <div class="col-md-12" style="clear:both">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" value="{{$id}}">
                            <button  type="submit"  class="btn btn-outline-success">Submit </button>

                            <button  type="cancel" class="btn btn-outline-danger">Cancel</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="text-right mb-1">
            <!-- <a class="btn btn-info text-white" href="{{url('admin/cms-add')}}">Add CMS</a>-->
            </div>
            <div class="table-responsive">
                <table class="table table-condensed dataTable no-footer" id="tabe1">
                    <thead>
                    <tr class="bg-light">
                        <td>#</td>
                        <td>Total Amount</td>
                        <td>Amount</td>
                        <td>Payment Status</td>
                        <td>Created Date</td>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- card-end -->

@endsection


@section('after_scripts')
    <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/js/dataTables.bootstrap.js')}}">



    <script>

        $(document).ready(function(){
            $('#tabe1').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/payment-get-table") }}',
                    data:{'id':'{{$id}}'},
                },

                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'amount', name: 'amount'},
                    {data: 'uncleared_amount', name: 'uncleared_amount'},
                   {data: 'payment_status', name: 'payment_status'},
                    {data: 'created_at', name: 'created_at'},
                    //{data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],


                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>




    <script src="{{asset('public/assets/admin/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#confirmed_time').datetimepicker({
                format: 'LT'
            });

        });
    </script>
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
