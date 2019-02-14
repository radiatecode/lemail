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
                        {!! Form::open(['route'=>'user.register','data-parsley-validate'=>'','files'=>'true']) !!}
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
                                <label class="label">Password</label>
                                <div class="form-line">
                                    {!! Form::password('password',['class'=>'form-control','id'=>'password','placeholder'=>'Enter Password..','required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="label">Confirm Password</label>
                                <div class="form-line">
                                    {!! Form::password('password_confirmation',['class'=>'form-control','id'=>'password_confirmation','placeholder'=>'Confirm Password...','required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary submit-btn btn-block">Submit</button>
                            </div>
                            <div class="text-block text-center my-3">
                                <span class="text-small font-weight-semibold">Already Have An Account?</span>
                                <a href="{{ url('user/login') }}" class="text-black text-small">Login</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@include('user.partials._script')
{{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
        {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
        {{--crossorigin="anonymous"></script>--}}
</body>

</html>