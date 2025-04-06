@extends('layouts.admin')
@section('content')
    <h1>Edit Kursus</h1>
    <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label>Nama</label>
        <input type="text" name="title" value="{{ $course->title }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" required>{{ $course->description }}</textarea>
    </div>
    <div class="form-group">
        <label>Durasi</label>
        <input type="text" name="duration" value="{{ $course->duration }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Thumbnail Saat Ini</label><br>
        @if ($course->thumbnail)
            <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" style="max-width: 100px;"><br>
        @else
            Tidak ada thumbnail<br>
        @endif
    </div>
    <div class="form-group">
        <label>Upload Thumbnail Baru (Opsional)</label>
        <input type="file" name="thumbnail" class="form-control" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Perbarui</button>
</form>
@endsection