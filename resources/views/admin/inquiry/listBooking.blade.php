@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/js/dataTables.bootstrap.js')}}">
@endsection

@section('body')

        <!-- Last Records from Every scenerio -->

        <div class="card">
            <div class="card-body">
                <div class="text-right mb-1">
                   <!-- <a class="btn btn-info text-white" href="{-{url('admin/cms-add')}}">Add CMS</a>-->
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="padding:2px;" class="card-title">List Of Customer's Booking Details</h3>
                    </div>
                </div>
                <div class="input-group custom-search-form" style="padding-right: 650px;">
                    <label style="text-align: left;padding-right: 10px">Name</label>
                    <input type="text" class="form-control" name="search" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default-sm" type="submit">
                            <i class="fa fa-search">Filter</i>
                        </button>
                    </span>
                </div>

                <div class="table-responsive" style="margin-top: 10px">
                    <table class="table table-condensed dataTable no-footer" id="tabe1">
                        <thead>
                            <tr class="bg-light">
                                <td>#</td>
                                <td>Name</td>
                                <!--<td>Email</td>
                                <td>Phone</td>-->
                                <td>Doctor</td>
                                <td>Service</td>
                                <td>Type</td>
                                <td>Status</td>
                                <td>Date</td>
                                <td>Time</td>
                                <!--<td>Created At</td>-->
                                <td>Action</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- card-end -->
    </div>
@endsection


@section('after_scripts')
    <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/js/dataTables.bootstrap.js')}}">



    <script>

        $(document).ready(function(){
            $('#tabe1').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/booking-get-table") }}',
                },

                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    //{data: 'email', name: 'email'},
                   // {data: 'phone', name: 'phone'},
                    {data: 'doctor_name', name: 'doctor_name'},
                    {data: 'title', name: 'title'},
                    {data: 'type', name: 'type'},
                    {data: 'status', name: 'status'},
                    {data: 'date', name: 'date'},
                    {data: 'time', name: 'time'},
                   // {data: 'created_at', name: 'created_at'},
                   {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],


            // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>



@endsection
