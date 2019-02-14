@extends('user.layout')
@section('title','New Message | LEmail')
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
        <div class="col-md-9 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">New Message</h4>
                            {!! Form::open(['route'=>'send.message','files'=>'true','id'=>'send_message']) !!}
                            <div class="form-group">
                                <label for="password_2">Recipient</label>
                                <div class="form-line">
                                    <select class="form-control" name="recipient[]" id="recipient" multiple required>
                                        <option value="">-- Type Recipient Name --</option>
                                        @foreach($users as $user)
                                          <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_2">Subject</label>
                                <div class="form-line">
                                    {!! Form::text('subject',null,['class'=>'form-control','placeholder'=>'Enter Menu Alias..','required'=>'']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_2">Message</label>
                                <div class="form-line">
                                    {!! Form::textarea('message',null,['class'=>'form-control','id'=>'message','placeholder'=>'Enter Message..','required']) !!}
                                </div>
                            </div>
                            <button type="submit" id="send" class="btn btn-success mr-2">Send <i class="mdi mdi-send"></i></button>

                            {!! Form::close() !!}
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
    <script>
        $(document).ready(function() {
            $('#message').summernote({
                height: 200,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true
            });
            $('#recipient').select2();
            $("#send").click(function (e) {
                let formInstance = $('#send_message').parsley();
                if (formInstance.isValid()) {
                    e.preventDefault();
                    swal({
                        title: 'Are you want to send message',
                        text: "Send new message!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Send!'
                    }).then((result) => {
                        if (result.value) {
                           $("#send_message").submit();
                        }
                    });
                }
            });
        });
    </script>
@endsection