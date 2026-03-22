<aside class="fixed md:static inset-y-0 right-0 z-[60] transform transition-transform duration-300 ease-in-out md:transform-none"
       :class="{'translate-x-0': sidebarOpen, 'translate-x-full': !sidebarOpen}"
       aria-label="القائمة الجانبية">
    
    {{-- Sidebar content – always rendered, but hidden off‑screen on mobile --}}
    <div class="bg-white shadow-xl md:shadow-none md:bg-gray-100 w-64 h-full border-l border-gray-200 overflow-y-auto relative z-[61]">
        {{-- Sidebar header / logo --}}
        <div class="p-4 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
            <span class="text-xl font-bold text-blue-600">نقاطي</span>
            {{-- Close button (mobile only) --}}
            <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-red-500 focus:outline-none transition-colors" aria-label="إغلاق القائمة">
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

    {{-- Backdrop (mobile only) – unconditionally removed from DOM when sidebar is closed --}}
    <template x-if="sidebarOpen">
        <div @click="sidebarOpen = false" 
             class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[55] md:hidden" 
             x-transition.opacity>
        </div>
    </template>
</aside>

{{-- Hamburger button (visible only on mobile) --}}
<button @click="sidebarOpen = true" 
        class="fixed top-4 right-4 z-[40] md:hidden bg-blue-600 text-white p-2 rounded-lg shadow-lg focus:outline-none hover:bg-blue-700 transition-colors" 
        aria-label="فتح القائمة">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>
