@extends('layouts.app')

@section('content')
<section>
    <div class="profile">
        <div class="avatar">
            <img src="{{ asset('img/avatar.png') }}">
        </div>
        <div class="text">
            <h2 class="name">田中　太郎</h2>
            <div class="self-introduction">
                <p>性別／男♂　年齢／24歳　キャンプ歴／3年　拠点／埼玉　車／Jeep チェロキー(リバティ)　テント／パンダtc／ケシュアワンタッチテント　スタイル／基本ソロ</p>
                <p>テキスト</p>
            </div>
        </div>
    </div>
    <div class="sns-list">
        <div class="sns-wrapper">
            <a class="sns-item" href="#">
                <img src="{{ asset('img/icon_twitter.svg') }}" class="icon">
                <span>Twitter</span>
            </a>
            <a class="sns-item" href="#"><img src="./img/icon_instagram.svg" class="icon">
                <span>Instagram</span>
            </a>
            <a class="sns-item" href="#"><img src="./img/icon_facebook.svg" class="icon">
                <span>Facebook</span>
            </a>
            <a class="sns-item" href="#"><img src="./img/icon_youtube.svg" class="icon">
                <span>Youtube</span>
            </a>
            <a class="sns-item" href="#"><img src="./img/icon_blog.svg" class="icon">
                <span>Blog</span>
            </a>
        </div>
    </div>
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
    <div class="tab">
        <ul class="tab-menu">
            <li class="tab-item type-grid active">GRID</li>
            <li class="tab-item type-list ">LIST</li>
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
