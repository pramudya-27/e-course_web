<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - E-Course</title>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/styles.css', 'resources/js/app.js'])
    <!-- SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <div id="app" class="page-wrapper">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="nav-container">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    <img src="{{ asset('./logo.png') }}" alt="Logo" height="30" class="brand-logo">
                    <span>Admin - D-Course</span>
                </a>
                <button class="navbar-toggle" type="button" aria-label="Toggle navigation">
                    <span class="navbar-toggle-icon"></span>
                </button>
                <div class="navbar-menu" id="navbarMenu">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('courses.index') }}">Kelola Kursus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.purchase_requests.index') }}">Kelola Permintaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.messages.index') }}">Pesan Kontak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Kelola Pengguna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Main View</a>
                        </li>
                    </ul>
                    <ul class="nav-list auth-list">
                        <!-- Ikon Lonceng Notifikasi -->
                        <li class="nav-item">
                            <a class="nav-link notification-bell" href="{{ route('admin.messages.index') }}">
                                <i class="bi bi-bell"></i>
                                @php
                                    $unreadMessages = App\Models\Contact::where('is_read', false)->count();
                                @endphp
                                @if ($unreadMessages > 0)
                                    <span class="notification-badge">{{ $unreadMessages }}</span>
                                @endif
                            </a>
                        </li>
                        <!-- Dropdown Pengguna -->
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
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>© 2025 D-Course. Created by Dio Pramudya.</p>
        </footer>
    </div>

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Toggle Navbar
        document.querySelector('.navbar-toggle').addEventListener('click', function() {
            document.getElementById('navbarMenu').classList.toggle('active');
        });

        // SweetAlert untuk konfirmasi hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6B46C1',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>