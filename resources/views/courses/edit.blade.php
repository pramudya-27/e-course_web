@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <h1 class="page-title">Edit Kursus</h1>

    <a href="{{ route('courses.index') }}" class="admin-button secondary back-to-dashboard">Kembali</a>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <!-- Form Edit Kursus -->
    <div class="form-container">
        <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-input @error('title') is-invalid @enderror" value="{{ old('title', $course->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-textarea @error('description') is-invalid @enderror" required>{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="duration" class="form-label">Durasi (jam)</label>
                <input type="number" name="duration" id="duration" class="form-input @error('duration') is-invalid @enderror" value="{{ old('duration', $course->duration) }}" required>
                @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Thumbnail Saat Ini</label>
                <div class="thumbnail-preview">
                    @if ($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" class="thumbnail-img">
                    @else
                        Tidak ada thumbnail
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="thumbnail" class="form-label">Upload Thumbnail Baru (Opsional)</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-input @error('thumbnail') is-invalid @enderror" accept="image/*">
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="admin-button primary">Perbarui Kursus</button>
        </form>
    </div>
</div>
@endsection