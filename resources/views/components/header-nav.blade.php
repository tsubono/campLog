<header class="header-nav">
    <h1>キャンログ</h1>
    <div class="right">
        @if (auth()->check())
            <a class="btn default-btn" href="{{ route('profile.index', ['userName' => auth()->user()->name]) }}" target="_blank">自分のページを確認</a>
            <div class="header-avatar">
                <img class="avatar-img" src="{{ $user->display_avatar_path }}">
            </div>
        @else
            <a class="btn warning-btn" href="{{ route('register') }}">新規登録</a>
            <a class="btn default-btn" href="{{ route('login') }}">ログイン</a>
        @endif
    </div>
</header>
