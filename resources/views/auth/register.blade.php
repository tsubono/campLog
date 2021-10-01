@php
    $isNotHeaderNav = true;
@endphp

@extends('layouts.app')

@section('content')
    <section class="top-section">
        <div class="top-content">
            <img class="bg-image" src="{{ asset('img/top.svg') }}" alt="背景画像" width="auto" height="auto" />
            <div class="buttons">
                <a href="#register" class="btn register-btn">無料登録</a>
                <a href="{{ route('login') }}" class="login-link">ログインはこちら</a>
            </div>
        </div>
        <div class="about-content">
            <h3 class="head-with-border"><span class="accent">A</span>bout</h3>
            <div class="about-text">
                <h1 class="heading">キャンプの記録をカンタンに管理！</h1>
                <h2 class="heading-h2">宿泊記録やこれからの予定まで<br />無料で管理してキャンプライフを楽しもう！</h2>
            </div>
            <img class="about-img" src="{{ asset('img/img-01.svg') }}" alt="About" width="auto" height="auto" />
        </div>

        <div class="camp-places-keyword-form">
            <img class="new-img" src="{{ asset('img/new.svg') }}" alt="new" width="80" height="80" />
            <div class="form-content">
                <div class="form-group">
                    <camp-place-select-box-for-search
                            :items="{{ $campPlaces }}"
                    />
                </div>
            </div>
        </div>

        <a href="https://camplog.in/takeshi" rel="nofollow" target="_blank">
            <img class="sample-img" src="{{ asset('img/img-02.svg') }}" alt="Sample" width="auto" height="auto" />
        </a>

        <div class="link-content">
            <h3 class="head-with-border"><span class="accent">L</span>ink</h3>
            <div class="link-list">
                <a href="https://ryucamp.com/camplog/" target="_blank" rel="nofollow">
                    <img src="{{ asset('img/RYUCAMP.jpg') }}" alt="アイコン" class="icon-img" width="auto" height="auto" />
                </a>
                <a href="https://camp-quests.com/35219/" target="_blank" rel="nofollow">
                    <img src="{{ asset('img/camp-quests.png') }}" alt="アイコン" class="icon-img" width="auto" height="auto" />
                </a>
                <a href="http://slowcamp.net/blog/other/otherwise/camplog" target="_blank" rel="nofollow">
                    <img src="{{ asset('img/attyan.jpg') }}" alt="アイコン" class="icon-img" width="auto" height="auto" />
                </a>
                <a href="https://www.camp-tokyo.org/csp-members/1054/" target="_blank" rel="nofollow">
                    <img src="{{ asset('img/tokyo-camp.png') }}" alt="アイコン" class="icon-img" width="auto" height="auto" />
                </a>
                <a href="https://note.com/camptakeshi/n/nc072f1ee5810" target="_blank" rel="nofollow">
                    <img src="{{ asset('img/note.jpg') }}" alt="アイコン" class="icon-img" width="auto" height="auto" />
                </a>
            </div>
        </div>

        <div class="signup-content" id="register">
            <h3 class="head-with-border"><span class="accent">S</span>ign up</h3>

            <div class="register-form">
                <a class="twitter-btn" href="{{ route('twitter.auth') }}">
                    <img alt="Twitterアイコン" src="{{ asset('img/icon_twitter_white.svg') }}" width="auto" height="auto" />
                    <span>Twitterで登録</span>
                </a>
                <div class="micro-txt">
                    ※許可なく投稿されることはありません。<br>
                    登録することで<a href="{{ route('rules') }}" target="_blank">利用規約</a>に同意したものとします。
                </div>

                <p class="or-txt">または</p>

                <p>メールアドレスで登録</p>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-content">
                        <div class="form-group">
                            <input id="name" type="text" class="@error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" placeholder="半角英数字">
                            <label class="form-label" for="name">ユーザー名 (URLに使用されます)</label>

                            @error('name')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" type="text" class="@error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" placeholder="sample@camplog.in">
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
                            <label class="form-label" for="password">パスワード<span class="small-txt">*半角英数字8文字以上</span></label>

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

                        <div class="term-check">
                            <div class="form-check-group is-public">
                                <input id="agreeCheckbox" type="checkbox" name="term_check" value="1" />
                                <label class="form-check-label" for="agreeCheckbox">
                                    <a href="{{ route('rules') }}" target="_blank">利用規約</a>に同意する
                                </label>
                            </div>
                        </div>

                        <div class="form-buttons">
                            <button class="btn warning-btn disabled" type="submit" id="submitButton" disabled>無料登録する</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    $(function() {
      if ($('.text-error').length !== 0) {
        $("html,body").animate({
          scrollTop : $("#register").offset().top
        }, {
          queue : false
        });
      }
    })
</script>
@endsection

