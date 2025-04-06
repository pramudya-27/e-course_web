@extends('layouts.app')

@section('content')
    <div class="search-container">
        <h1 class="search-title">Hasil Pencarian: "{{ $query ?? 'Semua Kursus' }}"</h1>
        @if ($courses->isEmpty())
            <div class="alert-info">
                Tidak ada kursus yang ditemukan untuk pencarian "{{ $query }}".
            </div>
        @else
            <div class="course-grid">
                @foreach ($courses as $course)
                    <div class="course-card">
                        @if ($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="course-image" alt="{{ $course->title }}">
                        @else
                            <img src="https://via.placeholder.com/300x150" class="course-image" alt="Default Image">
                        @endif
                        <div class="course-content">
                            <h5 class="course-title">{{ $course->title }}</h5>
                            <p class="course-description">
                                {{ Str::limit($course->description, 100) }}
                                <a href="#" class="read-more" onclick="event.preventDefault(); this.nextElementSibling.style.display='block'; this.style.display='none';">Baca Selengkapnya</a>
                                <span class="full-description" style="display:none;">{{ $course->description }}</span>
                            </p>
                            <p class="course-duration">Duration: {{ $course->duration }} minutes</p>
                            <div class="course-rating">
                                <span class="rating-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($course->averageRating()))
                                            ★
                                        @elseif ($i - 0.5 <= $course->averageRating())
                                            ☆
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </span>
                                <span class="rating-text">({{ number_format($course->averageRating(), 1) }} - {{ $course->ratings()->count() }} student)</span>
                            </div>
                            <div class="course-actions">
                                @auth
                                    @php
                                        $purchaseRequest = \App\Models\PurchaseRequest::where('user_id', auth()->id())
                                            ->where('course_id', $course->id)
                                            ->first();
                                        $isEnrolled = DB::table('registrations')
                                            ->where('user_id', auth()->id())
                                            ->where('course_id', $course->id)
                                            ->exists();
                                    // Jika purchase request ditolak, hapus setelah ditampilkan
                                    if ($purchaseRequest && $purchaseRequest->status === 'rejected') {
                                            $purchaseRequest->delete();
                                        }
                                    @endphp
                                    @if ($isEnrolled)
                                        <a href="{{ $course->theme_link }}" class="course-button success" target="_blank">Open course</a>
                                        <form action="{{ route('courses.unenroll', $course) }}" method="POST" class="mt-2">
                                            @csrf
                                            <button type="submit" class="course-button danger">Unenroll</button>
                                        </form>
                                    @elseif ($purchaseRequest && $purchaseRequest->status === 'approved')
                                        <form action="{{ route('courses.confirm', $course) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="course-button primary">Enroll</button>
                                        </form>
                                    @elseif ($purchaseRequest && $purchaseRequest->status === 'pending')
                                        <button class="course-button warning" disabled>Waiting for approval</button>
                                    @elseif ($purchaseRequest && $purchaseRequest->status === 'rejected')
                                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="course-button primary">Enroll Now</button>
                                        </form>
                                        <span class="error-message small">Request denied</span>
                                    @else
                                        <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="course-button primary">Enroll Now</button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="course-button primary">Login to Enroll</a>
                                @endauth
                            </div>
                            <p class="course-price">Price: Rp {{ number_format($course->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection