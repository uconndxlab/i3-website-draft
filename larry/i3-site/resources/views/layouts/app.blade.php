<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'i3')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/js/app.js')
</head>
<body class="d-flex flex-column min-vh-100">
    <nav>
        <div class="container">
            <div class="d-flex justify-content-center align-items-center py-3">
                <a href="{{ url('/') }}" class="text-decoration-none text-dark">
                    <h1 class="h2">i3</h1>
                </a>

            </div>
        </div>
    </nav>
    <main class="flex-grow-1 py-4">
        @yield('content')
    </main>
</body>
</html>
