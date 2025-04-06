@extends('layouts.app')

@section('content')
    <div class="auth-container">
        <div class="auth-box">
            <h2 class="auth-title">{{ __('Verify Your Email Address') }}</h2>
            @if (session('resent'))
                <div class="alert-success">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p>{{ __('If you did not receive the email') }}, <a href="#" onclick="event.preventDefault(); document.getElementById('resend-form').submit();">{{ __('click here to request another') }}</a>.</p>
            <form id="resend-form" method="POST" action="{{ route('verification.resend') }}" class="hidden">
                @csrf
            </form>
        </div>
    </div>
@endsection