<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'i3')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/js/app.js')
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        @yield('content')
    </main>
</body>
</html>
