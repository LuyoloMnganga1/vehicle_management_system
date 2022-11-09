
<!-- left bar -->
<div class="left-side-bar">
    <div class="brand-logo">
        <a class="navbar-brand" href="#">
            <img src="vendors/images/logo.png" alt="logo" />
          </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                    </a>

                </li>
                {{-- <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-building"></span><span class="mtext">Department</span>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon"><i class="dw dw-user"></i></span><span class="mtext">Staff Leave Days</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon"><i class="material-icons">bed</i></span><span class="mtext">Leave Type</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon"><i class="material-icons">date_range</i></span><span class="mtext">Holidays</span>
                    </a>
                </li> --}}
                {{-- <li class="dropdown">
                    <a ref="javascript:void(0);" class="dropdown-toggle">
                        <span class="micon fa fa-users"></span><span class="mtext">Staff</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="#">Manage Staff</a></li>
                    </ul>
                </li> --}}

                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <span class="micon dw dw-car"></span><span class="mtext"> Vehicles</span>
                    </a>
                    <ul class="submenu">

                        <li><a  href="{{route('vehicle')}}">Vehicles</a></li>

                        <li><a href="{{route('assiged-vehicle')}}">Assign Vehicle</a></li>

                        <li><a href="{{route('assig-history')}}">Assign History</a></li>

                        {{-- <li><a href="#">Department Leaves</a></li> --}}

                        {{-- <li><a href="#">My Leaves</a></li> --}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <span class="micon dw dw-car"></span><span class="mtext"> Issues</span>
                    </a>
                    <ul class="submenu">

                        <li><a  href="{{route('issue')}}">Issues</a></li>
{{-- 
                        <li><a href="{{route('assiged-vehicle')}}">Assignment New Vehicle</a></li>

                        <li><a href="{{route('assig-history')}}">Assignment History</a></li> --}}

                        {{-- <li><a href="#">Department Leaves</a></li> --}}

                        {{-- <li><a href="#">My Leaves</a></li> --}}
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <span class="micon dw dw-flask"></span><span class="mtext"> Fuel Entry</span>
                    </a>
                    <ul class="submenu">

                        <li><a  href="{{route('fuel-Entry')}}">Fuel Entries</a></li>

                        <li><a href="{{route('councillors')}}">councillors</a></li>

                        {{--<li><a href="{{route('assig-history')}}">Assignment History</a></li> --}}

                        {{-- <li><a href="#">Department Leaves</a></li> --}}

                        {{-- <li><a href="#">My Leaves</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-file"></span><span class="mtext">Report</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
