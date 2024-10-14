<nav class="navbar navbar-expand navbar-dark bg-dark admin-top-bar">
    <div class="container-fluid px-xxl-4">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img style="height: 32px; width: 74px;" src="{!! Vite::asset('resources/images/logo.png') !!}"
                alt="{{ config('app.name', 'Laravel') }}">
        </a>

        <!-- Right Side Of Navbar -->
        <menu class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
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
