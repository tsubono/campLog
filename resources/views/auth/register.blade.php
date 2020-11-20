@extends('layouts.app')

@section('content')
    <section>
        <div class="content">
            <div class="register-form">
                <h2>新規登録</h2>

                <div class="flex-right">
                    <a class="auth-btn item" href="{{ route('twitter.auth') }}">
                        <img src="{{ asset('img/icon_twitter.svg') }}" />
                        <span>Twitterで登録</span>
                    </a>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-content">
                        <div class="form-group">
                            <input id="name" type="text" class="@error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}">
                            <label class="form-label" for="name">ユーザー名 (URLに使用されます)</label>

                            @error('name')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" type="text" class="@error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}">
                            <label class="form-label" for="email">メールアドレス</label>

                            @error('email')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="@error('password') is-invalid @enderror"
                                   name="password">
                            <label class="form-label" for="password">パスワード</label>

                            @error('password')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-confirmation" type="password"
                                   name="password_confirmation">
                            <label for="password-confirmation">パスワード (確認用)</label>
                        </div>

                        <div class="form-buttons">
                            <button class="btn primary-btn" type="submit">登録する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
