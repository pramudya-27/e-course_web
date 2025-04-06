@extends('layouts.admin')

@section('content')
@vite(['resources/css/styles.css', 'resources/js/app.js'])
<div class="admin-container">
    <h1>Pendaftaran untuk {{ $course->title }}</h1>

    <a href="{{ route('admin.dashboard') }}" class="admin-button secondary back-to-dashboard">Kembali</a>
    <!-- Form untuk menambah pengguna -->
    <div class="form-container">
        @if (isset($users) && $users->isNotEmpty())
            <form action="{{ route('registrations.store', $course) }}" method="POST" class="add-user-form">
                @csrf
                <div class="form-group">
                    <label for="user_id">Tambah Pengguna ke Kursus:</label>
                    <select name="user_id" id="user_id" class="form-select custom-select " required>
                        <option value="">Pilih Pengguna</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="admin-button primary">+ Tambah Pengguna</button>
            </form>
        @else
            <p class="alert-info">Tidak ada pengguna yang tersedia untuk ditambahkan. Semua pengguna sudah terdaftar di kursus ini.</p>
        @endif
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <!-- Tabel Pendaftaran -->
    <div class="table-scroll">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama Pengguna</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrations as $registration)
                    <tr>
                        <td>{{ $registration->user->name }}</td>
                        <td>{{ $registration->created_at }}</td>
                        <td>
                            <form action="{{ route('registrations.destroy', [$course, $registration]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini dari kursus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="admin-button danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada pendaftar untuk kursus ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection