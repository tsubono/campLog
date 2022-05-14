<a href="https://sotolist-magazine.com/camlog-sotolist?utm_source=camlog&utm_medium=banner&utm_campaign=collabo"
   target="_blank"
   class="mypage-banner-area">
    <img src="{{ asset('img/banner/banner1.jpeg') }}" alt="キャンログ×ソトリストコラボキャンペーン">
</a>
<ul class="tab-menu">
    <li class="tab-item type-person {{ request()->is('mypage/profile') ? 'active' : '' }}"
        onclick="location.href='{{ route('mypage.profile.edit') }}'">
      プロフィール設定
    </li>
    <li class="tab-item type-list {{ request()->is('mypage/camp-schedules', 'mypage/camp-schedules/*') ? 'active' : '' }}"
        onclick="location.href='{{ route('mypage.camp-schedules.index') }}'">
        キャンプ記録/予定管理
    </li>
</ul>
<div class="full-menu {{ request()->is('mypage/bookmarks') ? 'active' : '' }}" onclick="location.href='{{ route('mypage.bookmarks.index') }}'">
    <a href="{{ route('mypage.bookmarks.index') }}">
        &nbsp; 保存済み行きたいキャンプ場リスト
    </a>
</div>

@if (session('message'))
    <div class="flash-message">
        {{ session('message') }}
    </div>
@endif
@if (session('verified'))
    <div class="flash-message">
        本登録が完了しました！
    </div>
@endif
@if (session('message-error'))
    <div class="flash-message error">
        {{ session('message-error') }}
    </div>
@endif
@if ($errors->any())
    <div class="flash-message error">
        入力内容を確認してください
    </div>
@endif
