@extends('layouts.admin')

@section('title', 'المنتجات')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">المنتجات</h1>
        <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">إضافة منتج جديد</a>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('products.index') }}" class="flex flex-wrap gap-4">
            <input type="text" name="search" placeholder="بحث بالاسم، الباركود، SKU..." value="{{ request('search') }}" class="flex-1 min-w-[200px] px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
            <label class="flex items-center space-x-2 rtl:space-x-reverse">
                <input type="checkbox" name="low_stock" value="1" {{ request('low_stock') ? 'checked' : '' }} class="rounded text-blue-600">
                <span>الكمية المنخفضة فقط</span>
            </label>
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">تصفية</button>
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">إعادة تعيين</a>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الصورة</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الاسم</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الباركود</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">التصنيف</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">السعر</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المخزون</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->product_image)
                            <img src="{{ asset('storage/'.$product->product_image) }}" alt="{{ $product->product_name }}" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <span class="text-gray-400">لا توجد</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->product_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->barcode }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($product->selling_price, 2) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($product->inventory && $product->inventory->quantity <= $product->inventory->minimum_stock_alert)
                            <span class="text-red-600 font-bold">{{ $product->inventory->quantity }} (منخفض)</span>
                        @else
                            {{ $product->inventory->quantity ?? 0 }}
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 ml-2 inline-block">تعديل</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">حذف</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">لا توجد منتجات.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection

