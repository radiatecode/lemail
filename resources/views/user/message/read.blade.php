@extends('user.layout')
@section('title','Read Message | LEmail')
@section('stylesheets')
    <!-- include summernote css/js -->
    <link href="{{ customAsset('js/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        .popover{
            display: none;
        }
    </style>
@endsection
@section('container')
    @component('user.components.message')@endcomponent
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Read Message</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Subject: {{ $message->subject }}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <h4 class="col-sm-12 col-form-label">
                                            From
                                        </h4>
                                        <div class="col-sm-1">
                                            <img class="img-xs rounded-circle" src="{{ customAsset('images/'.Auth::user()->photo) }}" alt="Profile image">
                                        </div>
                                        <div class="col-sm-9">
                                            <h5>{{ $message->sender->user->name }} </h5>
                                            <label>{{ $message->sender->user->email }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <h4 class="col-sm-12 col-form-label">
                                            To Me
                                        </h4>
                                        <div class="col-sm-1">
                                            <img class="img-xs rounded-circle" src="{{ customAsset('images/'.Auth::user()->photo) }}" alt="Profile image">
                                        </div>
                                        <div class="col-sm-9">
                                            <h5>{{ Auth::user()->name }} </h5>
                                            <label>{{ Auth::user()->email }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_2">Message Sent: {{ $message->created_at }}</label>
                                <div class="form-line">

                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="password_2">Message Details:</label>
                                <div class="form-line">
                                  <p> {!! $message->message !!}</p>
                                </div>
                            </div>
                            <div class="mail-body text-right tooltip-demo">
                                <button onclick="deleteItem({{ $message->id }})" type="button" class="btn btn-icons btn-inverse-danger">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ customAsset('js/summernote/dist/summernote.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ customAsset('js/AppsFunctions.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#message').summernote({
                height: 200,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true
            });
            $('#recipient').select2();
        });
        let deleteItem = function (id) {
            let delete_url = "{{ url('receiver/deleted/message/') }}"+"/"+id;
            let redirect_path = "{{ url('inbox/message') }}";
            AppsFunction.deleteSingleItem(delete_url,redirect_path);
        };
    </script>
@endsection