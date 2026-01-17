<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ config('app.name', 'Laravel') }}
        @isset($title)
            - {{ $title }}
        @endisset
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col items-center justify-center p-6">

    <!-- App Name -->
    <header class="absolute top-8 left-8 text-2xl font-bold text-gray-900">
        {{ config('app.name', 'Laravel') }}
    </header>

    <!-- Main Card -->
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-md p-8">
            <!-- Page Header -->
            @yield('header')

            <!-- Page Content -->
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </footer>
    </div>

    @livewireScripts
</body>
</html>
