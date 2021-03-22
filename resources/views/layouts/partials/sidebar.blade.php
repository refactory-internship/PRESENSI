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
