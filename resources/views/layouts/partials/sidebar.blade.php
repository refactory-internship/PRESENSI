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

    @if(auth()->user()->can('master-crud'))
        @include('admin.sidebar')
    @else
        <ul class="c-sidebar-nav ps">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.home') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-speedometer"></use>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li class="c-sidebar-nav-title">Attendance</li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.employee.attendances.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-task"></use>
                    </svg>
                    Attendance
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.employee.overtimes.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-clock"></use>
                    </svg>
                    Overtime
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.employee.absents.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-notes"></use>
                    </svg>
                    Absent
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ route('web.employee.leaves.index') }}">
                    <svg class="c-sidebar-nav-icon">
                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-mood-good"></use>
                    </svg>
                    Leave
                </a>
            </li>

            @if(auth()->user()->can('approve-attendances'))
                <li class="c-sidebar-nav-title">Approval</li>
                <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                    <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-check-circle"></use>
                        </svg>
                        Approval
                        @if($attendanceCounter || $overtimeCounter || $absentCounter || $leaveCounter)
                            <span class="badge badge-danger">N</span>
                        @endif
                    </a>
                    <ul class="c-sidebar-nav-dropdown-items">
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('web.employee.approve-attendances.index') }}">
                                Attendance
                                @if($attendanceCounter)
                                    <span class="badge badge-danger">
                                        {{ $attendanceCounter }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('web.employee.approve-overtimes.index') }}">
                                Overtime
                                @if($overtimeCounter)
                                    <span class="badge badge-danger">
                                        {{ $overtimeCounter }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('web.employee.approve-absents.index') }}">
                                Absent
                                @if($absentCounter)
                                    <span class="badge badge-danger">
                                        {{ $absentCounter }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a class="c-sidebar-nav-link" href="{{ route('web.employee.approve-leaves.index') }}">
                                Leave
                                @if($leaveCounter)
                                    <span class="badge badge-danger">
                                        {{ $leaveCounter }}
                                    </span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    @endif

    <div class="ps__rail-x" style="left: 0; bottom: 0;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0; width: 0;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0; right: 0;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0; height: 0;"></div>
    </div>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
