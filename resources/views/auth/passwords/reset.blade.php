@php
    $isAuth = true;
@endphp

@extends('layouts.app')

@section('content')
    <section>
        <div class="content">
            <div class="login-form">
                <h3 class="head-with-border small">パスワード再設定</h3>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-content">
                        <div class="form-group">
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                                   value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
                            <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>

                            @error('email')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password">
                            <label class="form-label" for="password">{{ __('Password') }}</label>

                            @error('password')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" name="password_confirmation" autocomplete="new-password">
                            <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>

                            @error('password')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-buttons">
                            <button class="btn primary-btn" type="submit">パスワード再設定</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
