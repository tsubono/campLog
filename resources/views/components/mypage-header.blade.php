<header class="header-nav">
    <h2>マイページ</h2>
</header>
@if (empty($isAccessCode) && auth()->check())
    <div class="bg-gray py-20">
        <div class="mypage-header-content">
            <div class="profile-block">
                <img class="avatar-img small" src="{{ auth()->user()->display_avatar_path }}" alt="アバター画像" width="auto" height="auto" />
                <div class="user-info">
                    <p>{{ auth()->user()->handle_name }}</p>
                    <a class="btn default-btn" href="{{ route('profile.index', ['userName' => auth()->user()->name]) }}" target="_blank">
                        自分のページを確認
                    </a>
                </div>
            </div>
            <div class="form-content h-auto search-box">
                <div class="form-group">
                    <camp-place-select-box-for-search
                            :items="{{ \App\Models\CampPlace::get()->makeHidden(['camp_schedule_reviews']) }}"
                    />
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('error-message'))
    <div class="flash-message error">
        {{ session('error-message') }}
    </div>
@endif
