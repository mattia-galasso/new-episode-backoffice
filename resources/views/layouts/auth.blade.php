<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NextEpisode') }} - @yield('title')</title>

    {{-- FAVICON --}}
    <link rel="icon" href="{{ asset('./img/favicon.ico') }}" type="image/ico">

    {{-- VITE --}}
    @vite(['resources/js/app.js'])

</head>

<body data-bs-theme="dark">
    <main class="auth-page">
        <div class="auth-container">

            <a href="{{ url('/') }}" class="auth-logo">

                <img src="{{ asset('./img/logo_nextepisode.png') }}" alt="NextEpisode">

            </a>

            @yield('content')

        </div>
    </main>
</body>

</html>