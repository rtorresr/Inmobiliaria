<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel')}}</title>
        <link rel="icon" href="{{ config('app.logo', '/img/logo.png') }}" type="image/x-icon">

        {{-- styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/web.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('includes.web.header')

        <main>
            @yield('content')
        </main>

        @include('includes.web.footer')

        {{-- scripts --}}
        <script src="{{ asset('js/app.js') }}" type="application/javascript"></script>
        <script src="{{ asset('js/web.js') }}" type="application/javascript"></script>
        @yield('script')
    </body>
</html>
