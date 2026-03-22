@extends('layouts.admin')

@section('title', 'إضافة منتج جديد')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-plus-circle text-blue-600"></i>
            إضافة منتج جديد
        </h1>
        <a href="{{ route('products.index') }}" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-1 transition">
            <i class="fas fa-arrow-right"></i> عودة للقائمة
        </a>
    </div>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        @csrf

        <div class="p-6 md:p-8 space-y-8">
            <!-- Basic Information -->
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    المعلومات الأساسية
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2">
                        <label for="product_name" class="block text-sm font-bold text-gray-700 mb-1">اسم المنتج <span class="text-red-500">*</span></label>
                        <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5" required>
                        @error('product_name') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="barcode" class="block text-sm font-bold text-gray-700 mb-1">الباركود <span class="text-red-500">*</span></label>
                        <input type="text" name="barcode" id="barcode" value="{{ old('barcode') }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5 font-mono text-left dir-ltr" required>
                        @error('barcode') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="sku" class="block text-sm font-bold text-gray-700 mb-1">SKU (رمز التخزين)</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku') }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5 font-mono text-left dir-ltr">
                        @error('sku') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-bold text-gray-700 mb-1">التصنيف <span class="text-red-500">*</span></label>
                        <select name="category_id" id="category_id" class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5" required>
                            <option value="">اختر التصنيف</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="supplier_id" class="block text-sm font-bold text-gray-700 mb-1">المورد <span class="text-red-500">*</span></label>
                        <select name="supplier_id" id="supplier_id" class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5" required>
                            <option value="">اختر المورد</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <i class="fas fa-tags text-green-500"></i>
                    التسعير
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <div>
                        <label for="purchase_price" class="block text-sm font-bold text-gray-700 mb-1">سعر الشراء <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" step="0.01" name="purchase_price" id="purchase_price" value="{{ old('purchase_price') }}" 
                                   class="w-full rounded-xl border-gray-300 border-2 focus:border-green-500 focus:ring-0 transition-colors bg-white px-4 py-2.5 text-left dir-ltr" required>
                            <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-bold block rtl:left-4 rtl:right-auto">ر.س</span>
                        </div>
                        @error('purchase_price') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="selling_price" class="block text-sm font-bold text-gray-700 mb-1">سعر البيع <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" step="0.01" name="selling_price" id="selling_price" value="{{ old('selling_price') }}" 
                                   class="w-full rounded-xl border-gray-300 border-2 focus:border-green-500 focus:ring-0 transition-colors bg-white px-4 py-2.5 text-left dir-ltr font-bold text-green-700" required>
                            <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-bold block rtl:left-4 rtl:right-auto">ر.س</span>
                        </div>
                        @error('selling_price') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">هامش الربح المتوقع</label>
                        <div class="flex items-center gap-2 h-[46px] px-4 bg-white border-2 border-dashed border-gray-300 rounded-xl text-green-600 font-bold text-lg" id="profit_display">
                            {{ old('selling_price') && old('purchase_price') ? number_format(old('selling_price') - old('purchase_price'), 2) : '0.00' }} ر.س
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory -->
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <i class="fas fa-boxes text-orange-500"></i>
                    المخزون
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="quantity" class="block text-sm font-bold text-gray-700 mb-1">الكمية الافتتاحية <span class="text-red-500">*</span></label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 0) }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5 text-left dir-ltr" required>
                        @error('quantity') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="minimum_stock_alert" class="block text-sm font-bold text-gray-700 mb-1">حد التنبيه الأدنى</label>
                        <input type="number" name="minimum_stock_alert" id="minimum_stock_alert" value="{{ old('minimum_stock_alert', 5) }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5 text-left dir-ltr">
                               <p class="text-xs text-gray-500 mt-1">سيتم التنبيه عند وصول المخزون لهذا الحد</p>
                    </div>
                    <div>
                        <label for="unit_type" class="block text-sm font-bold text-gray-700 mb-1">نوع الوحدة <span class="text-red-500">*</span></label>
                        <select name="unit_type" id="unit_type" class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5" required>
                            <option value="piece" {{ old('unit_type') == 'piece' ? 'selected' : '' }}>قطعة</option>
                            <option value="box" {{ old('unit_type') == 'box' ? 'selected' : '' }}>كرتونة</option>
                            <option value="kg" {{ old('unit_type') == 'kg' ? 'selected' : '' }}>كيلو جرام</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Extra Information -->
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <i class="fas fa-file-alt text-purple-500"></i>
                    تفاصيل إضافية
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="production_date" class="block text-sm font-bold text-gray-700 mb-1">تاريخ الإنتاج</label>
                        <input type="date" name="production_date" id="production_date" value="{{ old('production_date') }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5 text-left dir-ltr">
                    </div>
                    <div>
                        <label for="expiry_date" class="block text-sm font-bold text-gray-700 mb-1">تاريخ انتهاء الصلاحية</label>
                        <input type="date" name="expiry_date" id="expiry_date" value="{{ old('expiry_date') }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5 text-left dir-ltr">
                    </div>
                    <div class="md:col-span-2">
                        <label for="product_image" class="block text-sm font-bold text-gray-700 mb-1">صورة المنتج</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-gray-50 hover:bg-white transition-colors">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-3"></i>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="product_image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>اختر ملف الصورة</span>
                                        <input id="product_image" name="product_image" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pr-1">أو اسحب وأفلت هنا</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF حتى 2MB</p>
                            </div>
                        </div>
                        @error('product_image') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-1">الوصف والملاحظات</label>
                        <textarea name="description" id="description" rows="3" 
                                  class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-3">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Footer Buttons -->
        <div class="bg-gray-50 px-6 py-4 flex flex-col md:flex-row items-center gap-3 border-t border-gray-100">
            <button type="submit" name="action" value="save" class="w-full md:w-auto px-8 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-bold shadow-md hover:shadow-lg flex justify-center items-center gap-2 text-lg">
                <i class="fas fa-save"></i> حفظ المنتج
            </button>
            <button type="submit" name="action" value="save_and_new" class="w-full md:w-auto px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-bold shadow-md hover:shadow-lg flex justify-center items-center gap-2">
                <i class="fas fa-plus"></i> حفظ وإضافة آخر
            </button>
            <a href="{{ route('products.index') }}" class="w-full md:w-auto mr-auto px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition font-bold text-center">
                إلغاء التغييرات
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const purchase = document.getElementById('purchase_price');
        const selling = document.getElementById('selling_price');
        const profitDisplay = document.getElementById('profit_display');

        function updateProfit() {
            const p = parseFloat(purchase.value) || 0;
            const s = parseFloat(selling.value) || 0;
            const diff = s - p;
            
            profitDisplay.innerHTML = `${diff.toFixed(2)} ر.س`;
            if (diff > 0) {
                profitDisplay.className = 'flex items-center gap-2 h-[46px] px-4 bg-green-50 border-2 border-dashed border-green-300 rounded-xl text-green-700 font-bold text-lg';
            } else if (diff < 0) {
                profitDisplay.className = 'flex items-center gap-2 h-[46px] px-4 bg-red-50 border-2 border-dashed border-red-300 rounded-xl text-red-700 font-bold text-lg';
            } else {
                profitDisplay.className = 'flex items-center gap-2 h-[46px] px-4 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl text-gray-600 font-bold text-lg';
            }
        }

        purchase.addEventListener('input', updateProfit);
        selling.addEventListener('input', updateProfit);
        updateProfit(); // init
    });
</script>
@endsection