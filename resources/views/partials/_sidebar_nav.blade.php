<section id="sidebar-menu-container">
    <a href="#sidebar-menu-container" class="sidebar-menu-toggle" title="Toggle Navigation">
        <span class="fa fa-navicon"></span>
    </a>
    <div class="sidebar-menu-brand">
        <a href="{{ url('/') }}">
            <img src="{{ url('images/navbar-brand.png') }}" class="center-block">
        </a>
    </div>
    <div class="sidebar-menu-details">
        <p class="text-center">
            {{ Auth::user()->permission->name }}
        </p>
        <img src="{{ url('images/default_user_thumbnail.png') }}" alt="" class="center-block img-thumbnail img-responsive">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="text-center">
                <a href="#" class="sidebar-submenu-toggle">{{ Auth::user()->fullname }} <span class="fa fa-caret-down"></span></a>
                <ul class="sidebar-submenu text-left">
                    <li role="presentation">
                        <a href="{{ url('employees', Auth::user()->employmentInformation->id) }}"><span class="fa fa-user"></span> My Profile</a>
                    </li>
                    <li role="presentation">
                        <a href="{{ url('logout') }}"><span class="fa fa-sign-out"></span> Sign Out</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="sidebar-menu">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" {{ $active >= 1 && $active < 2 ? 'class=active' : '' }}>
                <a href="{{ url('/') }}"><span class="fa fa-home"></span> Home</a>
            </li>
            <li role="presentation" {{ $active >= 2 && $active < 3 ? 'class=active' : '' }}>
                <a href="#" class="sidebar-submenu-toggle"><span class="fa fa-group"></span> Employee Management <span class="fa fa-caret-down"></span></a>
                <ul class="sidebar-submenu">
                    <li role="presentation" {{ $active == 2.1 ? 'class=active' : '' }}>
                        <a href="{{ url('employees/') }}"><span class="fa fa-group"></span> All Employees</a>
                    </li>
                    <li role="presentation" {{ $active == 2.2 ? 'class=active' : '' }}>
                        <a href="{{ url('employees/create') }}"><span class="fa fa-user-plus"></span> New Employee</a>
                    </li>
                </ul>
            </li>
            <li role="presentation" {{ $active >= 3 && $active < 4 ? 'class=active' : '' }}>
                <a href="#" class="sidebar-submenu-toggle"><span class="fa fa-archive"></span> Payroll Transaction <span class="fa fa-caret-down"></span></a>
                <ul class="sidebar-submenu">
                    <li role="presentation" {{ $active == 3.1 ? 'class=active' : '' }}>
                        <a href="{{ url('payroll') }}"><span class="fa fa-archive"></span> All Transactions</a>
                    </li>
                    <li role="presentation" {{ $active == 3.2 ? 'class=active' : '' }}>
                        <a href="{{ url('payroll/create') }}"><span class="fa fa-plus-square"></span> New Transaction</a>
                    </li>
                    <li role="presentation" {{ $active == 3.3 ? 'class=active' : '' }}>
                        <a href="#transaction-type-modal" data-toggle="modal"><span class="fa fa-plus-square"></span> New Employee DTR</a>
                    </li>
                </ul>
            </li>
            <li role="presentation" {{ $active >= 4 && $active < 5 ? 'class=active' : '' }}>
                <a href="#" class="sidebar-submenu-toggle"><span class="fa fa-calendar"></span> Calendar <span class="fa fa-caret-down"></span></a>
                <ul class="sidebar-submenu">
                    <li role="presentation" {{ $active == 4.1 ? 'class=active' : '' }}>
                        <a href="{{ url('calendar') }}"><span class="fa fa-calendar"></span> View Calendar</a>
                    </li>
                    <li role="presentation" {{ $active == 4.2 ? 'class=active' : '' }}>
                        <a href="{{ url('calendar/create') }}"><span class="fa fa-calendar-plus-o"></span> Add Holiday/Event</a>
                    </li>
                </ul>
            </li>
            {{-- <li role="presentation" {{ $active >= 5 && $active < 6 ? 'class=active' : '' }}>
                <a href="{{ url('leave') }}"><span class="fa fa-sign-out"></span> Leave</a>
            </li> --}}
            <li role="presentation" {{ $active >= 6 && $active < 7 ? 'class=active' : '' }}>
                <a href="#" class="sidebar-submenu-toggle"><span class="fa fa-envelope"></span> Reports <span class="fa fa-caret-down"></span></a>
                <ul class="sidebar-submenu">
                    <li role="presentation" {{ $active == 6.1 ? 'class=active' : '' }}>
                        <a href="{{ url('reports/all') }}"><span class="fa fa-file-archive-o"></span> All Reports</a>
                    </li>
                    <li role="presentation" {{ $active == 6.2 ? 'class=active' : '' }}>
                        <a href="{{ url('reports/annual') }}"><span class="fa fa-file-archive-o"></span> Annual Reports</a>
                    </li>
                    <li role="presentation" {{ $active == 6.3 ? 'class=active' : '' }}>
                        <a href="{{ url('reports/quarterly') }}"><span class="fa fa-file-archive-o"></span> Quarterly Reports</a>
                    </li>
                </ul>
            </li>
            <li role="presentation" {{ $active >= 7 && $active < 8 ? 'class=active' : '' }}>
                <a href="#" class="sidebar-submenu-toggle"><span class="fa fa-unlock"></span> Control Access <span class="fa fa-caret-down"></span></a>
                <ul class="sidebar-submenu">
                    <li role="presentation" {{ $active == 7.1 ? 'class=active' : '' }}>
                        <a href="{{ url('control-access') }}"><span class="fa fa-user"></span> All Users</a>
                    </li>
                    <li role="presentation" {{ $active == 7.2 ? 'class=active' : '' }}>
                        <a href="{{ url('control-access/create') }}"><span class="fa fa-user-plus"></span> Add User</a>
                    </li>
                    <li role="presentation" {{ $active == 7.3 ? 'class=active' : '' }}>
                        <a href="{{ url('control-access/logs') }}"><span class="fa fa-file-archive-o"></span> Logs</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /.nav -->
    </div>
</section>
@include('partials._transaction_types_modal')
<!-- /#sidebar-nav -->
