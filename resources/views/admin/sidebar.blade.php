<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <div class="c-sidebar-brand-full fade-in">
            <div class="row justify-content-center fade-in">
                <img class="p-0" src="{{ asset('coreui/brand/laravel-white.svg') }}" style="width: auto; height: 55px;"
                     alt="logo-full">
                <div class="col my-auto pl-0">
                    <p class="mb-0 h5">{{ ucwords(strtolower(config('app.name'))) }}</p>
                </div>
            </div>
        </div>
        <div class="c-sidebar-brand-minimized fade-in">
            <img src="{{ asset('coreui/brand/laravel-white.svg') }}#signet" style="height: 46px; width: 46px"
                 alt="logo-min">
        </div>
    </div>

    <ul class="c-sidebar-nav ps">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('web.admin.home') }}">
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
            <a class="c-sidebar-nav-link" href="{{ route('web.admin.calendars.index') }}">
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
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('web.admin.attendance-report.index') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-file"></use>
                </svg>
                Attendance Report
            </a>
        </li>
    </ul>

    <div class="ps__rail-x" style="left: 0; bottom: 0;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0; width: 0;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0; right: 0;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0; height: 0;"></div>
    </div>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
