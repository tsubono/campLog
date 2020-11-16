<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>キャンログ</title>

    <!-- Scripts -->
    @include('components.js')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div id="app">
        @if (empty($isNotHeaderNav))
            @include('components.header-nav')
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>
