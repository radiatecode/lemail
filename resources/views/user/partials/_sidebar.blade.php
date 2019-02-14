<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ customAsset('images/'.Auth::user()->photo) }}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::user()->name }}</p>
                        <div>
                            <small class="designation text-muted">{{ Auth::user()->email }}</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
                <a href="{{ url('new/message') }}" class="btn btn-success btn-block">Compose
                    <i class="mdi mdi-plus"></i>
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('user/dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('inbox/message') }}">
                <i class="menu-icon mdi mdi-inbox"></i>
                <span class="menu-title">Inbox</span>
                <i class="menu-arrow" style="color: red;">{{ count($unread) }}</i>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('sent/message') }}">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">Sent</span>
            </a>
        </li>
    </ul>
</nav>