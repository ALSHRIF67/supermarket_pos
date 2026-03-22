<aside class="fixed md:static inset-y-0 right-0 z-[60] transform transition-transform duration-300 ease-in-out md:transform-none"
       :class="{'translate-x-0': sidebarOpen, 'translate-x-full': !sidebarOpen}"
       aria-label="القائمة الجانبية">
    
    <div class="bg-white shadow-xl md:shadow-none md:bg-gray-100 w-64 h-full border-l border-gray-200 overflow-y-auto relative z-[61]">
        <!-- Sidebar header / logo -->
        <div class="p-4 border-b border-gray-200 flex items-center justify-between sticky top-0 bg-white">
            <span class="text-xl font-bold text-blue-600">نقاطي</span>
            <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-red-500 focus:outline-none transition-colors" aria-label="إغلاق القائمة">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="p-4">
            <ul class="space-y-2">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-700' }}">
                        <span>📊</span>
                        <span>لوحة التحكم</span>
                    </a>
                </li>

                <!-- Point of Sale -->
                <li>
                    <a href="{{ route('pos.index') }}" 
                       class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('pos.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-700' }}">
                        <span>🛒</span>
                        <span>نقطة البيع</span>
                    </a>
                </li>

                <!-- Products -->
                <li>
                    <a href="{{ route('products.index') }}" 
                       class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('products.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-700' }}">
                        <span>📦</span>
                        <span>المنتجات</span>
                    </a>
                </li>

                <!-- Categories -->
                <li>
                    <a href="{{ route('categories.index') }}" 
                       class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-700' }}">
                        <span>🏷️</span>
                        <span>التصنيفات</span>
                    </a>
                </li>

                <!-- Suppliers -->
                <li>
                    <a href="{{ route('suppliers.index') }}" 
                       class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('suppliers.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-700' }}">
                        <span>🚚</span>
                        <span>الموردين</span>
                    </a>
                </li>

               

                <!-- Expenses -->
                <li>
                    <a href="{{ route('expenses.index') }}" 
                       class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors {{ request()->routeIs('expenses.*') ? 'bg-blue-100 text-blue-700' : 'text-gray-700 hover:bg-blue-100 hover:text-blue-700' }}">
                        <span>💰</span>
                        <span>المصروفات</span>
                    </a>
                </li>

                <!-- Reports (optional) -->
                {{-- 
                <li>
                    <a href="#" 
                       class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        <span>📈</span>
                        <span>التقارير</span>
                    </a>
                </li>
                --}}

                <!-- Settings (optional) -->
                {{-- 
                <li>
                    <a href="#" 
                       class="flex items-center gap-3 px-4 py-2 text-gray-700 rounded-lg hover:bg-blue-100 hover:text-blue-700 transition-colors">
                        <span>⚙️</span>
                        <span>الإعدادات</span>
                    </a>
                </li>
                --}}
            </ul>
        </nav>
    </div>

    <!-- Backdrop (mobile only) -->
    <template x-if="sidebarOpen">
        <div @click="sidebarOpen = false" 
             class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[55] md:hidden" 
             x-transition.opacity>
        </div>
    </template>
</aside>

<!-- Hamburger button (visible only on mobile) -->
<button @click="sidebarOpen = true" 
        class="fixed top-4 right-4 z-[40] md:hidden bg-blue-600 text-white p-2 rounded-lg shadow-lg focus:outline-none hover:bg-blue-700 transition-colors" 
        aria-label="فتح القائمة">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>