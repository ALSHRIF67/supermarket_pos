<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased text-gray-800 bg-gradient-to-br from-gray-50 to-gray-100 flex flex-col min-h-screen">

    {{-- Header --}}
    <x-header />

    {{-- Main content – centered auth card --}}
    <main class="flex-1 flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </main>

    {{-- Footer --}}
    <x-footer />

    @vite('resources/js/app.js')
</body>
</html>