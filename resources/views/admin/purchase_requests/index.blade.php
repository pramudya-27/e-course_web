@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <h1 class="page-title">Kelola Permintaan</h1>

    <a href="{{ route('admin.dashboard') }}" class="admin-button secondary back-to-dashboard">Kembali</a>
    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <!-- Tombol Hapus Semua -->
    @if ($requests->isNotEmpty())
        <div class="button-group mb-3">
            <form action="{{ route('admin.purchase_requests.destroyAll') }}" method="POST" class="ajax-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua permintaan?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="admin-button danger">Hapus Semua</button>
            </form>
        </div>
    @endif

    <!-- Tabel Permintaan -->
    <div class="table-scroll">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Pengguna</th>
                    <th>Kursus</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($requests as $request)
                    <tr id="request-{{ $request->id }}">
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->course->title }}</td>
                        <td>{{ ucfirst($request->status) }}</td>
                        <td>
                            <div class="button-group">
                                @if ($request->status !== 'approved')
                                    <form action="{{ route('admin.purchase_requests.approve', $request) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="admin-button success">Setujui</button>
                                    </form>
                                @endif
                                @if ($request->status !== 'rejected')
                                    <form action="{{ route('admin.purchase_requests.reject', $request) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="admin-button danger">Tolak</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.purchase_requests.destroy', $request) }}" method="POST" class="ajax-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permintaan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-button danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada permintaan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection