<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name') }}</title>
    @include('layouts.partials.head')
</head>
<body class="c-app">
@include('layouts.partials.sidebar')

<div class="c-wrapper c-fixed-components">
    @include('layouts.partials.header')
    <div class="c-body">
        <main class="c-main">
            @yield('content')
        </main>
        @include('layouts.partials.footer')
    </div>
</div>
@include('layouts.partials.script')
</body>
</html>
