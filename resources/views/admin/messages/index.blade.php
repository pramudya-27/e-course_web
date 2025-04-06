@extends('layouts.admin')

@section('content')
    <h1>Pesan Kontak</h1>
    <table class="table">
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
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($message->message, 50) }}</td>
                    <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $message->is_read ? 'Dibaca' : 'Belum Dibaca' }}</td>
                    <td>
                        <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-info">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection