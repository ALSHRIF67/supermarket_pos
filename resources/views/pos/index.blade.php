@extends('layouts.admin')

@section('title', 'سجل المبيعات والطلبات')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="fas fa-receipt text-blue-600"></i>
            سجل المبيعات والطلبات
        </h1>
        <a href="{{ route('pos.create') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl transition duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-plus"></i>
            <span>إنشاء طلب جديد</span>
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center gap-3">
            <i class="fas fa-check-circle text-xl"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Orders List -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Desktop Table (hidden on mobile) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-right">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600"># الفاتورة</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">الكاشير</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">الإجمالي</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">طريقة الدفع</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">الحالة</th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600">التاريخ</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $order->invoice_number }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $order->user->name ?? 'غير محدد' }}</td>
                        <td class="px-6 py-4 text-red-600 font-bold">{{ number_format($order->total, 2) }} ر.س</td>
                        <td class="px-6 py-4 text-gray-600">
                            @switch($order->payment_method)
                                @case('cash') <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">نقدي</span> @break
                                @case('card') <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-bold">بطاقة</span> @break
                                @default <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs font-bold">{{ $order->payment_method }}</span>
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            @if($order->status == 'completed')
                                <span class="text-green-600 font-medium"><i class="fas fa-check-circle ml-1"></i> مكتمل</span>
                            @else
                                <span class="text-yellow-600 font-medium"><i class="fas fa-clock ml-1"></i> معلق</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-sm">{{ $order->created_at->format('Y-m-d h:i A') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('pos.invoice', $order->id) }}" target="_blank"
                               class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium text-sm">
                                <i class="fas fa-print"></i>
                                طباعة
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12 text-gray-400">
                            <i class="fas fa-receipt text-5xl mb-3 block"></i>
                            <p class="text-lg">لا توجد طلبات مسجلة.</p>
                            <a href="{{ route('pos.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">إنشاء أول طلب</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards (visible only on mobile) -->
        <div class="md:hidden divide-y divide-gray-100">
            @forelse($orders as $order)
            <div class="p-4 bg-white hover:bg-gray-50 transition">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $order->invoice_number }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('Y-m-d h:i A') }}</p>
                    </div>
                    <div class="text-left">
                        <span class="text-red-600 font-bold block">{{ number_format($order->total, 2) }} ر.س</span>
                        @if($order->status == 'completed')
                            <span class="text-green-600 text-xs font-medium block mt-1">مكتمل <i class="fas fa-check-circle"></i></span>
                        @endif
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-4">
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-user text-gray-400"></i> {{ $order->user->name ?? 'غير محدد' }}
                    </div>
                    <a href="{{ route('pos.invoice', $order->id) }}" target="_blank"
                       class="inline-flex items-center gap-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                        <i class="fas fa-print"></i>
                        طباعة
                    </a>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400">
                <i class="fas fa-receipt text-4xl mb-2 block"></i>
                <p>لا توجد طلبات مسجلة.</p>
                <a href="{{ route('pos.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">إنشاء أول طلب</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
