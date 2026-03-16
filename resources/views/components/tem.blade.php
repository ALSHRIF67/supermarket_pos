<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة السوبر ماركت والبقالة</title>
    <!-- Tailwind CSS local file -->
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased text-gray-800 bg-white">

    {{-- Sidebar component --}}
        <x-header />

    {{-- Footer component --}}
    <x-footer />

    {{-- Optional JS --}}
    @vite('resources/js/app.js')


    <!-- Optional JS (leave as is) -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>