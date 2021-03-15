<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
    <a class="c-header-brand d-lg-none" href="#">
        <svg width="118" height="46">
            <use xlink:href="{{ asset('coreui/brand/coreui.svg') }}#full"></use>
        </svg>
    </a>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                {{ \Illuminate\Support\Facades\Auth::user()->getFullNameAttribute() }}
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-user"></use>
                    </svg>
                    Profile
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('coreui/icons/free.svg') }}#cil-account-logout"></use>
                    </svg>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</header>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
