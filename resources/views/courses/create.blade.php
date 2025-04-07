@extends('layouts.admin')

@section('content')
<div class="admin-container">
    <h1 class="page-title">Tambah Kursus</h1>

    <!-- Tombol Kembali ke Dashboard -->
    <a href="{{ route('courses.index') }}" class="admin-button secondary back-to-dashboard">Kembali</a>

    <!-- Notifikasi -->
    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <!-- Form Tambah Kursus -->
    <div class="form-container">
        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-input @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-textarea @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="duration" class="form-label">Durasi (jam)</label>
                <input type="number" name="duration" id="duration" class="form-input @error('duration') is-invalid @enderror" value="{{ old('duration') }}" required>
                @error('duration')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="thumbnail" class="form-label">Thumbnail (Gambar Clickbait)</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-input @error('thumbnail') is-invalid @enderror" required>
                @error('thumbnail')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="theme_link" class="form-label">Link Tema</label>
                <input type="text" name="theme_link" id="theme_link" class="form-input @error('theme_link') is-invalid @enderror" value="{{ old('theme_link') }}">
                @error('theme_link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Harga Kursus (Rp)</label>
                <input type="number" name="price" id="price" class="form-input @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="admin-button primary">Buat Kursus</button>
        </form>
    </div>
</div>
@endsection