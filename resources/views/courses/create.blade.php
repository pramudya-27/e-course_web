@extends('layouts.admin')
@section('content')
    <h1>Tambah Kursus</h1>
    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="duration">Duration (minutes)</label>
        <input type="number" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" required>
        @error('duration')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="thumbnail">Thumbnail (Clickbait Image)</label>
        <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" required>
        @error('thumbnail')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="theme_link">Link Tema</label>
        <input type="text" name="theme_link" class="form-control @error('theme_link') is-invalid @enderror" value="{{ old('theme_link') }}">
    @error('theme_link')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <div class="form-group">
    <label for="price">Harga Kursus (Rp)</label>
    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01">
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
</div>
    <button type="submit" class="btn btn-primary">Create Course</button>
</form>
@endsection