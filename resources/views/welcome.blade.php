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

    <!-- Hero Section -->
    <section id="hero" class="bg-gradient-to-br from-gray-50 to-gray-100 py-20 md:py-28">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold leading-tight text-gray-900 mb-4">
                برنامج إدارة السوبر ماركت والبقالة
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto mb-8">
                نظام متكامل لنقاط البيع، إدارة المخزون، الحسابات، والتقارير – واجهة سهلة وسريعة تدعم الباركود والفروع المتعددة.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="px-8 py-3 bg-blue-600 text-white rounded-full font-semibold shadow-md hover:bg-blue-700 hover:shadow-lg transform hover:-translate-y-1 transition-all">تجربة النظام</a>
                <a href="#" class="px-8 py-3 border-2 border-blue-600 text-blue-600 rounded-full font-semibold hover:bg-blue-600 hover:text-white transition-colors">طلب عرض توضيحي</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12 relative pb-4 after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:w-24 after:h-1 after:bg-gradient-to-l from-blue-600 to-emerald-500 after:rounded-full">
                مميزات النظام
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow p-6 text-center border border-gray-100 hover:border-blue-200">
                    <div class="text-5xl mb-4 bg-blue-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-blue-600">⚡</div>
                    <h3 class="text-xl font-semibold mb-2">نظام كاشير سريع</h3>
                    <p class="text-gray-600">معالجة فورية للمبيعات بدقة وسرعة</p>
                </div>
                <!-- Feature Card 2 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow p-6 text-center border border-gray-100 hover:border-blue-200">
                    <div class="text-5xl mb-4 bg-emerald-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-emerald-600">📦</div>
                    <h3 class="text-xl font-semibold mb-2">إدارة المخزون بالباركود</h3>
                    <p class="text-gray-600">مسح ضوئي وتحديث آلي للمخزون</p>
                </div>
                <!-- Feature Card 3 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow p-6 text-center border border-gray-100 hover:border-blue-200">
                    <div class="text-5xl mb-4 bg-blue-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-blue-600">📊</div>
                    <h3 class="text-xl font-semibold mb-2">تقارير أكثر من 250 تقرير</h3>
                    <p class="text-gray-600">تحليل متقدم للأداء والمبيعات</p>
                </div>
                <!-- Feature Card 4 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow p-6 text-center border border-gray-100 hover:border-blue-200">
                    <div class="text-5xl mb-4 bg-emerald-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-emerald-600">🔗</div>
                    <h3 class="text-xl font-semibold mb-2">ربط الفروع</h3>
                    <p class="text-gray-600">مركزية البيانات بين جميع الفروع</p>
                </div>
                <!-- Feature Card 5 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow p-6 text-center border border-gray-100 hover:border-blue-200">
                    <div class="text-5xl mb-4 bg-blue-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-blue-600">👥</div>
                    <h3 class="text-xl font-semibold mb-2">إدارة الموظفين والصلاحيات</h3>
                    <p class="text-gray-600">تحكم كامل بصلاحيات المستخدمين</p>
                </div>
                <!-- Feature Card 6 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-shadow p-6 text-center border border-gray-100 hover:border-blue-200">
                    <div class="text-5xl mb-4 bg-emerald-50 w-20 h-20 mx-auto rounded-full flex items-center justify-center text-emerald-600">💰</div>
                    <h3 class="text-xl font-semibold mb-2">إدارة الحسابات والموردين والعملاء</h3>
                    <p class="text-gray-600">متابعة الذمم والفواتير بدقة</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Screens Section -->
    <section id="screens" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12 relative pb-4 after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:w-24 after:h-1 after:bg-gradient-to-l from-blue-600 to-emerald-500 after:rounded-full">
                شاشات النظام
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Screen Card 1 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">
                    <div class="bg-gray-200 p-3 flex gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    </div>
                    <div class="p-8 text-center font-semibold text-gray-700 bg-white min-h-[160px] flex items-center justify-center text-lg">شاشة الكاشير</div>
                </div>
                <!-- Screen Card 2 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">
                    <div class="bg-gray-200 p-3 flex gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    </div>
                    <div class="p-8 text-center font-semibold text-gray-700 bg-white min-h-[160px] flex items-center justify-center text-lg">شاشة إدارة المخزون</div>
                </div>
                <!-- Screen Card 3 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">
                    <div class="bg-gray-200 p-3 flex gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    </div>
                    <div class="p-8 text-center font-semibold text-gray-700 bg-white min-h-[160px] flex items-center justify-center text-lg">شاشة التقارير</div>
                </div>
                <!-- Screen Card 4 -->
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition overflow-hidden">
                    <div class="bg-gray-200 p-3 flex gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    </div>
                    <div class="p-8 text-center font-semibold text-gray-700 bg-white min-h-[160px] flex items-center justify-center text-lg">شاشة الحسابات</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12 relative pb-4 after:content-[''] after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:w-24 after:h-1 after:bg-gradient-to-l from-blue-600 to-emerald-500 after:rounded-full">
                لماذا تختار نظامنا؟
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Benefit 1 -->
                <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-blue-600 hover:text-white transition-colors group border border-gray-100">
                    <div class="text-4xl mb-4 text-blue-600 group-hover:text-white">✅</div>
                    <h3 class="text-xl font-semibold mb-2">تقليل الأخطاء</h3>
                    <p class="text-gray-600 group-hover:text-white">بفضل التكامل بين الكاشير والمخزون</p>
                </div>
                <!-- Benefit 2 -->
                <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-emerald-600 hover:text-white transition-colors group border border-gray-100">
                    <div class="text-4xl mb-4 text-emerald-600 group-hover:text-white">📈</div>
                    <h3 class="text-xl font-semibold mb-2">متابعة الأرباح</h3>
                    <p class="text-gray-600 group-hover:text-white">تقارير دقيقة لحظياً</p>
                </div>
                <!-- Benefit 3 -->
                <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-blue-600 hover:text-white transition-colors group border border-gray-100">
                    <div class="text-4xl mb-4 text-blue-600 group-hover:text-white">🗂️</div>
                    <h3 class="text-xl font-semibold mb-2">إدارة المخزون بسهولة</h3>
                    <p class="text-gray-600 group-hover:text-white">تنبيهات عند نفاد الكمية</p>
                </div>
                <!-- Benefit 4 -->
                <div class="bg-gray-50 rounded-2xl p-8 text-center hover:bg-emerald-600 hover:text-white transition-colors group border border-gray-100">
                    <div class="text-4xl mb-4 text-emerald-600 group-hover:text-white">⏱️</div>
                    <h3 class="text-xl font-semibold mb-2">تسريع عملية البيع</h3>
                    <p class="text-gray-600 group-hover:text-white">واجهة كاشير سريعة الاستجابة</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="cta" class="py-20 bg-gradient-to-l from-blue-600 to-emerald-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-5xl font-extrabold mb-4">ابدأ الآن في تطوير متجرك</h2>
            <p class="text-xl md:text-2xl opacity-90 mb-8">احصل على نظام متكامل يدعم نمو أعمالك</p>
            <a href="#" class="inline-block px-10 py-4 bg-white text-blue-600 rounded-full font-bold text-lg shadow-lg hover:bg-gray-100 hover:shadow-xl transform hover:-translate-y-1 transition-all">طلب عرض توضيحي</a>
        </div>
    </section>
    {{-- Footer component --}}
    <x-footer />

    {{-- Optional JS --}}
    @vite('resources/js/app.js')


    <!-- Optional JS (leave as is) -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>