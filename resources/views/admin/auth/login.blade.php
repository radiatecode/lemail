<!DOCTYPE html>
<html lang="en">
<head>
   @include('user.partials._head')
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    @component('user.components.message')@endcomponent
                    <div class="auto-form-wrapper">
                        {!! Form::open(['route'=>'admin.login','data-parsley-validate'=>'','files'=>'true']) !!}
                        <div class="form-group">
                            <label class="label">Email</label>
                            <div class="form-line">
                                {!! Form::email('email',null,['class'=>'form-control','id'=>'email','placeholder'=>'Enter Email..','required'=>'']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="label">Password</label>
                            <div class="form-line">
                                {!! Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Enter Password..','required']) !!}
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div class="form-check form-check-flat mt-0">
                                <label class="form-check-label">
                                    <input type="checkbox" name="remember" id="remember"  class="form-check-input" {{ old('remember') ? 'checked' : '' }}> Keep me signed in
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <ul class="auth-footer">
                        <li>
                            <a href="#">Conditions</a>
                        </li>
                        <li>
                            <a href="#">Help</a>
                        </li>
                        <li>
                            <a href="#">Terms</a>
                        </li>
                    </ul>
                    <p class="footer-text text-center">copyright © 2018 Bootstrapdash. All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@include('user.partials._script')
<script src="{{ customAsset('js/parsley.min.js') }}" type="text/javascript"></script>
</body>
</html>