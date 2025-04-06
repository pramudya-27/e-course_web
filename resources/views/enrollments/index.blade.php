@extends('layouts.app')
@section('content')
    <h1>Daftar Pendaftaran</h1>
    <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Tambah Pendaftaran</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Nama Peserta</th>
                <th>Kursus</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->user->name }}</td>
                    <td>{{ $enrollment->course->name }}</td>
                    <td>
                        <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection