@extends('layouts.admin')

@section('content')
    <h1>Pendaftaran untuk {{ $course->title }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Pengguna</th>
                <th>Tanggal Pendaftaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $registration)
                <tr>
                    <td>{{ $registration->name }}</td>
                    <td>{{ $registration->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection