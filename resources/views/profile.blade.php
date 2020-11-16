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
                    @if (!empty($user->gender))性別／{{ $user->gender }}　@endif
                    @if (!empty($user->gender))年齢／{{ $user->age }}　@endif
                    @if (!empty($user->camp_history))キャンプ歴／{{ $user->camp_history }}年　@endif
                    @if (!empty($user->location))拠点／{{ $user->location }}　@endif
                </p>
                <p>
                    {!! nl2br(e($user->introduction)) !!}
                </p>
            </div>
        </div>
    </div>
    <div class="sns-list">
        <div class="sns-wrapper">
            @if (!empty($user->twitter_url))
                <a class="sns-item" href="{{ $user->twitter_url }}">
                    <img src="{{ asset('img/icon_twitter.svg') }}" class="icon">
                    <span>Twitter</span>
                </a>
            @endif
            @if (!empty($user->instagram_url))
                 <a class="sns-item" href="{{ $user->instagram_url }}">
                     <img src="./img/icon_instagram.svg" class="icon">
                     <span>Instagram</span>
                 </a>
            @endif
            @if (!empty($user->facebook_url))
                 <a class="sns-item" href="{{ $user->facebook_url }}">
                     <img src="./img/icon_facebook.svg" class="icon">
                     <span>Facebook</span>
                 </a>
            @endif
            @if (!empty($user->youtube_url))
                 <a class="sns-item" href="{{ $user->youtube_url }}">
                     <img src="./img/icon_youtube.svg" class="icon">
                     <span>Youtube</span>
                 </a>
            @endif
            @if (!empty($user->blog_url))
                 <a class="sns-item" href="{{ $user->blog_url }}">
                     <img src="./img/icon_blog.svg" class="icon">
                     <span>Blog</span>
                 </a>
            @endif
        </div>
    </div>
    <!-- TODO -->
    <div class="summary">
        <div class="summary-wrapper">
            <h2 class="summary-title">2020 ACTIVITY</h2>
            <div class="cards">
                <div class="card long">
                    <div class="card-title">宿泊</div>
                    <div class="card-data">
                        <span>15</span>
                        <span class="unit">泊</span>
                    </div>
                </div>
                <div class="card yellow">
                    <div class="card-title">デイ</div>
                    <div class="card-data">
                        <span>7</span>
                        <span class="unit">回</span>
                    </div>
                </div>
                <div class="card red">
                    <div class="card-title">キャンプ場</div>
                    <div class="card-data">
                        <span>12</span>
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
                        <li class="item">1月<span class="stays">2</span></li>
                        <li class="item">2月<span class="stays">0</span></li>
                        <li class="item">3月<span class="stays">5</span></li>
                        <li class="item">4月<span class="stays">1</span></li>
                        <li class="item">5月<span class="stays">3</span></li>
                        <li class="item">6月<span class="stays">6</span></li>
                        <li class="item">7月<span class="stays">0</span></li>
                        <li class="item">8月<span class="stays">4</span></li>
                        <li class="item">9月<span class="stays">7</span></li>
                        <li class="item">10月<span class="stays">10</span></li>
                        <li class="item">11月<span class="stays">1</span></li>
                        <li class="item">12月<span class="stays">2</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="summary-wrapper">
            <h2 class="summary-title">2020 ACTIVITY</h2>
            <div class="cards">
                <div class="card long">
                    <div class="card-title">宿泊</div>
                    <div class="card-data">
                        <span>27</span>
                        <span class="unit">泊</span>
                    </div>
                </div>
                <div class="card yellow">
                    <div class="card-title">デイ</div>
                    <div class="card-data">
                        <span>8</span>
                        <span class="unit">回</span>
                    </div>
                </div>
                <div class="card red">
                    <div class="card-title">キャンプ場</div>
                    <div class="card-data">
                        <span>16</span>
                        <span class="unit place">箇所</span>
                    </div>
                </div>
                <div class="monthly-list">
                    <div class="list-title camping">
                        <img src="./img/icon_stay.svg" alt="宿泊月別アイコン">
                        <span>宿泊</span>
                        <span>月別</span>
                    </div>
                    <ul class="list">
                        <li class="item">1月<span class="stays">2</span></li>
                        <li class="item">2月<span class="stays">3</span></li>
                        <li class="item">3月<span class="stays">1</span></li>
                        <li class="item">4月<span class="stays">0</span></li>
                        <li class="item">5月<span class="stays">7</span></li>
                        <li class="item">6月<span class="stays">6</span></li>
                        <li class="item">7月<span class="stays">0</span></li>
                        <li class="item">8月<span class="stays">4</span></li>
                        <li class="item">9月<span class="stays">7</span></li>
                        <li class="item">10月<span class="stays">10</span></li>
                        <li class="item">11月<span class="stays">1</span></li>
                        <li class="item">12月<span class="stays">2</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="camp-schedules">
        <ul class="tab-menu">
            <li class="js-tab-item tab-item type-grid active">GRID</li>
            <li class="js-tab-item tab-item type-list">LIST</li>
        </ul>
        <div class="grid-tab-content tab-content show">
            <div class="list">
                <div class="item">
                    <img class="eye-catch" src="./img/grid1.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">12</span>
                        <div class="slash"></div>
                        <span class="day">10</span>
                    </div>
                </div>
                <div class="item">
                    <img class="eye-catch" src="./img/grid2.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">11</span>
                        <div class="slash"></div>
                        <span class="day">6</span>
                    </div>
                </div>
                <div class="item">
                    <img class="eye-catch" src="./img/grid3.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">10</span>
                        <div class="slash"></div>
                        <span class="day">31</span>
                    </div>
                </div>
                <div class="item">
                    <img class="eye-catch" src="./img/grid4.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">&nbsp;9</span>
                        <div class="slash"></div>
                        <span class="day">22</span>
                    </div>
                </div>
                <div class="item">
                    <img class="eye-catch" src="./img/grid5.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">&nbsp;8</span>
                        <div class="slash"></div>
                        <span class="day">10</span>
                    </div>
                </div>
                <div class="item">
                    <img class="eye-catch" src="./img/grid1.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">&nbsp;8</span>
                        <div class="slash"></div>
                        <span class="day">8</span>
                    </div>
                </div>
                <div class="item">
                    <img class="eye-catch" src="./img/grid2.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">&nbsp;7</span>
                        <div class="slash"></div>
                        <span class="day">10</span>
                    </div>
                </div>
                <div class="item">
                    <img class="eye-catch" src="./img/grid3.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">&nbsp;7</span>
                        <div class="slash"></div>
                        <span class="day">3</span>
                    </div>
                </div>
                <div class="item">
                    <img class="eye-catch" src="./img/grid4.jpg" alt="アイキャッチ画像" />
                    <div class="date">
                        <span class="month">&nbsp;6</span>
                        <div class="slash"></div>
                        <span class="day">2</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-tab-content tab-content">
            <ul class="list">
                <li class="item">
                    <p class="date">2020.12.10</p>
                    <p class="title">タイトルが入りますタイトルが入りますタイトルが入りますタイトルが入ります</p>
                </li>
                <li class="item">
                    <p class="date">2020.12.10</p>
                    <p class="title">タイトルが入りますタイトルが入りますタイトルが入りますタイトルが入ります</p>
                </li>
                <li class="item">
                    <p class="date">2020.12.10</p>
                    <p class="title">タイトルが入りますタイトルが入ります</p>
                </li>
                <li class="item">
                    <p class="date">2020.12.10</p>
                    <p class="title">タイトルが入りますタイトルが入りますタイトルが入ります</p>
                </li>
                <li class="item">
                    <p class="date">2020.12.10</p>
                    <p class="title">タイトルが入りますタイトルが入ります</p>
                </li>
                <li class="item">
                    <p class="date">2020.12.10</p>
                    <p class="title">タイトルが入りますタイトルが入ります</p>
                </li>
                <li class="item">
                    <p class="date">2020.12.10</p>
                    <p class="title">タイトルが入りますタイトルが入ります</p>
                </li>
            </ul>
        </div>
    </div>
</section>
@endsection
