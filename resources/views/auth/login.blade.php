@php
    $isAuth = true;
@endphp

@extends('layouts.app')

@section('content')
    <section>
        <div class="content">
            <div class="login-form">
                <h3 class="head-with-border small">ログイン</h3>

                <a class="twitter-btn mt-40 mb-20" href="{{ route('twitter.auth') }}">
                    <img src="{{ asset('img/icon_twitter_white.svg') }}" />
                    <span>Twitterで認証</span>
                </a>
                <div class="micro-txt">
                    ※許可なく投稿されることはありません。<br>
                </div>

                <p class="or-txt">または</p>

                <form method="POST" action="{{ route('login') }}" >
                    @csrf

                    <div class="form-content">
                        <div class="form-group">
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
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

                        <div class="form-buttons">
                            <button class="btn warning-btn" type="submit">ログイン</button>

                            @if (Route::has('password.request'))
                                <a class="mt-10 link-txt" href="{{ route('password.request') }}">
                                    パスワードを忘れた方はこちら
                                </a>
                            @endif

                            <div class="mb-10">
                                <span class="small-txt">アカウントをお持ちでない方は</span> <br>
                                <a class="link-txt large my-5" href="{{ route('register') }}">
                                    無料新規登録へ
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
