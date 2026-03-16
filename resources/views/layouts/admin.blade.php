<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-100 flex flex-col min-h-screen">

    <div class="flex flex-col md:flex-row flex-1">
        <x-sidebar /> <!-- reuse sidebar from previous step -->

        <main class="flex-1 p-4 md:p-6">
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
    
<script>
    (function() {
        // Ensure the script runs after DOM is loaded
        const sidebar = document.getElementById('mobileSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        const openBtn = document.querySelector('.open-sidebar');
        const closeBtn = document.querySelector('.close-sidebar');

        if (!sidebar || !backdrop || !openBtn || !closeBtn) return;

        // Initially hide sidebar on mobile (translate it off‑screen)
        // The `fixed` class keeps it out of the document flow.
        // We'll use `translate-x-full` to hide it (since RTL, full = right side).
        sidebar.classList.add('translate-x-full');

        function openSidebar() {
            sidebar.classList.remove('translate-x-full');
            backdrop.classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // prevent background scroll
        }

        function closeSidebar() {
            sidebar.classList.add('translate-x-full');
            backdrop.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        openBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        backdrop.addEventListener('click', closeSidebar);

        // On window resize above md breakpoint, ensure sidebar is visible and backdrop hidden
        const mediaQuery = window.matchMedia('(min-width: 768px)');
        function handleDesktopChange(e) {
            if (e.matches) {
                // Desktop: remove any transforms and hide backdrop
                sidebar.classList.remove('translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                // Also remove fixed positioning? We already have `md:static` so it becomes static.
            } else {
                // Mobile: reset to hidden state (unless we want to remember state)
                // For simplicity, always hide on mobile when resizing to mobile.
                sidebar.classList.add('translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }
        mediaQuery.addEventListener('change', handleDesktopChange);
        // Initial check
        handleDesktopChange(mediaQuery);
    })();
</script>

</body>

</html>