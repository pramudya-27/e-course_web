@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <div class="admin-header">
        <h3 class="page-title">Kelola Kursus</h3>
        <a href="{{ route('courses.create') }}" class="admin-button primary">Tambah Kursus</a>
    </div>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <!-- Tabel Kursus -->
    <div class="table-scroll">
        <table class="admin-table course-table">
            <thead>
                <tr>
                    <th class="thumbnail-col">Thumbnail</th>
                    <th class="title-col">Judul</th>
                    <th class="description-col">Deskripsi</th>
                    <th class="duration-col">Durasi</th>
                    <th class="created-by-col">Dibuat Oleh</th>
                    <th class="action-col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($courses as $course)
                    <tr class="table-row">
                        <td class="thumbnail-col">
                            @if ($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="thumbnail-img">
                            @else
                                Tidak Ada Gambar
                            @endif
                        </td>
                        <td class="title-col">{{ $course->title }}</td>
                        <td class="description-col">{{ Str::limit($course->description, 30) }}</td>
                        <td class="duration-col">{{ $course->duration }} menit</td>
                        <td class="created-by-col">{{ $course->user->name }}</td>
                        <td class="action-col">
                            <div class="button-group">
                                <a href="{{ route('courses.edit', $course) }}" >
                                    <button class="admin-button warning">Edit</button>
                                </a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="admin-button danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada kursus ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection