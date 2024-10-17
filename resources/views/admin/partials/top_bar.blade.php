<nav class="navbar navbar-expand navbar-dark bg-dark admin-top-bar">

    <div class="container-fluid px-xxl-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img class="d-block d-md-none" style="height: 32px" src="{!! Vite::asset('resources/images/logos/logos-lt/logo-lt-mark.png') !!}"
                alt="{{ config('app.name', 'Laravel') }}">

            <img class="d-none d-md-block" style="height: 32px" src="{!! Vite::asset('resources/images/logos/logos-lt/logo-lt-horizontal.png') !!}"
                alt="{{ config('app.name', 'Laravel') }}">
        </a>

        <!-- Right Side Of Navbar -->
        <menu class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link d-block d-md-none" href="{{ route('login') }}">
                        <i class="fa-solid fa-user-shield"></i>
                    </a>

                    <a class="nav-link d-none d-md-block" href="{{ route('login') }}">
                        Login
                    </a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link d-block d-md-none" href="{{ route('register') }}">
                            <i class="fa-solid fa-user-pen"></i>
                        </a>

                        <a class="nav-link d-none d-md-block" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <span class="d-inline d-md-none"><i class="fa-solid fa-user"></i></span>

                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('admin') }}">
                            Dashboard
                        </a>
                        <a class="dropdown-item" href="{{ url('profile') }}">
                            Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </menu>
    </div>
</nav>
