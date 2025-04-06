@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <h1 class="page-title">Pesan Kontak</h1>

    <a href="{{ route('admin.dashboard') }}" class="admin-button secondary back-to-dashboard">Kembali</a>
    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <!-- Tabel Pesan -->
    <div class="table-scroll">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Dibuat Pada</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr id="message-{{ $message->id }}">
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($message->message, 50) }}</td>
                        <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                        <td>{{ $message->is_read ? 'Dibaca' : 'Belum Dibaca' }}</td>
                        <td>
                            <div class="button-group">
                                <a href="{{ route('admin.messages.show', $message) }}" >
                                    <button class="admin-button info">Lihat</button></a>
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="ajax-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-button danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada pesan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection