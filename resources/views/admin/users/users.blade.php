@extends('admin.layout')
@section('title','User List | LEmail')
@section('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ customAsset('css/custom.css') }}">
@endsection
@section('container')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User List</h4>

                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <div class="input-group bg-light">
                                        <div class="input-group-prepend bg-success">
                                            <span class="input-group-text"><i class="mdi mdi-search-web"></i></span>
                                        </div>
                                        <input id="search" type="text" class="form-control bg-light" placeholder="Search Something..." aria-label="Search Something..." aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="top-right" style="float: right">
                                    <button id="active"  type="button" class="btn social-btn btn-outline-success"><i class="mdi mdi-check-circle"></i> Active</button>
                                    <button id="inactive"  type="button" class="btn social-btn btn-outline-warning"><i class="mdi mdi-exclamation"></i> Inactive</button>
                                    <button id="delete" type="button" class="btn social-btn btn-social-outline-dribbble"><i class="mdi mdi-delete"></i></button>
                                    <a href="{{ url('user/list') }}" class="btn social-btn btn-social-outline-facebook"><i class="mdi mdi-refresh"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped hover" id="user_table">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Last Login Date
                                </th>
                                <th>
                                    Active
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ customAsset('js/AppsFunctions.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            let csrf = "{{ csrf_token() }}";
            let url = "{{ url('user/data/') }}";
            AppsFunction.selectedItemsActions("ids[]", url, "delete", csrf, "delete");
            AppsFunction.selectedItemsActions("ids[]", url, "active", csrf, "active");
            AppsFunction.selectedItemsActions("ids[]", url, "inactive", csrf, "inactive");
        });
        $(document).ready( function () {
            otable = $('#user_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! url('get/user/list') !!}",
                columns: [
                    {data:'hash',name:'hash'},
                    {data:'name',name:'name'},
                    {data:'email',name:'email'},
                    {data:'date',name:'date'},
                    {data:'active',name:'active'},
                    {data:'status',name:'status'},
                ]
            });
            $("#search").keyup(function () {
                otable.search($(this).val()).draw();
            });
        } );
    </script>
@endsection