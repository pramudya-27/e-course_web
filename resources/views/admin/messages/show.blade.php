@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <h1 class="page-title">Detail Pesan</h1>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <!-- Detail Pesan -->
    <div class="admin-card">
        <div class="card-body">
            <div class="detail-item">
                <strong>Nama:</strong> {{ $message->name }}
            </div>
            <div class="detail-item">
                <strong>Email:</strong> {{ $message->email }}
            </div>
            <div class="detail-item">
                <strong>Pesan:</strong> {{ $message->message }}
            </div>
            <div class="detail-item">
                <strong>Dikirim Pada:</strong> {{ $message->created_at->format('d M Y H:i') }}
            </div>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <a href="{{ route('admin.messages.index') }}" class="admin-button secondary">Kembali</a>
</div>
@endsection