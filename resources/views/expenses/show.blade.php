@extends('layouts.admin')

@section('title', 'تفاصيل المصروف')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-file-invoice-dollar text-blue-600"></i>
            تفاصيل المصروف
        </h1>
        <a href="{{ route('expenses.index') }}"
           class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-xl transition shadow">
            <i class="fas fa-arrow-right"></i>
            <span>العودة للقائمة</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-50 border-b border-blue-100 px-6 py-4">
            <h2 class="text-xl font-bold text-blue-800">{{ $expense->expense_name }}</h2>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Row -->
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <span class="block text-sm text-gray-500 mb-1">
                        <i class="fas fa-hashtag text-gray-400 ml-1"></i> رقم المصروف
                    </span>
                    <strong class="text-gray-800 text-lg">#{{ $expense->id }}</strong>
                </div>

                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                    <span class="block text-sm text-blue-500 mb-1">
                        <i class="fas fa-money-bill-wave text-blue-400 ml-1"></i> المبلغ
                    </span>
                    <strong class="text-red-600 text-xl font-bold">{{ number_format($expense->amount, 2) }} ر.س</strong>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <span class="block text-sm text-gray-500 mb-1">
                        <i class="fas fa-calendar-alt text-gray-400 ml-1"></i> تاريخ المصروف
                    </span>
                    <strong class="text-gray-800">{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</strong>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <span class="block text-sm text-gray-500 mb-1">
                        <i class="fas fa-clock text-gray-400 ml-1"></i> تاريخ الإضافة
                    </span>
                    <strong class="text-gray-800">{{ $expense->created_at->format('Y-m-d h:i A') }}</strong>
                </div>
            </div>

            @if($expense->description)
            <div class="mt-6 bg-gray-50 p-5 rounded-xl border border-gray-100">
                <span class="block text-sm text-gray-500 mb-2">
                    <i class="fas fa-align-right text-gray-400 ml-1"></i> الوصف
                </span>
                <p class="text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $expense->description }}</p>
            </div>
            @endif

            <div class="mt-8 pt-6 border-t border-gray-100 flex gap-3">
                <a href="{{ route('expenses.edit', $expense->id) }}"
                   class="flex-1 text-center bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-3 rounded-xl transition font-medium">
                    <i class="fas fa-edit ml-1"></i> تعديل المصروف
                </a>
                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="flex-1" onsubmit="return confirm('هل أنت متأكد من حذف هذا المصروف؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full bg-red-100 hover:bg-red-200 text-red-700 px-4 py-3 rounded-xl transition font-medium">
                        <i class="fas fa-trash-alt ml-1"></i> حذف المصروف
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
