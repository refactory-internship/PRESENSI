<ul class="c-sidebar-nav ps">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('web.home') }}">
            <div class="c-sidebar-nav-icon">
                <i class="cil-speedometer"></i>
            </div>
            Dashboard
        </a>
    </li>
    <li class="c-sidebar-nav-title">Components</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('web.admin.roles.index') }}">
            <div class="c-sidebar-nav-icon">
                <i class="cil-puzzle"></i>
            </div>
            Roles
        </a>
    </li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <div class="c-sidebar-nav-icon">
                <i class="cil-people"></i>
            </div>
            Employees
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.admin.users.index') }}">
                    Employee Data
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.admin.deactivated-employees') }}">
                    Deactivated Employees
                </a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <div class="c-sidebar-nav-icon">
                <i class="cil-building"></i>
            </div>
            Office Data
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.admin.offices.index') }}">
                    Offices
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.admin.divisions.index') }}">
                    Divisions
                </a>
            </li>
        </ul>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('web.admin.calendars.create') }}">
            <div class="c-sidebar-nav-icon">
                <i class="cil-settings"></i>
            </div>
            Calendar
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('web.admin.time-settings.index') }}">
            <div class="c-sidebar-nav-icon">
                <i class="cil-settings"></i>
            </div>
            Time Settings
        </a>
    </li>
</ul>
