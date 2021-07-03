@php
    $isAuth = true;
@endphp

@extends('layouts.app')

@section('content')
    <section>
        <div class="content">
            <div class="login-form">
                <a href="{{ route('login') }}" class="arrow-link">
                    <img src="{{ asset('img/icon-03.svg') }}" alt="矢印" />
                </a>

                <h3 class="head-with-border small">パスワード再設定</h3>

                <p class="mt-30 small-txt">
                    パスワード再設定用のメールアドレスを<br>
                    入力してください。
                </p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-content">
                        <div class="form-group">
                            <input id="email" type="text" class="@error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" autocomplete="email" autofocus>
                            <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>

                            @error('email')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-buttons">
                            <button class="btn warning-btn" type="submit">再設定メール送信</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    </div>
@endsection
