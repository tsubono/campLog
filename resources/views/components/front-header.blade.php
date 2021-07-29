<header class="front-header-nav">
    <a href="{{ url('/') }}">
        <img class="logo-img" src="{{ asset('img/head-logo.svg') }}" alt="キャンログ" width="auto" height="auto" />
    </a>
    <div class="links">
        <a href="{{ route('register') }}" class="link-txt">新規登録</a>
        <span>/</span>
        <a href="{{ route('mypage.profile.edit') }}" class="link-txt">マイページ</a>
    </div>
</header>