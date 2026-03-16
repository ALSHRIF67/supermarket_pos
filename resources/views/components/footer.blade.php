<footer class="bg-gray-900 text-gray-300 py-8 mt-auto">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- About --}}
            <div>
                <h4 class="text-white text-lg font-semibold mb-4">نظام السوبر ماركت</h4>
                <p class="text-gray-400">أفضل حل لإدارة البقالة والسوبر ماركت</p>
            </div>

            {{-- Quick links --}}
            <div>
                <h4 class="text-white text-lg font-semibold mb-4">روابط سريعة</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-blue-400 transition-colors">الرئيسية</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">المميزات</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">الشاشات</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">الفوائد</a></li>
                    <li><a href="#" class="hover:text-blue-400 transition-colors">اتصل بنا</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-white text-lg font-semibold mb-4">معلومات التواصل</h4>
                <ul class="space-y-2">
                    <li>📞 +966 123 456 789</li>
                    <li>✉️ info@supermarket-pos.com</li>
                    <li>📍 الرياض، المملكة العربية السعودية</li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} جميع الحقوق محفوظة لـ برنامج إدارة السوبر ماركت والبقالة
        </div>
    </div>
</footer>