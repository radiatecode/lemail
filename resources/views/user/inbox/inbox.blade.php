@extends('user.layout')
@section('title','Inbox Messages | LEmail')
@section('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ customAsset('css/custom.css') }}">
@endsection
@section('container')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Inbox Messages</h4>

                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="input-group bg-light">
                                        <div class="input-group-prepend bg-success">
                                            <span class="input-group-text"><i class="mdi mdi-search-web"></i></span>
                                        </div>
                                        <input id="search" type="text" class="form-control bg-light" placeholder="Search Something..." aria-label="Search Something..." aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="top-right" style="float: right">
                                    <button id="delete_messages" type="button" class="btn social-btn btn-social-outline-dribbble"><i class="mdi mdi-delete"></i></button>
                                    <a href="{{ url('inbox/message') }}" class="btn social-btn btn-social-outline-facebook"><i class="mdi mdi-refresh"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped hover" id="sent_table">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Subject
                                </th>
                                <th>
                                    Message
                                </th>
                                <th>
                                    Create At
                                </th>

                                <th>
                                    Action
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
        $(document).ready(function () {
            let csrf = "{{ csrf_token() }}";
            let url = "{{ url('delete/receiver/message/') }}";
            AppsFunction.selectedItemsActions("ids[]",url,"delete",csrf,"delete_messages")
        });
        $(document).ready( function () {
            otable = $('#sent_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! url('get/inbox/message') !!}",
                columns: [
                    {data:'hash',name:'hash'},
                    {data:'subject',name:'subject'},
                    {data:'short_message',name:'short_message'},
                    {data:'created_at',name:'created_at'},
                    {data:'action',name:'action'}
                ],
                "rowCallback": function( row, data ) {
                    if ( data.read_at == null ) {
                        $('td:eq(1)', row).html( '<b>'+data.subject+'</b>' );
                        $('td:eq(2)', row).html( '<b>'+data.short_message+'</b>' );
                        $('td:eq(3)', row).html( '<b>'+data.created_at+'</b>' );
                    }
                }
            });
            $("#search").keyup(function () {
                otable.search($(this).val()).draw();
            });
        } );
    </script>
@endsection