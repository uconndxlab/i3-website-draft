<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'i3')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/js/app.js')
</head>
<body>
    @include('layouts.header')
    <div class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1 py-3">
        @yield('content')
    </main>
    </div>
</body>
</html>
