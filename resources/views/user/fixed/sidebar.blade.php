<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="title">
            <h1 class="h5">{{ Auth::user()->name }}</h1>
        </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{ request()->routeIs('account.dashboard') ? 'active' : '' }}">
            <a href="{{ route('account.dashboard')}}"> <i class="icon-pie-chart"></i>Dashboard </a>
        </li>

    </ul>
</li>

        <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Bookings </a></li>
        <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Payments </a></li>
        <li> <a href="#"> <i class="icon-settings"></i>Change Password </a></li>

</nav>