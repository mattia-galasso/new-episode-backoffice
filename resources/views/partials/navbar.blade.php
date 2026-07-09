{{-- MOBILE MENU --}}
<div class="mobile-navbar d-flex d-sm-none justify-content-between align-items-center p-3">
    <img src="{{ asset('./img/logo_nextepisode.png') }}" alt="NextEpisode" class="mobile-logo">
    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
        <i class="bi bi-list fs-4"></i>
    </button>
</div>

{{-- DESKTOP MENU --}}
<div class="d-none d-sm-block me-4">
    <nav class="navbar navbar-expand-sm">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown pt-3">
                    <div class="flex-shrink-0 dropdown">
                        <a href="#"
                            class="d-flex justify-content-center align-items-center gap-2 text-decoration-none text-light"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                                class="rounded-circle">
                            <div class="lh-1">
                                <p class="m-0">{{ Auth::user()->name }}</p>
                                <small class="m-0 text-secondary">Amministratore</small>
                            </div>
                            <div class="dropdown-toggle"></div>
                        </a>


                        <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
</div>

{{-- OFFCANVAS --}}
<div class="offcanvas offcanvas-end text-bg-dark d-sm-none" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header border-bottom border-secondary py-4">
        <div class="flex-grow-1">
            <button
                class="btn w-100 text-start text-white p-0 border-0 bg-transparent d-flex justify-content-between align-items-center collapsed account-button"
                type="button" data-bs-toggle="collapse" data-bs-target="#mobileAccount" aria-expanded="false">
                <div class="d-flex align-items-center gap-2">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    <div>
                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                        <small class="text-secondary">Amministratore</small>
                    </div>

                    <i class="bi bi-chevron-down account-chevron"></i>
                </div>
            </button>
            <div class="collapse mt-3" id="mobileAccount">
                <a href="{{ url('profile') }}" class="nav-link">
                    <i class="bi bi-person me-2"></i>
                    Profilo
                </a>
                <a href="{{ route('logout') }}" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </div>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas">
        </button>
    </div>
    <div class="offcanvas-body mobile-navigation">

        @include('partials.mobile-navigation')
    </div>
</div>