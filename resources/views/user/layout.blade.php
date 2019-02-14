<!DOCTYPE html>
<html lang="en">
<head>
  @include('user.partials._head')
</head>

<body>
<div v-cloak id="app">
    <div class="container-scroller">
        <!-- partial:_navbar.html -->
        @include('user.partials._navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:_sidebar.html -->
            @include('user.partials._sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('container')
                </div>
                <!-- menu add Modal -->
                <div id="menu_add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-building"></i> Add Menu</h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="form-group">
                                            <label for="password_2">Recipient</label>
                                            <div class="form-line">
                                                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Name..','required'=>'']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_2">Subject</label>
                                            <div class="form-line">
                                                {!! Form::text('alias',null,['class'=>'form-control','placeholder'=>'Enter Menu Alias..','required'=>'']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_2">Message</label>
                                            <div class="form-line">
                                                {!! Form::text('message',null,['class'=>'form-control','id'=>'message','placeholder'=>'Enter Menu heading..','required'=>'']) !!}
                                            </div>
                                        </div>
                                        <br/>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End menu add Modal -->
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid clearfix">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019
                  <a href="http://www.radiatenoor.me/" target="_blank">RadiateNOOR</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                  <i class="mdi mdi-heart text-danger"></i>
                </span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
</div>
<!-- container-scroller -->
<!-- plugins:js -->
@include('user.partials._script')

<!-- Custom js for this page-->
<!-- End custom js for this page-->
</body>

</html>
