<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ secure_asset('img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ secure_asset('img/logo_favi.png') }}" sizes="180x180">

    <title>キャンログ</title>

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
    <meta property="og:image" content="{{ secure_asset('img/ogp-img.jpg') }}"/>
    <meta name="twitter:card" content="summary_large_image"/>
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
