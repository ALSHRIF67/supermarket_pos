<aside class="fixed md:static inset-y-0 right-0 z-50 transform transition-transform duration-300 ease-in-out md:transform-none md:translate-x-0"
       id="mobileSidebar"
       aria-label="القائمة الجانبية">
    
    {{-- Sidebar content – always rendered, but hidden off‑screen on mobile --}}
    <div class="bg-white shadow-md md:shadow-none md:bg-gray-100 w-64 h-full border-l border-gray-200 overflow-y-auto">
        {{-- Sidebar header / logo --}}
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <span class="text-xl font-bold text-blue-600">نقاطي</span>
            {{-- Close button (mobile only) --}}
            <button class="md:hidden text-gray-500 focus:outline-none close-sidebar" aria-label="إغلاق القائمة">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        <span>📊</span>
                        <span>لوحة التحكم</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        <span>🛒</span>
                        <span>المنتجات</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        <span>📦</span>
                        <span>الطلبات</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        <span>📈</span>
                        <span>التقارير</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        <span>⚙️</span>
                        <span>الإعدادات</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    {{-- Backdrop (mobile only) – hidden by default, appears when sidebar is open --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden" id="sidebarBackdrop"></div>
</aside>

{{-- Hamburger button (visible only on mobile) – placed fixed at the edge --}}
<button class="fixed top-4 right-4 z-50 md:hidden bg-blue-600 text-white p-2 rounded-lg shadow-lg focus:outline-none open-sidebar" aria-label="فتح القائمة">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

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

<style>
    /* Ensure the sidebar transitions smoothly */
    #mobileSidebar {
        transition-property: transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    /* On desktop, we don't want any transform */
    @media (min-width: 768px) {
        #mobileSidebar {
            transform: none !important;
        }
    }
</style>