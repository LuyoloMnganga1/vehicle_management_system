
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
                    <a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow">
                        <span class="micon dw dw-house"></span><span class="mtext">Dashboard</span>
                    </a>

                </li>
                
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <span class="micon dw dw-car"></span><span class="mtext"> Vehicles</span>
                    </a>
                    <ul class="submenu">

                        <li><a  href="{{route('vehicle')}}">Vehicles</a></li>

                        <li><a href="{{route('assiged-vehicle')}}">Assign Vehicle</a></li>                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{route('vehicle-driver')}}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-users"></span><span class="mtext">Drivers</span>
                    </a>

                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle">
                        <span class="micon dw dw-book"></span><span class="mtext"> Booking</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('bookings')}}">Book a vehicle</a></li>
                        <li><a href="{{route('booking-history')}}">Booking History</a></li>
                        <li><a href="{{route('log-book')}}">Log Book</a></li>
                        <li><a href="{{route('Log-history')}}">Log Book History</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="{{route('issue')}}" class="dropdown-toggle no-arrow">
                        <span class="micon fa fa-question-circle "></span><span class="mtext"> Issues</span>
                    </a>
                    {{-- <ul class="submenu">

                        <li><a  href="{{route('issue')}}">Issues</a></li>

                    </ul> --}}
                </li>
                <li class="dropdown">
                    <a href="{{route('fuel-Entry')}}" class="dropdown-toggle no-arrow">
                        <span class="micon material-icons">local_gas_station</span><span class="mtext"> Fuel Entry</span>
                    </a>
                    {{-- <ul class="submenu">

                        <li><a  href="{{route('fuel-Entry')}}">Fuel Entries</a></li> --}}

                        {{-- <li><a href="{{route('councillors')}}">councillors</a></li> --}}

                        {{--<li><a href="{{route('assig-history')}}">Assignment History</a></li> --}}

                        {{-- <li><a href="#">Department Leaves</a></li> --}}

                        {{-- <li><a href="#">My Leaves</a></li> --}}
                    {{-- </ul> --}}
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
