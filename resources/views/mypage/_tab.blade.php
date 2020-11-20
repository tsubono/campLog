<ul class="tab-menu">
    <li class="tab-item type-person {{ request()->is('mypage/profile') ? 'active' : '' }}"
        onclick="location.href='{{ route('mypage.profile.edit') }}'">
      プロフィール設定
    </li>
    <li class="tab-item type-list {{ request()->is('mypage/camp-schedules', 'mypage/camp-schedules/*') ? 'active' : '' }}"
        onclick="location.href='{{ route('mypage.camp-schedules.index') }}'">
        キャンプ予定管理
    </li>
</ul>

@if (session('message'))
    <div class="flash-message">
        {{ session('message') }}
    </div>
@endif
@if ($errors->any())
    <div class="flash-message error">
        入力内容を確認してください
    </div>
@endif
