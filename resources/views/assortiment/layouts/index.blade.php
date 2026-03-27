<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Allergeen')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Boxicons (for <i class="bx ..."> icons used in views) -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Tailwind CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">
    

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>



</body>

</html>

@stack('alert')
