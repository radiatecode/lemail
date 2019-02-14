@extends('admin.layout')
@section('title','Profiles')
@section('stylesheets')
    <style>
        .avatar_preview{
            width: 200px;
            height: 200px;
        }
        .hide{
            display: none;
        }
    </style>
@endsection
@section('container')
    @component('user.components.message')@endcomponent
    <div class="row">
        <div class="col-md-3 d-flex align-items-stretch grid-margin">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="label">User Avatar</label>
                            <div class="form-line">
                                <img src="{{ customAsset('images/'.Auth::user()->photo) }}" class="avatar_preview">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Profile Info</h4>
                            {!! Form::model(Auth::user(),['route'=>['admin.profile.update',Auth::user()->id],'files'=>'true','id'=>'admin_profile','method'=>'PUT']) !!}
                                <div class="form-group">
                                    <label class="label">Full Name</label>
                                    <div class="form-line">
                                        {!! Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Enter Full Name..','required'=>'']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Email</label>
                                    <div class="form-line">
                                        {!! Form::email('email',null,['class'=>'form-control','id'=>'email','placeholder'=>'Enter Email..','required'=>'']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Choose Avatar</label>
                                    <div class="form-line">
                                        {!! Form::file('photo',['class'=>'form-control','id'=>'photo']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="label">Avatar Preview</label>
                                    <div class="form-line">
                                        <img src="" class="avatar_preview" id="avatar_preview">
                                    </div>
                                </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Change Password?</label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="change_pass" value="yes" id="change_pass"  onclick="showHide(this)" class="btn btn-xs btn-danger"> yes
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div id="change" class="hide">
                                            <div class="form-group">
                                                <label class="label">New Pass</label>
                                                <div class="form-line">
                                                    {{Form::password('new_pass',array('class'=>'form-control','placeholder'=>'New Password','id'=>'new_pass'))}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="label">Confirm Pass</label>
                                                <div class="form-line">
                                                    {{Form::password('confirm_pass',array('class'=>'form-control','placeholder'=>'Confirm Password','id'=>'confirm_pass'))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" onclick="return passMatch('admin_profile')" class="btn btn-success mr-2">Submit</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ customAsset('js/ImagePreview.js') }}"></script>
    <script src="{{ customAsset('js/ProfileFunctions.js') }}"></script>
    <script>
        PhotoPreview.uploadFile("photo","avatar_preview");
    </script>
@endsection