@extends('layouts.admin')

@section('content')
@vite(['resources/css/styles.css', 'resources/js/app.js'])
<div class="admin-container">
    <div class="admin-grid">
        <div class="admin-col">
            <div class="admin-card">
                <div class="card-header">
                    <h3>Dashboard Overview</h3>
                </div>
                <div class="card-body">
                    <p>Total Users: {{ $totalUsers }}</p>
                    <p>Total Courses: {{ $totalCourses }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="admin-grid mt-4">
        <div class="admin-col">
            <div class="admin-card">
                <div class="card-header">
                    <h4>Recent Courses</h4>
                </div>
                <div class="card-body">
                    <div class="table-scroll">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Created By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentCourses as $course)
                                <tr>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->user->name }}</td>
                                    <td>
                                        <a href="{{ route('registrations.index', $course) }}" class="admin-button info">Lihat Pendaftaran</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="button-group">
                        <a href="{{ route('courses.index') }}" class="admin-button primary">Kelola Courses</a>
                        <a href="{{ route('admin.purchase_requests.index') }}" class="admin-button primary">Kelola Permintaan</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-col">
            <div class="admin-card">
                <div class="card-header">
                    <h4>Recent Users</h4>
                </div>
                <div class="card-body">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="button-group">
                        <a href="{{ route('admin.messages.index') }}" class="admin-button primary">Lihat Pesan Kontak</a>
                        <a href="{{ route('users.index') }}" class="admin-button primary">Manage Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection