@extends('layouts.admin')

@section('title', 'المصروفات')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header with title and action button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-money-bill-wave text-blue-600"></i>
            المصروفات
        </h1>
        <a href="{{ route('expenses.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <i class="fas fa-plus"></i>
            <span>إضافة مصروف جديد</span>
        </a>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Expenses Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg p-6 text-white transition-transform hover:scale-105 duration-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">إجمالي المصروفات</h3>
                <i class="fas fa-chart-line text-2xl"></i>
            </div>
            <p class="text-3xl font-bold">{{ number_format($totalExpenses, 2) }} ر.س</p>
            <p class="text-sm opacity-90 mt-2">إجمالي جميع المصروفات المسجلة</p>
        </div>

        <!-- Today Expenses Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-2xl shadow-lg p-6 text-white transition-transform hover:scale-105 duration-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">مصروفات اليوم</h3>
                <i class="fas fa-calendar-day text-2xl"></i>
            </div>
            <p class="text-3xl font-bold">{{ number_format($todayExpenses, 2) }} ر.س</p>
            <p class="text-sm opacity-90 mt-2">{{ now()->format('Y-m-d') }}</p>
        </div>

        <!-- Month Expenses Card -->
        <div class="bg-gradient-to-br from-orange-500 to-orange-700 rounded-2xl shadow-lg p-6 text-white transition-transform hover:scale-105 duration-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">مصروفات الشهر</h3>
                <i class="fas fa-calendar-alt text-2xl"></i>
            </div>
            <p class="text-3xl font-bold">{{ number_format($monthExpenses, 2) }} ر.س</p>
            <p class="text-sm opacity-90 mt-2">{{ now()->format('F Y') }}</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3 animate-pulse">
            <i class="fas fa-check-circle text-xl"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Expenses List -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Desktop Table (hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">#</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">اسم المصروف</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">المبلغ</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">التاريخ</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-gray-600">الوصف</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                    <tr class="border-b hover:bg-gray-50 transition duration-150 even:bg-gray-50/50">
                        <td class="px-6 py-4 text-sm">{{ $expense->id }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $expense->expense_name }}</td>
                        <td class="px-6 py-4 text-red-600 font-bold">{{ number_format($expense->amount, 2) }} ر.س</td>
                        <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ Str::limit($expense->description, 40) }}</td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('expenses.show', $expense->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition"
                                   title="عرض المصروف">
                                    <i class="fas fa-eye text-sm"></i>
                                    <span class="text-xs font-medium hidden sm:inline">عرض</span>
                                </a>
                                <a href="{{ route('expenses.edit', $expense->id) }}"
                                   class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition"
                                   title="تعديل المصروف">
                                    <i class="fas fa-edit text-sm"></i>
                                    <span class="text-xs font-medium hidden sm:inline">تعديل</span>
                                </a>
                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذا المصروف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition"
                                            title="حذف المصروف">
                                        <i class="fas fa-trash-alt text-sm"></i>
                                        <span class="text-xs font-medium hidden sm:inline">حذف</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-12">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <i class="fas fa-inbox text-5xl"></i>
                                <p class="text-lg">لا توجد مصروفات مسجلة</p>
                                <a href="{{ route('expenses.create') }}" class="text-blue-600 hover:underline inline-flex items-center gap-1">
                                    <i class="fas fa-plus"></i> أضف أول مصروف
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards (visible only on mobile) -->
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($expenses as $expense)
            <div class="p-4 hover:bg-gray-50 transition">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $expense->expense_name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($expense->expense_date)->format('Y-m-d') }}</p>
                    </div>
                    <span class="text-red-600 font-bold">{{ number_format($expense->amount, 2) }} ر.س</span>
                </div>
                @if($expense->description)
                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($expense->description, 80) }}</p>
                @endif
                <div class="flex justify-end gap-2">
                    <a href="{{ route('expenses.show', $expense->id) }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-700 rounded-lg text-sm hover:bg-green-200 transition">
                        <i class="fas fa-eye"></i>
                        <span>عرض</span>
                    </a>
                    <a href="{{ route('expenses.edit', $expense->id) }}"
                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200 transition">
                        <i class="fas fa-edit"></i>
                        <span>تعديل</span>
                    </a>
                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذا المصروف؟')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg text-sm hover:bg-red-200 transition">
                            <i class="fas fa-trash-alt"></i>
                            <span>حذف</span>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400">
                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                <p>لا توجد مصروفات مسجلة</p>
                <a href="{{ route('expenses.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">أضف أول مصروف</a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($expenses->hasPages())
        <div class="border-t px-6 py-4 bg-gray-50">
            {{ $expenses->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection