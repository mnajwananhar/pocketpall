<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('PocketPal', 'PocketPal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@nolanlawson/emoji-picker-element@1.0.0/dist/emoji-picker-element.js">
    </script>
</head>

<body class="font-sans antialiased bg-[#181A20]">
    <div class="min-h-screen bg-[#181A20]">
        @include('layouts.navigation')


        <!-- Page Content -->
        <main class="md:ml-64 md:my-15">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
