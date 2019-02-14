<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="user-id" content="{{ Auth::check()?Auth::user()->id:null }}">
<title>@yield('title')</title>
<!-- plugins:css -->
<link rel="stylesheet" href="{{ customAsset('css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ customAsset('css/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ customAsset('css/vendor.bundle.addons.css') }}">
<!-- endinject -->
<!-- plugin css for this page -->
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet" href="{{ customAsset('css/styles.css')}}">
<link href="{{ customAsset('js/sweet_alert/sweetalert2.css') }}" rel="stylesheet">

<!-- endinject -->
<link rel="shortcut icon" href="../../images/favicon.png" />
<style>
    .parsley-required{
        color: red;
    }
    .notifications{
        overflow-y: auto;
        height: 300px;
    }
</style>
@yield('stylesheets')