@extends('layouts.admin')

@section('title', 'تعديل مصروف')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-3xl">
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-edit text-blue-600"></i>
            تعديل المصفوف
        </h1>
        <a href="{{ route('expenses.index') }}" class="text-gray-500 hover:text-gray-700 font-medium flex items-center gap-1 transition">
            <i class="fas fa-arrow-right"></i> عودة للقائمة
        </a>
    </div>

    <form method="POST" action="{{ route('expenses.update', $expense->id) }}" class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        @csrf
        @method('PUT')

        <div class="p-6 md:p-8 space-y-6">
            <!-- Information -->
            <div>
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    تفاصيل المصروف
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="expense_name" class="block text-sm font-bold text-gray-700 mb-1">اسم المصروف <span class="text-red-500">*</span></label>
                        <input type="text" name="expense_name" id="expense_name" value="{{ old('expense_name', $expense->expense_name) }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5" required>
                        @error('expense_name') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-bold text-gray-700 mb-1">المبلغ <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount', $expense->amount) }}" 
                                   class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5 text-left dir-ltr font-bold text-red-700" required>
                            <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 font-bold block rtl:left-4 rtl:right-auto">ر.س</span>
                        </div>
                        @error('amount') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="expense_date" class="block text-sm font-bold text-gray-700 mb-1">التاريخ <span class="text-red-500">*</span></label>
                        <input type="date" name="expense_date" id="expense_date" value="{{ old('expense_date', $expense->expense_date) }}" 
                               class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-2.5 text-left dir-ltr" required>
                        @error('expense_date') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-1">الوصف والملاحظات (اختياري)</label>
                        <textarea name="description" id="description" rows="3" 
                                  class="w-full rounded-xl border-gray-200 border-2 focus:border-blue-600 focus:ring-0 transition-colors bg-gray-50/50 focus:bg-white px-4 py-3">{{ old('description', $expense->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1 font-medium"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Footer Buttons -->
        <div class="bg-gray-50 px-6 py-4 flex flex-col md:flex-row items-center gap-3 border-t border-gray-100">
            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition font-bold shadow-md hover:shadow-lg flex justify-center items-center gap-2 text-lg">
                <i class="fas fa-check"></i> تحديث المصروف
            </button>
            <a href="{{ route('expenses.index') }}" class="w-full md:w-auto mr-auto px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition font-bold text-center">
                إلغاء التغييرات
            </a>
        </div>
    </form>
</div>
@endsection