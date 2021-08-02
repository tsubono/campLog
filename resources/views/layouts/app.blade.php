<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ secure_asset('img/logo_favi.ico') }}">
    <link rel="apple-touch-icon" href="{{ secure_asset('img/logo_favi_gray.jpg') }}" sizes="180x180">

    @if (request()->route()->getName() === 'profile.index')
        <title>{{ $user->handle_name }}のキャンプ記録-キャンログ</title>
        <meta name="description" content="{{ $user->introduction }}">
    @else
        <title>キャンログ - キャンプの記録サイト</title>
        <meta name="description" content="日本初のキャンプ記録管理サイト「キャンログ」は、過去のキャンプを記録、未来の予定を管理、現在利用中のSNSリンクひとまとめ、など3つの機能を無料で利用可能！全国4500件のキャンプ場を掲載。HPや住所、電話番号を網羅。新規登録は1分でカンタンに">
    @endif
    <meta name="keywords" content="キャンプ記録,キャンプ,キャンプ予定">
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Scripts -->
    @include('components.js')

    <!-- Styles -->
    <link href="{{ secure_asset('css/loading.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.13.0/css/all.css"
          integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-186172042-1"></script>
    <script>
      window.dataLayer = window.dataLayer || []

      function gtag () {dataLayer.push(arguments)}

      gtag('js', new Date())

      gtag('config', 'UA-186172042-1')
    </script>

    <!-- OGP -->
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="キャンログ"/>
    <meta property="og:description" content="キャンプの記録＆予定管理ツール｢キャンログ｣"/>
    <meta property="og:site_name" content="キャンログ"/>
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ secure_asset('img/ogp-img.jpg') }}"/>
    <meta name="twitter:card" content="summary_large_image"/>

    @if (config('app.env') === 'production')
        <!-- User Heat Tag -->
        <script type="text/javascript">
          (function(add, cla){window['UserHeatTag']=cla;window[cla]=window[cla]||function(){(window[cla].q=window[cla].q||[]).push(arguments)},window[cla].l=1*new Date();var ul=document.createElement('script');var tag = document.getElementsByTagName('script')[0];ul.async=1;ul.src=add;tag.parentNode.insertBefore(ul,tag);})('//uh.nakanohito.jp/uhj2/uh.js', '_uhtracker');_uhtracker({id:'uhsm1bEe9F'});
        </script>
        <!-- End User Heat Tag -->
    @endif
</head>
<body class="{{ $isAuth ?? false ? 'bg-gray' : '' }}">
@if ($isAuth ?? false)
    <div class="container auth-container" id="app">
        @if (session('status'))
            <div class="flash-message">
                {{ session('status') }}
            </div>
        @endif
        <img src="{{ asset('img/head-logo.svg') }}" alt="ロゴ" class="logo-img"/>
        @yield('content')
    </div>
@else
    <div class="container">
        <div id="app">
            @if ($isMypage ?? false)
                @include('components.mypage-header')
            @endif
            @if ($isFront ?? false)
                @include('components.front-header')
            @endif

            @yield('content')
        </div>
        @include('components.footer')
    </div>
@endif

@yield('js')
</body>
</html>
