<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NewEpisode') }} - @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('./img/favicon.ico') }}" type="image/ico">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body data-bs-theme='dark'>
    <div id="app">
        <div class="global-container">

            {{-- SIDEBAR --}}
            @include('partials.sidebar')

            <div class="middle-container">
                {{-- NAVBAR --}}
                @include('partials.navbar')
                
                {{-- MAIN CONTENT --}}
                <main class="content_container card p-3">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>

</html>