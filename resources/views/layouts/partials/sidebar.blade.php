<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <div class="c-sidebar-brand-full">
            <div class="fade-in">
                <img src="{{ asset('coreui/brand/laravel-logolockup-rgb-white.svg') }}" alt="logo" style="width: 150px;">
            </div>
        </div>
        <div class="c-sidebar-brand-minimized">
            <div class="fade-in">
                <img src="{{ asset('coreui/brand/laravel-white.svg') }}" alt="min logo" style="width: 46px;">
            </div>
        </div>
    </div>
    @include('admin.sidebar')
    @can('isUser')
        <ul class="c-sidebar-nav ps">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="#">
                    <div class="c-sidebar-nav-icon">
                        <i class="cil-book"></i>
                    </div>
                    Attendance
                </a>
            </li>
        </ul>
    @endcan

    <div class="ps__rail-x" style="left: 0; bottom: 0;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0; width: 0;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0; right: 0;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0; height: 0;"></div>
    </div>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
</div>
