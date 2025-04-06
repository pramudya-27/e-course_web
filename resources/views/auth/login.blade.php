@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="auth-box">
            <h2 class="auth-title">{{ __('Login') }}</h2>
            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group remember-me-group">
                    <label class="remember-me-label">
                <input type="checkbox" name="remember" class="remember-me-checkbox" {{ old('remember') ? 'checked' : '' }}>
            <span class="remember-me-text">{{ __('Remember Me') }}</span>
                    </label>
                </div>
                <button type="submit" class="auth-button">{{ __('Login') }}</button>
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                @endif
            </form>
        </div>
    </div>
@endsection