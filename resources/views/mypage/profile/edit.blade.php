@extends('layouts.app')

@section('content')
    <section class="profile-edit-section">
        @include('mypage._tab')
        <div class="content">
            閲覧: {{ auth()->user()->access_count }}
            <div class="flex-right mx-10 top-content">
                <div class="mx-5">
                    {!! QrCode::generate(route('profile.index', ['userName' => auth()->user()->name])) !!}
                    <p class="qr-note">カメラで撮るとあなたのページが表示されます。</p>
                </div>
                <a href="https://twitter.com/share"
                   target="_blank"
                   rel="nofollow noopener"
                   class="twitter-share-button item mx-10"
                   data-url="{{ route('profile.index', ['userName' => auth()->user()->name]) }}"
                   data-size="large"
                   data-text="名前：{{ auth()->user()->handle_name }}
性別：{{ auth()->user()->gender_txt }}
年齢：{{ auth()->user()->age }}歳
キャンプ歴：{{ auth()->user()->camp_history }}
拠点：{{ auth()->user()->location }}
スタイル：
好き：
テント：

#キャンログ
#キャンプ好きと繋がりたい
#キャンプ好きとして軽く自己紹介
">
                    ツイートする
                </a>
            </div>
            <div class="profile-form">
                <form method="POST">
                    @csrf
                    @method('PUT')

                    @if (!empty($user->twitter_token))
                        <input type="hidden" name="twitter_token" value="{{ $user->twitter_token }}" />
                    @endif

                    <div class="form-content block">
                        <h4 class="form-subhead">基本情報</h4>
                        <div class="form-group">
                            <label class="form-label" for="avatar_path">アイコン画像</label>
                            <drop-image v-bind:name="'avatar_path'" v-bind:path="'{{ old('avatar_path', $user->display_avatar_path) }}'"
                                        v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded/user/avatar'"></drop-image>

                            @error('avatar_path')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <drop-image v-bind:name="'background_path'" v-bind:path="'{{ old('background_path', $user->display_background_path) }}'"
                                        v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded/user/background'"></drop-image>
                            <label class="form-label" for="avatar_path">背景画像</label>

                            @error('background_path')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="name" type="text" class="@error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name', $user->name) }}">
                            <label class="form-label" for="name">ユーザー名 (URLに使用されます) <span class="require">*</span></label>

                            @error('name')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="handle_name" type="text" class="@error('handle_name') is-invalid @enderror"
                                   name="handle_name" value="{{ old('handle_name', $user->handle_name) }}">
                            <label class="form-label" for="handle_name">ニックネーム <span class="require">*</span></label>

                            @error('handle_name')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group form-label-group">
                            <label class="form-label">性別</label>
                        </div>
                        <div class="form-check-group">
                            <label class="radio-item form-label">
                                <input type="radio" name="gender" value="{{ \App\Models\User::GENDER_MALE }}"
                                    {{ old('gender', $user->gender) == \App\Models\User::GENDER_MALE ? 'checked' : '' }}>
                                <span>男性</span>
                            </label>
                            <label class="radio-item form-label">
                                <input type="radio" name="gender" value="{{ \App\Models\User::GENDER_FEMALE }}"
                                    {{ old('gender', $user->gender) == \App\Models\User::GENDER_FEMALE ? 'checked' : '' }}>
                                <span>女性</span>
                            </label>
                            <label class="radio-item form-label">
                                <input type="radio" name="gender" value="{{ \App\Models\User::GENDER_OTHER }}"
                                    {{ old('gender', $user->gender) == \App\Models\User::GENDER_OTHER ? 'checked' : '' }}>
                                <span>その他</span>
                            </label>
                        </div>
                        <div class="form-check-group is-public">
                            <input type="hidden" name="is_public_gender" value="1" />
                            <input id="is_public_gender" type="checkbox" name="is_public_gender" value=""
                                {{ old('is_public_gender', $user->is_public_gender) != 1 ? 'checked' : '' }}/>
                            <label class="form-check-label" for="is_public_gender">非公開にする</label>
                        </div>

                        <div class="form-group">
                            <input id="age" type="number"
                                   name="age" value="{{ old('age', $user->age) }}">
                            <label class="form-label" for="age">年齢</label>
                            <div class="form-check-group is-public">
                                <input type="hidden" name="is_public_age" value="1" />
                                <input id="is_public_age" type="checkbox" name="is_public_age" value=""
                                    {{ old('is_public_age', $user->is_public_age) != 1 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="is_public_age">非公開にする</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="number" name="camp_start_date_y" class="small"
                                   value="{{ old('camp_start_date_y', !empty($user->camp_start_date) ? $user->camp_start_date->format('Y') : null) }}"/>
                            <span class="txt">年</span>
                            <label class="form-label" for="camp_start_date_y">キャンプ開始年</label>
                        </div>
                        <div class="form-group">
                            <input type="number" name="camp_start_date_m" class="small"
                                   value="{{ old('camp_start_date_m', !empty($user->camp_start_date) ? $user->camp_start_date->format('n') : null) }}"/>
                            <span class="txt">月</span>
                            <label class="form-label" for="camp_start_date_m">キャンプ開始月</label>
                            @error('camp_start_date_m')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror

                            <div class="form-check-group is-public">
                                <input type="hidden" name="is_public_camp_history" value="1"/>
                                <input id="is_public_camp_history" type="checkbox" name="is_public_camp_history"
                                       value=""
                                    {{ old('is_public_camp_history', $user->is_public_camp_history) != 1 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="is_public_camp_history">非公開にする</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input id="location" type="text"
                                   name="location" value="{{ old('location', $user->location) }}">
                            <label class="form-label" for="location">拠点</label>
                            <div class="form-check-group is-public">
                                <input type="hidden" name="is_public_location" value="1" />
                                <input id="is_public_location" type="checkbox" name="is_public_location" value=""
                                    {{ old('is_public_location', $user->is_public_location) != 1 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="is_public_location">非公開にする</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea name="introduction">{{ old('introduction', $user->introduction) }}</textarea>
                            <label class="form-label" for="introduction">自己紹介</label>
                            <div class="form-check-group is-public">
                                <input type="hidden" name="is_public_introduction" value="1" />
                                <input id="is_public_introduction" type="checkbox" name="is_public_introduction" value=""
                                    {{ old('is_public_introduction', $user->is_public_introduction) != 1 ? 'checked' : '' }}/>
                                <label class="form-check-label" for="is_public_introduction">非公開にする</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-content block">
                        <h4 class="form-subhead">リンク一覧</h4>
                        <user-links :prop-links="{{ json_encode($user->links) }}"></user-links>
                    </div>

                    <div class="form-content block">
                        <h4 class="form-subhead">認証情報</h4>
                        <div class="form-group">
                            <input id="email" type="text" class="@error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email', $user->email) }}">
                            <label class="form-label" for="email">メールアドレス <span class="require">*</span></label>

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
                            <p class="form-item-note">変更する場合のみ入力してください</p>

                            @error('password')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-buttons">
                            <button class="btn primary-btn" type="submit">更新する</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="flex-right">
                <a class="btn default-btn logout-btn" onclick="document.logoutForm.submit()">ログアウト</a>
                <form action="{{ route('logout') }}" name="logoutForm" method="post">
                    @csrf
                </form>
            </div>
            <a class="profile-delete-link js-profile-delete-link">アカウントを削除する</a>
            <form action="{{ route('mypage.profile.destroy') }}" id="profile-delete-form" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </section>
@endsection
