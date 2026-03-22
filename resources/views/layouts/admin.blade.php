<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-100 flex flex-col min-h-screen" x-data="{ sidebarOpen: false }">

    <div class="flex flex-col md:flex-row flex-1">
        <x-sidebar /> <!-- reuse sidebar from previous step -->

        <main class="flex-1 p-4 md:p-6 w-full max-w-full overflow-x-hidden">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <x-footer />
    @vite('resources/js/app.js')
</body>

</html>