<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="shortcut icon" href="{{asset('images/front-logo.png')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('inside/login_css/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('inside/login_css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('inside/login_css/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('inside/login_css/css/style.css') }}" rel="stylesheet">
    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
            opacity: .8;
            background-size:200px 120px;
        }
    </style>
</head>
<body class="gray-bg">
    <div id = "myDiv" style="display:none;" class="loader"></div>
    <div id="app">
        @yield('content')
    </div>
    <script src="{{ asset('inside/login_css/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('inside/login_css/js/popper.min.js') }}"></script>
    <script src="{{ asset('inside/login_css/js/bootstrap.js') }}"></script>
    <script type='text/javascript'>
        function show() {
            document.getElementById("myDiv").style.display="block";
        }
    </script>
</body>
</html>