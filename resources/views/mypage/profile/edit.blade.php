@extends('layouts.app')

@section('content')
    <section class="profile-edit">
        @include('mypage._tab')
        <div class="content">
            <div class="profile-form">
                <form method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-content">
                        <div class="form-group">
                            <label class="form-label" for="avatar_path">アバター画像</label>
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
                            <label class="form-label" for="handle_name">ハンドルネーム <span class="require">*</span></label>

                            @error('handle_name')
                            <div class="text-error my-5">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="form-check-group">
                            <label class="radio-item form-label">
                                <input type="radio" name="gender" value="{{ \App\Models\User::GENDER_MALE }}"
                                    {{ old('gender', $user->gender) === \App\Models\User::GENDER_MALE ? 'checked' : '' }}>
                                <span>男性</span>
                            </label>
                            <label class="radio-item form-label">
                                <input type="radio" name="gender" value="{{ \App\Models\User::GENDER_FEMALE }}"
                                    {{ old('gender', $user->gender) === \App\Models\User::GENDER_FEMALE ? 'checked' : '' }}>
                                <span>女性</span>
                            </label>
                            <label class="radio-item form-label">
                                <input type="radio" name="gender" value="{{ \App\Models\User::GENDER_OTHER }}"
                                    {{ old('gender', $user->gender) === \App\Models\User::GENDER_OTHER ? 'checked' : '' }}>
                                <span>その他</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <input id="age" type="number"
                                   name="age" value="{{ old('age', $user->age) }}">
                            <label class="form-label" for="age">年齢</label>
                        </div>

                        <div class="form-group">
                            <input id="camp_history" type="number"
                                   name="camp_history" value="{{ old('camp_history', $user->camp_history) }}">
                            <label class="form-label" for="camp_history">キャンプ歴</label>
                        </div>

                        <div class="form-group">
                            <input id="location" type="text"
                                   name="location" value="{{ old('location', $user->location) }}">
                            <label class="form-label" for="location">拠点</label>
                        </div>

                        <div class="form-group">
                            <textarea name="introduction">{{ old('introduction', $user->introduction) }}</textarea>
                            <label class="form-label" for="introduction">自己紹介</label>
                        </div>

                        <div class="form-group">
                            <input id="twitter_url" type="text"
                                   name="twitter_url" value="{{ old('twitter_url', $user->twitter_url) }}">
                            <label class="form-label" for="twitter_url">Twitter</label>
                        </div>

                        <div class="form-group">
                            <input id="instagram_url" type="text"
                                   name="instagram_url" value="{{ old('instagram_url', $user->instagram_url) }}">
                            <label class="form-label" for="instagram_url">Instagram</label>
                        </div>

                        <div class="form-group">
                            <input id="facebook_url" type="text"
                                   name="facebook_url" value="{{ old('facebook_url', $user->facebook_url) }}">
                            <label class="form-label" for="facebook_url">Facebook</label>
                        </div>

                        <div class="form-group">
                            <input id="youtube_url" type="text"
                                   name="youtube_url" value="{{ old('youtube_url', $user->youtube_url) }}">
                            <label class="form-label" for="youtube_url">Youtube</label>
                        </div>

                        <div class="form-group">
                            <input id="blog_url" type="text"
                                   name="blog_url" value="{{ old('blog_url', $user->blog_url) }}">
                            <label class="form-label" for="blog_url">Blog</label>
                        </div>

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
        </div>
    </section>
@endsection
