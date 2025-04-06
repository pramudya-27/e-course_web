@extends('layouts.admin')

@section('content')
    <h1>Detail Pesan</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $message->name }}</p>
            <p><strong>Email:</strong> {{ $message->email }}</p>
            <p><strong>Pesan:</strong> {{ $message->message }}</p>
            <p><strong>Dikirim Pada:</strong> {{ $message->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary mt-3">Kembali</a>
@endsection