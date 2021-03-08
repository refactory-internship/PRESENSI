<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name') }}</title>
    @include('layouts.partials.head')
</head>
<body class="c-app flex-row align-items-center">
@yield('content')
@include('layouts.partials.script')
</body>
</html>
