<ul class="c-sidebar-nav ps">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('web.home') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-speedometer"></use>
            </svg>
            Dashboard
        </a>
    </li>
    <li class="c-sidebar-nav-title">Components</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('web.admin.roles.index') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-puzzle"></use>
            </svg>
            Roles
        </a>
    </li>
    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-people"></use>
            </svg>
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
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-building"></use>
            </svg>
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
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-settings"></use>
            </svg>
            Calendar
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('web.admin.time-settings.index') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-settings"></use>
            </svg>
            Time Settings
        </a>
    </li>
    <li class="c-sidebar-nav-title">Attendance</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ route('web.admin.QRCode.create') }}">
            <svg class="c-sidebar-nav-icon">
                <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-qr-code"></use>
            </svg>
            QR Code Attendance
        </a>
    </li>
</ul>
