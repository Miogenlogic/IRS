@extends('admin.include.layout')

@section('after_styles')
    <link rel="stylesheet" href="{{URL::asset('public/assets/datatable/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('body')

        <!-- Last Records from Every scenerio -->

        <div class="card">
            <div class="card-body">
                <div class="text-right mb-1">
                    <!--<a class="btn btn-info text-white" href="{{url('admin/cms-main-add')}}">Add CMS</a>-->
                </div>
                <div class="table-responsive">
                    <table class="table table-condensed dataTable no-footer" id="tabe1">
                        <thead>
                            <tr class="bg-light">
                                <td>#</td>
                                <td>Page</td>
                                <td>Seo Url</td>
                                <td>Status</td>
                                <td>Created Date</td>
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
                    url: '{{ url("admin/cms-contact-get-table") }}',
                },

                columns: [
                    {data: 'id', name: 'id', orderable: false, searchable: false},
                    {data: 'page', name: 'page'},
                    {data: 'seo_url', name: 'seo_url'},
                    {data: 'status', name: 'status'},
                    //{data: 'meta_key', name: 'meta_key'},
                    //{data: 'content', name: 'content'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false} ,
                ],


            // pageLength: 25,
                // order: [[ 2, "asc" ]]
            });

        });
    </script>



@endsection
