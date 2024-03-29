<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- 商品タイトル -->
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/list.css') }}" rel="stylesheet">

    <!-- bootstrap -->
    <!-- <script src="/js/app.js" defer></script> -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- JavaScript -->
    <script src="{{ asset('js/script.js') }}" defer></script>
</head>
<body>
  <head>
    @include('header')
  </head>
@yield('content')
</body>
</html>