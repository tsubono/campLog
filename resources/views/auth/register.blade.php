@php
    $isNotHeaderNav = true;
@endphp

@extends('layouts.app')

@section('content')
    <section class="top-section">
        <div class="head">
            <img src="{{ asset('img/head-logo.png') }}" alt="ロゴ" />
        </div>
        <div class="top-content">
            <img class="bg-image" src="{{ asset('img/top-content-bg.jpeg') }}" alt="背景画像"/>
            <div class="buttons">
                <a href="#register" class="btn success-btn">無料登録</a>
                <a href="{{ route('login') }}" class="btn primary-btn">ログイン</a>
            </div>
        </div>
        <div class="middle-content">
            <div class="description">
                キャンプの記録をカンタンに管理！ <br>
                宿泊記録やこれからの予定まで<br>
                無料で管理してキャンプライフを楽しもう<br>
            </div>
            <img src="{{ asset('img/merits.png') }}" alt="メリット" />
        </div>
        <div class="bottom-content">
            <div class="head-text">\ あなただけの専用ページを無料作成！ /</div>
            <img src="{{ asset('img/mobile-img.png') }}" alt="スマホ画像" />
        </div>
        <div class="content" id="register">
            <div class="register-form">
                <a class="auth-btn item register-btn" href="{{ route('twitter.auth') }}">
                    <img src="{{ asset('img/icon_twitter.svg') }}" />
                    <span>Twitterで登録</span>
                </a>
                <p class="middle-txt">または</p>
                <p class="middle-txt">メールアドレスで登録</p>
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
                            <label class="form-label" for="password-confirmation">パスワード (確認用)</label>
                        </div>

                        <div class="form-buttons">
                            <button class="btn primary-btn" type="submit">無料登録する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
