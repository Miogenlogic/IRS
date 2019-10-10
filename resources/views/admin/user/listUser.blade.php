@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('body')
    <div class="content-wrapper">

        <!-- Last Records from Every scenerio -->
        <div class="card">
            <div class="card-body">
                <div class="text-right mb-1">
                    <a class="btn btn-info text-white" href="{{url('admin/user-add')}}">Add User</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-condensed dataTable no-footer" id="tabe1">
                        <thead>
                            <tr class="bg-light">
                                <td>#</td>

                                <td>Name</td>
                                <td>Email</td>
                                <td>Mobile</td>

                                <td>User Type</td>
                                <td>Status</td>
                                <!--<td>Created Date</td>-->
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
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'//,
            //startDate: 'd'
        });
    </script>-->

    <script>
        $(document).ready(function(){
            $('#tabe1').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: '{{ url("admin/user-get-table") }}',
                },
                columns: [
                    {data: 'user_id', name: 'user_id',orderable: false, searchable: false},
                    //{data: 'username', name: 'username'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    //{data: 'dob', name: 'dob'},
                    //{data: 'sex', name: 'sex'},
                    {data: 'user_type', name: 'user_type'},
                    {data: 'status', name: 'status'},
                    //{data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],
                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>



@endsection
