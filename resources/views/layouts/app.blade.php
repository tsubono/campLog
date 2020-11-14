<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>キャンログ</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
        $(function () {
            $('.tab-item').click(function () {
                //現在activeが付いているクラスからactiveを外す
                $('.active').removeClass('active');

                //クリックされたタブメニューにactiveクラスを付与。
                $(this).addClass('active');

                //一旦showクラスを外す
                $('.show').removeClass('show');

                //クリックしたタブのインデックス番号取得
                const index = $(this).index();

                //タブのインデックス番号と同じコンテンツにshowクラスをつけて表示する
                $('.tab-content').eq(index).addClass('show');
            });
        });
    </script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <header class="header-image">
        <img src="{{ asset('img/header.jpg') }}">
    </header>
    <div id="app">
        @yield('content')
    </div>
</div>
</body>
</html>
