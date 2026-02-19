<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="title">
            <h1 class="h5">{{ Auth::guard('admin')->user()->name }}</h1>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{ request()->routeIs('dashboard.view') ? 'active' : '' }}">
            <a href="{{ route('dashboard.view')}}"> <i class="icon-pie-chart"></i>Dashboard </a>
        </li>
        <li><a href="tables.html"> <i class="icon-grid"></i>Manage Users </a></li>
        
        <li class="{{ request()->routeIs('rooms.types') ? 'active' : '' }}">
            <a href="{{ route('rooms.types')}}"> <i class="icon-pie-chart"></i>Rooms </a>
        </li>

    </ul>
</li>

        <li class="{{ request()->routeIs('bookings.view') ? 'active' : '' }}">
            <a href="{{route('bookings.view')}}"> <i class="fa fa-bar-chart"></i>Bookings </a>
        </li>
        <li class="{{ request()->routeIs('message.view') ? 'active' : '' }}">
            <a href="{{route('message.view')}}"> <i class="fa fa-bar-chart"></i>Messages </a>
        </li>
        <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Financials </a></li>
        <li> <a href="#"> <i class="icon-settings"></i>Change Password </a></li>

</nav>