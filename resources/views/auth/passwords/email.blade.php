@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="auth-box">
            <h2 class="auth-title">{{ __('Reset Password') }}</h2>
            @if (session('status'))
                <div class="alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="auth-form">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="auth-button">{{ __('Send Password Reset Link') }}</button>
            </form>
        </div>
    </div>
@endsection