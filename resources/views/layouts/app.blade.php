<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MarketPlace') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @include('scripts.app')
</head>
<body>
    <div id="app">

        @include('layouts.partials._navigation')

        @yield('content')
    </div>

    <!-- Scripts -->
    @stack('beforeScripts')
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('afterScripts')
</body>
</html>
