@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="auth-box">
            <h2 class="auth-title">{{ __('Confirm Password') }}</h2>
            <p>{{ __('Please confirm your password before continuing.') }}</p>
            <form method="POST" action="{{ route('password.confirm') }}" class="auth-form">
                @csrf
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="auth-button">{{ __('Confirm Password') }}</button>
                @if (Route::has('password.request'))
                    <a class="auth-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                @endif
            </form>
        </div>
    </div>
@endsection