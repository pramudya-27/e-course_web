@extends('layouts.app')

@section('content')
    <div class="contact-container">
        <h1 class="contact-title">Contact Us</h1>
        <p class="contact-text">If you have any questions, complaints, or would like to purchase the course, please contact us via:</p>
        <ul class="contact-list">
            <li><i class="contact-icon">✉️</i> Email: dio2431058@itpln.ac.id</li>
            <li><i class="contact-icon">📞</i> Telephone: +62 857 7251 6271</li>
            <li><i class="contact-icon">📍</i> Address: Jl. Duri Kosambi, Jakarta, Indonesia</li>
        </ul>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('contact.submit') }}" class="contact-form">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                @error('message')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="contact-button">Kirim</button>
        </form>

        <h2 class="contact-subtitle">Course Purchase Confirmation</h2>
        <p class="contact-text">The course will be locked until your payment is confirmed. Please send proof of payment to email <a href="mailto:support@ecourse.com">dio2431058@itpln.ac.id</a> or call <strong>+62 857 7251 6271</strong>. Once confirmed by the admin, you will get access to the course.</p>
    </div>
@endsection