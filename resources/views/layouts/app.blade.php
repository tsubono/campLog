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
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-186172042-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-186172042-1');
    </script>
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
