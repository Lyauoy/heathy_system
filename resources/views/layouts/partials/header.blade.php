<div class="header">
    <div class="header-left">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{ asset('assets/img/logo.png') }}" width="35" height="35" alt=""> <span>SU30+</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    <ul class="nav user-menu float-right">
        <li class="nav-item dropdown d-none d-sm-block">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span>Notification</span>
                </div>
                <div class="drop-scroll">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="#">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="noti-details">New appointment request</p>
                                        <p class="noti-time"><span class="notification-time">Just now</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">View all Notifications</a>
                </div>
            </div>
        </li>
        <li class="nav-item dropdown d-none d-sm-block">
            <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-danger float-right">8</span></a>
        </li>
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" width="24" alt="Admin">
                    <span class="status online"></span>
                </span>
                <span>{{ Auth::user()->name ?? 'Admin' }}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">My Profile</a>
                <a class="dropdown-item" href="#">Edit Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">My Profile</a>
            <a class="dropdown-item" href="#">Edit Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </div>
</div>
