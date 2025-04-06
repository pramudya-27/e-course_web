@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <div class="admin-card">
        <div class="card-header">
            <h3 class="card-title">Kelola Pengguna</h3>
            <a href="{{ route('users.create') }}" class="admin-button primary">Tambah Pengguna</a>
        </div>
        <div class="card-body">

        <a href="{{ route('admin.dashboard') }}" class="admin-button secondary back-to-dashboard">Kembali</a>
            <!-- Notifikasi -->
            @if (session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <!-- Tabel Pengguna -->
            <div class="table-scroll">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="button-group">
                                        <a href="{{ route('users.edit', $user) }}" >
                                        <button class="admin-button warning">Edit</button>
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="admin-button danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada pengguna ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection