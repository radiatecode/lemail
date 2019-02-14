@extends('user.layout')
@section('title','Dashboard | LEmail')
@section('container')
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-send-secure text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Sent Message</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $sent }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Sent Message
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-receipt text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Inbox Message</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $inbox }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Inbox
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-email-open text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Read Message</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $read }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Read Message
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-email text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Unread Message</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ ($inbox-$read) }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Unread Message
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Last 20 Activity</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    # SL
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Activity
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $sl = 1; @endphp
                            @foreach($logs as $row)
                                <tr>
                                    <td class="font-weight-medium">
                                        <button type="button" class="btn btn-icons btn-rounded {{ $row->activity=="login"?'btn-outline-success':'btn-outline-danger' }}">
                                            {{ $sl }}
                                        </button>
                                    </td>
                                    <td class="{{ $row->activity=="login"?'text-success':'text-danger' }} ">
                                        {{ $row->date }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn {{ $row->activity=="login"?'btn-outline-success':'btn-outline-danger' }} btn-rounded btn-fw">{{ $row->activity }}</button>
                                    </td>
                                </tr>
                                @php $sl++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection