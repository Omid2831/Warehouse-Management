<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Leverancier')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <main class="container mx-auto px-4 py-8">
        <div class="mb-6 p-2">
            @yield('leverancierInfo')
        </div>

        <div class="mb-2 p-2">
            @yield('t_leverancier')
        </div>
    </main>

</body>

</html>

@stack('leverancier')
