<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body>
    <div id="app">
        @include('partials.navbar')

        <main class="items-center py-4 d-flex flex-column justify-content-center " style="min-height: 100vh;">
            @yield('content')
        </main>
    </div>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
