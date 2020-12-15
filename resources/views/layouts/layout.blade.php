<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Saeria - @yield('title')</title>
        <link rel="stylesheet" href="{{ asset(mix("css/main.css")) }}">
    </head>
    <body>
        @yield('content')
    <script src="{{ asset(mix("js/app.js")) }}"></script>
    </body>
</html>
