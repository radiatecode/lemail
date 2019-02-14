<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html">
            <img src="{{ customAsset('images/logo.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="{{ customAsset('images/logo.png') }}" alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-bell"></i>
                    <span class="count" id="count" >{{ count($unread) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list notifications" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item">
                        <p class="mb-0 font-weight-normal float-left">You have @{{ notification.length }} new notifications
                        </p>
                    </a>
                    <div class="dropdown-divider"></div>
                    <div v-for="value in notification" id="notification_shows">
                        <a href="#" @click="viewMessage(value.message_id)" class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-medium text-dark">@{{ value.subject }}</h6>
                                <p class="font-weight-light small-text">
                                    From: @{{ value.sent_by }} | Date: @{{ value.created_at }}
                                </p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <span class="profile-text">{{ Auth::user()->name }}</span>
                    <img class="img-xs rounded-circle" src="{{ customAsset('images/'.Auth::user()->photo) }}" alt="Profile image">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item p-0">
                        <div class="d-flex border-bottom">
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                            </div>
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                                <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                            </div>
                            <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                                <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                            </div>
                        </div>
                    </a>
                    <a href="{{ url('user/profile') }}" class="dropdown-item mt-2">
                        Profile
                    </a>
                    <a href="{{ route('logout') }}"
                       class="dropdown-item"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Sign Out
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>