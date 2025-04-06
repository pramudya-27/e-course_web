<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-Course - Learn Anything</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Memuat CSS dan JS melalui Vite -->
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app" class="page-wrapper">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="nav-container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('./logo.png') }}" alt="Logo" height="30" class="brand-logo">
                    <span>D-Course</span>
                </a>
                <button class="navbar-toggle" type="button" aria-label="Toggle navigation">
                    <span class="navbar-toggle-icon"></span>
                </button>
                <div class="navbar-menu" id="navbarMenu">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about') }}" class="nav-link">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                        </li>
                        <!-- Search Form -->
                        <form class="search-form" action="{{ route('search') }}" method="GET">
                            <input class="search-input" type="search" name="query" placeholder="Cari Kursus" aria-label="Search">
                            <button class="search-button" type="submit">Cari</button>
                        </form>
                    </ul>
                    <ul class="nav-list auth-list">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (auth()->user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>© {{ date('Y') }} D-Course. Created by Dio Pramudya.</p>
        </footer>
    </div>
    <!-- Tambahkan skrip JS sederhana untuk toggle navbar di layar kecil -->
    <script>
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.getElementById('navbarMenu').classList.toggle('active');
        });
    </script>
</body>
</html>