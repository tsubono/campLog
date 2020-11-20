@php
    $isNotHeaderNav = true;
@endphp

@extends('layouts.app')

@section('content')
<section>
    <header class="header-image">
        <img src="{{ $user->display_background_path }}">
    </header>
    <div class="profile">
        <div class="avatar">
            <img class="avatar-img" src="{{ $user->display_avatar_path }}">
        </div>
        <div class="text">
            <h2 class="name">{{ $user->handle_name }}</h2>
            <div class="self-introduction">
                <p>
                    @if (!empty($user->gender) && $user->is_public_gender)性別／{{ $user->gender }}　@endif
                    @if (!empty($user->age) && $user->is_public_age)年齢／{{ $user->age }}　@endif
                    @if (!empty($user->camp_history) && $user->is_public_camp_history)キャンプ歴／{{ $user->camp_history }}年　@endif
                    @if (!empty($user->location) && $user->is_public_location)拠点／{{ $user->location }}　@endif
                </p>
                @if ($user->is_public_introduction)
                    <br>
                    <p>
                        {!! nl2br(e($user->introduction)) !!}
                    </p>
                @endif
            </div>
        </div>
    </div>
    @if (
    !empty($user->twitter_url) && $user->is_public_twitter_url &&
    !empty($user->instagram_url) && $user->is_public_instagram_url &&
    !empty($user->facebook_url) && $user->is_public_facebook_url &&
    !empty($user->youtube_url) && $user->is_public_youtube_url &&
    !empty($user->blog_url) && $user->is_public_blog_url
    )
        <div class="sns-list">
            <div class="sns-wrapper">
                @if (!empty($user->twitter_url) && $user->is_public_twitter_url)
                    <a class="sns-item" href="{{ $user->twitter_url }}" target="_blank" rel="noopener">
                        <img src="{{ asset('img/icon_twitter.svg') }}" class="icon">
                        <span>Twitter</span>
                    </a>
                @endif
                @if (!empty($user->instagram_url) && $user->is_public_instagram_url)
                     <a class="sns-item" href="{{ $user->instagram_url }}" target="_blank" rel="noopener">
                         <img src="./img/icon_instagram.svg" class="icon">
                         <span>Instagram</span>
                     </a>
                @endif
                @if (!empty($user->facebook_url) && $user->is_public_facebook_url)
                     <a class="sns-item" href="{{ $user->facebook_url }}" target="_blank" rel="noopener">
                         <img src="./img/icon_facebook.svg" class="icon">
                         <span>Facebook</span>
                     </a>
                @endif
                @if (!empty($user->youtube_url) && $user->is_public_youtube_url)
                     <a class="sns-item" href="{{ $user->youtube_url }}" target="_blank" rel="noopener">
                         <img src="./img/icon_youtube.svg" class="icon">
                         <span>Youtube</span>
                     </a>
                @endif
                @if (!empty($user->blog_url) && $user->is_public_blog_url)
                     <a class="sns-item" href="{{ $user->blog_url }}" target="_blank" rel="noopener">
                         <img src="./img/icon_blog.svg" class="icon">
                         <span>Blog</span>
                     </a>
                @endif
            </div>
        </div>
    @endif
    <div class="summary">
        @foreach ($user->summary as $year => $summaryData)
            <div class="summary-wrapper">
                <h2 class="summary-title">{{ $year }} ACTIVITY</h2>
                <div class="cards">
                    <div class="card long">
                        <div class="card-title">宿泊</div>
                        <div class="card-data">
                            <span>{{ $summaryData['stayCount'] }}</span>
                            <span class="unit">泊</span>
                        </div>
                    </div>
                    <div class="card yellow">
                        <div class="card-title">デイ</div>
                        <div class="card-data">
                            <span>{{ $summaryData['dayCount'] }}</span>
                            <span class="unit">回</span>
                        </div>
                    </div>
                    <div class="card red">
                        <div class="card-title">キャンプ場</div>
                        <div class="card-data">
                            <span>{{ $summaryData['campPlaceCount'] }}</span>
                            <span class="unit place">
                <span>箇</span>
                <span>所</span>
              </span>
                        </div>
                    </div>
                    <div class="monthly-list">
                        <div class="list-title camping">
                            <img src="./img/icon_stay.svg" alt="宿泊月別アイコン">
                            <span>宿泊</span>
                            <span>月別</span>
                        </div>
                        <ul class="list">
                            @foreach ($summaryData['stayCountByMonth'] as $month => $stayCount)
                                <li class="item">{{ $month }}月<span class="stays">{{ $stayCount }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="camp-schedules">
        <ul class="tab-menu">
            <li class="js-tab-item tab-item type-grid active">GRID</li>
            <li class="js-tab-item tab-item type-list">LIST</li>
        </ul>
        <div class="grid-tab-content tab-content show">
            <div class="list">
                @foreach ($user->campSchedulesDesc as $campSchedule)
                    <div class="item">
                        <img class="eye-catch" src="{{ $campSchedule->eye_catch_image_path }}" alt="アイキャッチ画像" />
                        <div class="date">
                            <span class="month">{{ $campSchedule->date->format('m') }}</span>
                            <div class="slash"></div>
                            <span class="day">{{ $campSchedule->date->format('d') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="list-tab-content tab-content">
            <ul class="list">
                @foreach ($user->campSchedulesDesc as $campSchedule)
                    <li class="item">
                        <p class="date">{{ $campSchedule->date->format('Y-m-d') }}</p>
                        <p class="title">{{ $campSchedule->place->name }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endsection
