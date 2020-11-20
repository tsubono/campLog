@extends('layouts.app')

@section('content')
    <section>
        <div class="content">
            <div class="login-form">
                <h2>ログイン</h2>

                <div class="flex-right">
                    <a class="auth-btn item" href="{{ route('twitter.auth') }}">
                        <img src="{{ asset('img/icon_twitter.svg') }}" />
                        <span>Twitterで認証</span>
                    </a>
                </div>

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
                            <button class="btn primary-btn" type="submit">ログイン</button>

{{--                            @if (Route::has('password.request'))--}}
{{--                                <a class="btn default-btn my-10" href="{{ route('password.request') }}">--}}
{{--                                    パスワードを忘れた方はこちら--}}
{{--                                </a>--}}
{{--                            @endif--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
