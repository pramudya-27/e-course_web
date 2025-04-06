@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-container">
            <div class="hero-text">
                <h1 class="hero-title">Learn Without Limits</h1>
                <p class="hero-subtitle">Anytime, Anywhere</p>
                <p class="hero-description">Access over 1000+ courses from industry experts. Start learning today and transform your career.</p>
                <a href="{{ route('register') }}" class="hero-button">Get Started</a>
            </div>
            <div class="hero-image">
            <img class="img-full" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80" alt="Students learning">
            </div>
        </div>
    </div>

    <!-- Course List Section -->
    <div class="course-container">
        <h1 class="section-title">Explore our courses</h1>
        @if ($courses->isEmpty())
            <div class="alert-info">
                There are no courses available yet. Please check back later!
            </div>
        @else
            <div class="course-grid">
                @foreach ($courses as $course)
                    <div class="course-card">
                        @if ($course->thumbnail)
                            <img src="{{ asset('storage/' . $course->thumbnail) }}" class="course-image" alt="{{ $course->title }}">
                        @else
                            <img src="https://via.placeholder.com/300x180" class="course-image" alt="Default Image">
                        @endif
                        <div class="course-content">
                            <h5 class="course-title">{{ $course->title }}</h5>
                            <p class="course-description">
                                {{ Str::limit($course->description, 100) }}
                                <a href="#" class="read-more" onclick="event.preventDefault(); this.nextElementSibling.style.display='block'; this.style.display='none';">Baca Selengkapnya</a>
                                <span class="full-description" style="display:none;">{{ $course->description }}</span>
                            </p>
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
                                        <a href="{{ $course->theme_link }}" target="_blank" style="text-decoration: none;"> 
                                            <button type="submit" class="course-button success">Open course </button></a>
                                        <form action="{{ route('courses.unenroll', $course) }}" method="POST" class="mt-2 ajax-form">
                                            @csrf
                                            <button type="submit" class="course-button danger">Unenroll</button>
                                        </form>
                                    @elseif ($purchaseRequest && $purchaseRequest->status === 'approved')
                                        <form action="{{ route('courses.confirm', $course) }}" method="POST" class="ajax-form">
                                            @csrf
                                            <button type="submit" class="course-button primary">Enroll</button>
                                        </form>
                                    @elseif ($purchaseRequest && $purchaseRequest->status === 'pending')
                                        <button class="course-button warning" disabled>Waiting for approval</button>
                                    @elseif ($purchaseRequest && $purchaseRequest->status === 'rejected')
                                        <form action="{{ route('courses.enroll', $course) }}" method="POST" class="ajax-form">
                                            @csrf
                                            <button type="submit" class="course-button primary">Enroll Now</button>
                                        </form>
                                        <span class="error-message small">Request denied</span>
                                    @else
                                        <form action="{{ route('courses.enroll', $course) }}" method="POST" class="ajax-form">
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