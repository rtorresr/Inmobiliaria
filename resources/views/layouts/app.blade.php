<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ config('app.logo', '/img/logo.png') }}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('includes.menu')


        <main class="pb-4">
            <div class="navbar bg-white font-weight-bold mb-4">
                <span class="navbar-brand">
                    @yield('pageName')
                </span>
            </div>
            @yield('content')
        </main>
    </div>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="application/javascript"></script>
    <script src="{{ asset('js/main.js') }}" type="application/javascript"></script>
    @yield('script')
</body>
</html>
