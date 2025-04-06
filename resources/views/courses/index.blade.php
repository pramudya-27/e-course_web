@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Manage Courses</h3>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                <th>Thumbnail</th>
                <th>Title</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Created By</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr>
                <td>
                    @if ($course->thumbnail)
                        <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                    <td>{{ $course->title }}</td>
                    <td>{{ Str::limit($course->description, 50) }}</td>
                    <td>{{ $course->duration }} mins</td>
                    <td>{{ $course->user->name }}</td>
                    <td>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection