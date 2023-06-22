<!DOCTYPE HTML>
<html lang = "ja">
<head>
  <meta charset = "UTF-8">
  <meta name = "csrf-token" content = "{{ csrf_token()}}">
  <title>@yield('title')</title>

<!-- CSSスタイル -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- <link href="{{ asset('css/list.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('css/tekitou.css') }}" rel="stylesheet">

  <!-- Jsスタイル -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/ajax.js') }}" defer></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        @include('header')
    </header>
    <br>
    <div class="container">
        @yield('content')
    </div>
    <footer class="footer bg-dark  fixed-bottom">
    </footer>
</body>
</html>