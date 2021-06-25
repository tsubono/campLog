<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ secure_asset('img/favicon.ico') }}">

    <title>キャンログ</title>

    <!-- Scripts -->
    @include('components.js')

    <!-- Styles -->
    <link href="{{ secure_asset('css/loading.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-186172042-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-186172042-1');
    </script>

    <!-- OGP -->
    @if (auth()->check())
        <meta property="og:url" content="{{ route('profile.index', ['userName' => auth()->user()->name]) }}" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="キャンログ" />
        <meta property="og:description" content="キャンプの記録＆予定管理ツール｢キャンログ｣" />
        <meta property="og:site_name" content="キャンログ" />
        <meta property="og:image" content="{{ secure_asset('img/ogp-img.jpg') }}" />
    @endif
</head>
<body>
<div class="container">
    <div id="app">
        @if (empty($isNotHeaderNav))
            @include('components.header-nav')
        @endif
        @if (!empty($isPageHeaderNav))
            @include('components.header-nav-page')
        @endif
        @yield('content')
    </div>
    @include('components.footer')
</div>

@yield('js')
</body>
</html>
