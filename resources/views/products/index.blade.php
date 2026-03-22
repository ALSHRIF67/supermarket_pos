@extends('layouts.admin')

@section('title', 'المنتجات')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-box-open text-blue-600"></i>
            المنتجات
        </h1>
        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-plus"></i>
            <span>إضافة منتج جديد</span>
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3">
            <i class="fas fa-check-circle text-xl"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8 border border-gray-100">
        <form method="GET" action="{{ route('products.index') }}" class="flex flex-col md:flex-row gap-4 items-center">
            <div class="relative flex-1 w-full">
                <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" placeholder="بحث بالاسم، الباركود، SKU..." value="{{ request('search') }}" 
                       class="w-full pl-4 pr-12 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white">
            </div>
            
            <label class="flex items-center gap-3 cursor-pointer w-full md:w-auto p-3 border-2 border-gray-100 rounded-xl hover:bg-gray-50 transition">
                <input type="checkbox" name="low_stock" value="1" {{ request('low_stock') ? 'checked' : '' }} 
                       class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
                <span class="font-medium text-gray-700">الكمية المنخفضة فقط</span>
            </label>

            <div class="flex items-center gap-2 w-full md:w-auto">
                <button type="submit" class="flex-1 md:flex-none px-6 py-3 bg-gray-800 text-white rounded-xl font-bold hover:bg-gray-900 transition flex items-center justify-center gap-2">
                    <i class="fas fa-filter"></i> تصفية
                </button>
                <a href="{{ route('products.index') }}" class="flex-1 md:flex-none px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition text-center">
                    إلغاء
                </a>
            </div>
        </form>
    </div>

    <!-- Products List -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Desktop Table (hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-right divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">الصورة</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">الاسم</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">الباركود</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">التصنيف</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">السعر</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">المخزون</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->product_image)
                                <img src="{{ asset('storage/'.$product->product_image) }}" alt="{{ $product->product_name }}" class="h-12 w-12 rounded-xl object-cover shadow-sm">
                            @else
                                <div class="h-12 w-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-xl"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $product->product_name }}</td>
                        <td class="px-6 py-4 text-gray-600 font-mono text-sm">{{ $product->barcode }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-semibold">{{ $product->category->name ?? 'غير محدد' }}</span>
                        </td>
                        <td class="px-6 py-4 text-blue-700 font-bold bg-blue-50/30">{{ number_format($product->selling_price, 2) }} ر.س</td>
                        <td class="px-6 py-4">
                            @if($product->inventory && $product->inventory->quantity <= $product->inventory->minimum_stock_alert)
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-xs font-bold flex items-center w-max gap-1">
                                    <i class="fas fa-exclamation-triangle"></i> {{ $product->inventory->quantity }} (منخفض)
                                </span>
                            @else
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-lg text-xs font-bold flex items-center w-max gap-1">
                                    <i class="fas fa-check-circle"></i> {{ $product->inventory->quantity ?? 0 }} متوفر
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('products.edit', $product) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition text-sm font-medium">
                                    <i class="fas fa-edit"></i> تعديل
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition text-sm font-medium">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-box-open text-5xl mb-3 block text-gray-300"></i>
                            <p class="text-lg font-medium text-gray-500">لا توجد منتجات مسجلة.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards (visible only on mobile) -->
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($products as $product)
            <div class="p-4 bg-white hover:bg-gray-50 transition">
                <div class="flex items-start gap-4 mb-3">
                    @if($product->product_image)
                        <img src="{{ asset('storage/'.$product->product_image) }}" alt="صورة الإعلان" class="h-16 w-16 rounded-xl object-cover shadow-sm flex-shrink-0">
                    @else
                        <div class="h-16 w-16 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 flex-shrink-0">
                            <i class="fas fa-box text-2xl"></i>
                        </div>
                    @endif
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-800 text-lg">{{ $product->product_name }}</h3>
                        <p class="text-sm font-mono text-gray-500 mb-1">#{{ $product->barcode }}</p>
                        <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-xs font-semibold">{{ $product->category->name ?? 'غير محدد' }}</span>
                    </div>
                </div>
                
                <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl mb-4">
                    <div class="text-center">
                        <span class="block text-xs text-gray-500 mb-1">السعر</span>
                        <span class="font-bold text-blue-700">{{ number_format($product->selling_price, 2) }} ر.س</span>
                    </div>
                    <div class="h-8 w-px bg-gray-200"></div>
                    <div class="text-center">
                        <span class="block text-xs text-gray-500 mb-1">المخزون</span>
                        @if($product->inventory && $product->inventory->quantity <= $product->inventory->minimum_stock_alert)
                            <span class="text-red-600 font-bold text-sm"><i class="fas fa-exclamation-triangle"></i> {{ $product->inventory->quantity }}</span>
                        @else
                            <span class="text-green-600 font-bold text-sm"><i class="fas fa-check-circle"></i> {{ $product->inventory->quantity ?? 0 }}</span>
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('products.edit', $product) }}" class="flex-1 justify-center inline-flex items-center gap-1 px-4 py-2 bg-blue-100 text-blue-700 rounded-xl hover:bg-blue-200 transition text-sm font-medium">
                        <i class="fas fa-edit"></i> تعديل
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="flex-1 flex" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full justify-center inline-flex items-center gap-1 px-4 py-2 bg-red-100 text-red-700 rounded-xl hover:bg-red-200 transition text-sm font-medium">
                            <i class="fas fa-trash-alt"></i> حذف
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400">
                <i class="fas fa-box-open text-4xl mb-2 block text-gray-300"></i>
                <p class="font-medium text-gray-500">لا توجد منتجات مسجلة.</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
        <div class="border-t border-gray-100 px-6 py-4 bg-gray-50">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
