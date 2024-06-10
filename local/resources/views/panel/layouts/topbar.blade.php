<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin1">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                {{-- <b class="logo-icon">
                    <img src="{{ asset('admin/assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                </b>
                <span class="logo-text">
                    <img src="{{ asset('admin/assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                </span> --}}
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin1">
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                        <i class="sl-icon-menu font-20"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img src="{{ asset('admin/assets/images/users/2.jpg') }}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow">
                            <span class="bg-info"></span>
                        </span>
                        <div class="d-flex no-block align-items-center p-15 bg-info text-white m-b-10">
                            <div class="">
                                <img src="{{ asset('admin/assets/images/users/2.jpg') }}" alt="user" class="img-circle" width="60">
                            </div>
                            <div class="m-l-10">
                                <h4 class="m-b-0">{{ Auth::user()->name }}</h4>
                                <p class=" m-b-0">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off m-r-5 m-l-5"></i> خروج
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>