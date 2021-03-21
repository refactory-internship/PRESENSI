<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <svg class="c-sidebar-brand-full" width="118" height="46">
            <use xlink:href="{{ asset('coreui/brand/coreui.svg') }}#full"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46">
            <use xlink:href="{{ asset('coreui/brand/coreui.svg') }}#signet"></use>
        </svg>
    </div>

    @if(auth()->user()->can('master-crud'))
        @include('admin.sidebar')
    @else
        <ul class="c-sidebar-nav ps">
            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                    <div class="c-sidebar-nav-icon">
                        <i class="cil-task"></i>
                    </div>
                    Attendance
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('web.employee.attendances.index') }}">
                            Your Attendances
                        </a>
                    </li>
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link" href="{{ route('web.employee.overtimes.index') }}">
                            Overtimes
                        </a>
                    </li>
                </ul>
            </li>
            @if(auth()->user()->can('approve-attendances'))
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="{{ route('web.employee.approve-attendances.index') }}">
                        <div class="c-sidebar-nav-icon">
                            <i class="cil-puzzle"></i>
                        </div>
                        Approve Attendance
                        @if($counter)
                            <span class="badge badge-danger">
                                {{ $counter }}
                            </span>
                        @endif
                    </a>
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
