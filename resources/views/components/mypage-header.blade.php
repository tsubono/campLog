<header class="header-nav">
    <h2>マイページ</h2>
</header>
@if (empty($isAccessCode) && auth()->check())
    <div class="bg-gray py-20">
        <div class="profile-block">
            <img class="avatar-img small" src="{{ auth()->user()->display_avatar_path }}">
            <div class="user-info">
                <p>{{ auth()->user()->handle_name }}</p>
                <a class="btn default-btn" href="{{ route('profile.index', ['userName' => auth()->user()->name]) }}" target="_blank">
                    自分のページを確認
                </a>
            </div>
        </div>
    </div>
@endif

@if (session('error-message'))
    <div class="flash-message error">
        {{ session('error-message') }}
    </div>
@endif
