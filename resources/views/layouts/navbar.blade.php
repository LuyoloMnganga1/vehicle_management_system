<!-- nav bar -->
<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="container-fluid systemname text-center" style="color: #C3bE5C;width:100%;">Vehicle Management System</div>    </div>
    <div class="header-right">

        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>


        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{ Auth::user()->profile }}" alt="">
                    </span>
                    <span class="user-name">{{ Auth::user()->name }} {{ Auth::user()->surname }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href ="{{ route('profile') }}"><i class="dw dw-user1"></i> Profile</a>

                    {{-- <a class="dropdown-item" href ="#"><i class="dw dw-file-3"></i> User Activity Feeds</a>
                    <a class="dropdown-item" href ="#"><i class="dw dw-file-4"></i> Reports</a> --}}

                    <a class="dropdown-item" href ="{{route('Logout')}}"><i class="dw dw-logout"></i> Log Out</a>
                </div>
            </div>
        </div>

    </div>
</div>
