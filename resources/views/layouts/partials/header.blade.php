<header class="c-header c-header-light c-header-fixed c-header-with-subheader shadow-sm">
    <a class="c-header-brand d-lg-none" href="#">
        <svg width="118" height="46">
            <use xlink:href="{{ asset('coreui/brand/coreui.svg') }}#full"></use>
        </svg>
    </a>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
               aria-expanded="false">
                {{ auth()->user()->getFullNameAttribute() }}
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
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">
                <h5>{{ $pageTitle }}</h5>
            </li>
        </ol>
    </div>
</header>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
