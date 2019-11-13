@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('body')

    <!-- Last Records from Every scenerio -->

    <div class="card">
        <div class="card-body">
            <div class="text-right mb-1">
                <a class="btn btn-info text-white" href="{{url('admin/service-modal-add')}}">Add Modal</a>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3 style="padding:2px;" class="card-title">List Of Service Modal Details</h3>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-condensed dataTable no-footer" id="tabe1">
                    <thead>
                    <tr class="bg-light">
                        <td>#</td>
                        <td>Service</td>
                        <!--<td>Modal Name</td>-->
                        <td>Modal Title</td>
                        <td>Create</td>
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
                    url: '{{ url("admin/service-modal-get-table") }}',
                },

                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'title', name: 'title'},
                    //{data: 'model_name', name: 'model_name'},

                    {data: 'model_title', name: 'model_title'},

                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],


                // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>



@endsection



