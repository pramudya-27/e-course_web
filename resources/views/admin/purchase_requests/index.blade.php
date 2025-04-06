@extends('layouts.admin')

@section('content')
    <h1>Kelola Permintaan</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Pengguna</th>
                <th>Kursus</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->course->title }}</td>
                    <td>{{ $request->status }}</td>
                    <td>
                        @if($request->status !== 'approved')
                            <form action="{{ route('admin.purchase_requests.approve', $request) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Setujui</button>
                            </form>
                        @endif
                        @if($request->status !== 'rejected')
                            <form action="{{ route('admin.purchase_requests.reject', $request) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection