<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name') }}</title>
    @include('layouts.partials.head')
</head>
<body class="c-app">

@if(auth()->user()->can('master-crud'))
    @include('admin.sidebar')
@else
    @include('layouts.partials.sidebar')
@endif

<div class="c-wrapper c-fixed-components">
    @include('layouts.partials.header', ['pageTitle' => $pageTitle])
    <div class="c-body">
        <main class="c-main bg-gray-200">
            @yield('content')
        </main>
    </div>
</div>
@include('layouts.partials.script')
@yield('script')
</body>
</html>
