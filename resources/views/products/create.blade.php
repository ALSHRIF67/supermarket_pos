@extends('layouts.admin')

@section('title', 'إضافة منتج جديد')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold">إضافة منتج جديد</h1>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Basic Information / المعلومات الأساسية -->
            <h2 class="text-lg font-semibold mb-4 pb-2 border-b">المعلومات الأساسية</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="product_name" class="block text-sm font-medium text-gray-700 mb-1">اسم المنتج *</label>
                    <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    @error('product_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="barcode" class="block text-sm font-medium text-gray-700 mb-1">الباركود *</label>
                    <input type="text" name="barcode" id="barcode" value="{{ old('barcode') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    @error('barcode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU (رمز التخزين)</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">التصنيف *</label>
                    <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        <option value="">اختر التصنيف</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">المورد *</label>
                    <select name="supplier_id" id="supplier_id" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        <option value="">اختر المورد</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Pricing / التسعير -->
            <h2 class="text-lg font-semibold mb-4 pb-2 border-b">التسعير</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">سعر الشراء *</label>
                    <input type="number" step="0.01" name="purchase_price" id="purchase_price" value="{{ old('purchase_price') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    @error('purchase_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="selling_price" class="block text-sm font-medium text-gray-700 mb-1">سعر البيع *</label>
                    <input type="number" step="0.01" name="selling_price" id="selling_price" value="{{ old('selling_price') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    @error('selling_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الربح</label>
                    <div class="py-2 px-3 bg-gray-100 rounded-lg" id="profit_display">
                        {{ old('selling_price') && old('purchase_price') ? number_format(old('selling_price') - old('purchase_price'), 2) : '0.00' }}
                    </div>
                </div>
            </div>

            <!-- Inventory / المخزون -->
            <h2 class="text-lg font-semibold mb-4 pb-2 border-b">المخزون</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">الكمية *</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 0) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                    @error('quantity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="minimum_stock_alert" class="block text-sm font-medium text-gray-700 mb-1">حد التنبيه الأدنى</label>
                    <input type="number" name="minimum_stock_alert" id="minimum_stock_alert" value="{{ old('minimum_stock_alert', 5) }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label for="unit_type" class="block text-sm font-medium text-gray-700 mb-1">نوع الوحدة *</label>
                    <select name="unit_type" id="unit_type" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
                        <option value="piece" {{ old('unit_type') == 'piece' ? 'selected' : '' }}>قطعة</option>
                        <option value="box" {{ old('unit_type') == 'box' ? 'selected' : '' }}>كرتونة</option>
                        <option value="kg" {{ old('unit_type') == 'kg' ? 'selected' : '' }}>كيلو جرام</option>
                    </select>
                </div>
            </div>

            <!-- Extra Information / معلومات إضافية -->
            <h2 class="text-lg font-semibold mb-4 pb-2 border-b">معلومات إضافية</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="production_date" class="block text-sm font-medium text-gray-700 mb-1">تاريخ الإنتاج</label>
                    <input type="date" name="production_date" id="production_date" value="{{ old('production_date') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label for="expiry_date" class="block text-sm font-medium text-gray-700 mb-1">تاريخ انتهاء الصلاحية</label>
                    <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label for="product_image" class="block text-sm font-medium text-gray-700 mb-1">صورة المنتج</label>
                    <input type="file" name="product_image" id="product_image" accept="image/*" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">الوصف</label>
                    <textarea name="description" id="description" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center gap-4 pt-4 border-t">
                <button type="submit" name="action" value="save" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">حفظ</button>
                <button type="submit" name="action" value="save_and_new" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">حفظ وإضافة جديد</button>
                <a href="{{ route('products.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">إلغاء</a>
            </div>
        </form>
    </div>

    <!-- Auto profit calculation JS (same) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const purchase = document.getElementById('purchase_price');
            const selling = document.getElementById('selling_price');
            const profitDisplay = document.getElementById('profit_display');

            function updateProfit() {
                const p = parseFloat(purchase.value) || 0;
                const s = parseFloat(selling.value) || 0;
                profitDisplay.textContent = (s - p).toFixed(2);
            }

            purchase.addEventListener('input', updateProfit);
            selling.addEventListener('input', updateProfit);
        });
    </script>
@endsection