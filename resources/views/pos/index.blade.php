@extends('layouts.admin')

@section('title', 'Point of Sale')

@section('content')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">

<!-- Receipt Modal -->
<div id="receiptModal" class="receipt-modal">
    <div class="receipt-content" id="receiptContent"></div>
</div>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-[60]">
    <div class="bg-white p-8 rounded-2xl text-center shadow-xl">
        <div class="spinner mx-auto mb-4"></div>
        <p class="text-gray-600 font-medium">جاري حفظ الطلب...</p>
    </div>
</div>

<!-- Main Content -->
<main id="mainContent" class="main-content font-sans text-gray-700">
    <div class="flex flex-col lg:flex-row gap-4 p-4 min-h-full">

        {{-- ========== PRODUCTS SECTION (60%) ========== --}}
        <div class="lg:w-3/5 bg-white rounded-2xl shadow-xl p-4 flex flex-col h-full overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold text-blue-900 flex items-center gap-2">
                    <i class="fas fa-utensils text-blue-700 text-2xl"></i>
                    القائمة
                </h2>
                <div class="text-sm text-gray-500">
                    <span id="productCount">{{ count($products) }}</span> صنف متاح
                </div>
            </div>

            <!-- Search -->
            <div class="mb-4">
                <div class="relative">
                    <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           id="searchInput"
                           placeholder="ابحث عن صنف..." 
                           class="w-full pr-12 pl-4 py-3 border-2 border-gray-200 rounded-2xl focus:border-blue-700 focus:outline-none text-lg">
                </div>
            </div>

            <!-- Categories -->
            <div class="flex gap-2 mb-4 overflow-x-auto pb-2 scrollbar-custom">
                <button class="category-btn active px-6 py-2 bg-blue-700 text-white rounded-xl font-bold whitespace-nowrap touch-button" data-category="all">
                    الكل
                </button>
                @foreach($categories ?? [] as $category)
                <button class="category-btn px-6 py-2 bg-gray-100 text-gray-700 rounded-xl font-bold whitespace-nowrap touch-button hover:bg-gray-200" data-category="{{ $category->name }}">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3 overflow-y-auto scrollbar-custom p-1 flex-1" id="productsGrid">
                @foreach($products as $product)
                <div class="product-card bg-white border-2 border-gray-200 rounded-2xl p-4 cursor-pointer touch-button hover:shadow-lg"
                     data-id="{{ $product->id }}"
                     data-name="{{ $product->product_name }}"
                     data-price="{{ $product->selling_price }}"
                     data-category="{{ $product->category->name ?? '' }}"
                     data-stock="{{ $product->inventory->quantity ?? 0 }}"
                     data-track="{{ $product->track_inventory ?? false }}">

                    <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-blue-200/30 to-teal-200/30 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-utensils text-blue-700 text-3xl"></i>
                    </div>

                    <h3 class="font-bold text-gray-900 text-center text-lg mb-1">{{ $product->product_name }}</h3>
                    <p class="text-blue-700 font-bold text-center text-xl">
                        {{ number_format($product->selling_price, 2) }} <span class="text-sm">ر.س</span>
                    </p>

                    @if($product->track_inventory)
                        @php $stock = $product->inventory->quantity ?? 0; @endphp
                        <div class="text-center mt-2">
                            <span class="inline-block px-3 py-1 text-xs rounded-full 
                                @if($stock > 10) bg-green-100 text-green-700
                                @elseif($stock > 0) bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                <i class="fas 
                                    @if($stock > 10) fa-check-circle
                                    @elseif($stock > 0) fa-exclamation-circle
                                    @else fa-times-circle @endif ml-1">
                                </i>
                                {{ $stock > 0 ? $stock . ' متبقي' : 'غير متوفر' }}
                            </span>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        {{-- ========== ORDER SECTION (40%) ========== --}}
        <div class="lg:w-2/5 bg-white rounded-2xl shadow-xl flex flex-col h-full overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-l from-blue-700 to-teal-500 p-4">
                <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i class="fas fa-shopping-cart"></i>
                    الطلب الحالي
                    <span class="bg-white text-blue-700 text-sm px-3 py-1 rounded-full mr-auto" id="itemCount">0</span>
                </h2>
            </div>

            <!-- Order Items Table -->
            <div class="flex-1 overflow-y-auto scrollbar-custom p-4" id="orderItemsContainer">
                <table class="w-full font-medium">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th class="p-3 text-right">الصنف</th>
                            <th class="p-3 text-center">السعر</th>
                            <th class="p-3 text-center">الكمية</th>
                            <th class="p-3 text-center">الإجمالي</th>
                            <th class="p-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody id="orderItemsList"></tbody>
                </table>

                <div id="emptyOrder" class="text-center py-12 text-gray-400">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-basket text-4xl"></i>
                    </div>
                    <p class="text-lg">لم يتم إضافة أي أصناف</p>
                    <p>اضغط على الأصناف لإضافتها</p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="border-t p-4 bg-gray-50">
                <div class="flex justify-between items-center mb-3">
                    <span>المجموع الفرعي:</span>
                    <span class="font-bold text-xl" id="subtotal">0.00 ر.س</span>
                </div>

                <div class="flex justify-between items-center mb-3">
                    <span>الضريبة (%):</span>
                    <div class="flex items-center gap-2">
                        <input type="number" 
                               id="taxRate" 
                               value="0" 
                               min="0" 
                               max="100" 
                               step="0.1"
                               class="w-20 p-2 border-2 border-gray-200 rounded-lg focus:border-blue-700 focus:outline-none">
                        <span>%</span>
                    </div>
                </div>
                <div class="flex justify-between items-center mb-3 text-sm text-gray-500">
                    <span>قيمة الضريبة:</span>
                    <span id="taxAmount">0.00 ر.س</span>
                </div>

                <div class="flex justify-between items-center mb-3">
                    <span>الخصم:</span>
                    <input type="number" 
                           id="discount" 
                           value="0" 
                           min="0" 
                           step="0.5"
                           class="w-24 p-2 border-2 border-gray-200 rounded-lg focus:border-blue-700 focus:outline-none">
                </div>

                <div class="flex justify-between items-center mb-4 pt-3 border-t-2 border-gray-200">
                    <span class="font-bold text-lg">الإجمالي النهائي:</span>
                    <span class="font-bold text-2xl text-blue-700" id="grandTotal">0.00 ر.س</span>
                </div>

                <!-- Notes -->
                <textarea id="orderNotes" 
                          placeholder="ملاحظات إضافية (اختياري)..."
                          class="w-full p-3 border-2 border-gray-200 rounded-xl mb-3 focus:border-blue-700 focus:outline-none"
                          rows="2"></textarea>

                <!-- Payment Method -->
                <div class="grid grid-cols-3 gap-2 mb-3">
                    <button class="payment-method-btn active bg-blue-700 text-white p-3 rounded-xl font-bold touch-button" data-method="cash">
                        <i class="fas fa-money-bill-wave ml-1"></i>
                        نقدي
                    </button>
                    <button class="payment-method-btn bg-gray-100 text-gray-700 p-3 rounded-xl font-bold touch-button" data-method="card">
                        <i class="fas fa-credit-card ml-1"></i>
                        بطاقة
                    </button>
                    <button class="payment-method-btn bg-gray-100 text-gray-700 p-3 rounded-xl font-bold touch-button" data-method="wallet">
                        <i class="fas fa-wallet ml-1"></i>
                        محفظة
                    </button>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-3">
                    <button onclick="printOrder()" 
                            class="bg-blue-700 text-white p-4 rounded-xl font-bold text-lg hover:bg-blue-800 transition-all touch-button flex items-center justify-center gap-2"
                            id="printBtn">
                        <i class="fas fa-print"></i>
                        طباعة الفاتورة
                    </button>
                    
                    <button onclick="clearOrder()" 
                            class="bg-gray-200 text-gray-700 p-4 rounded-xl font-bold text-lg hover:bg-gray-300 transition-all touch-button flex items-center justify-center gap-2">
                        <i class="fas fa-trash-alt"></i>
                        تفريغ
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Notification -->
<div id="notification" class="notification"></div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const productsGrid = document.getElementById('productsGrid');
    const orderItemsList = document.getElementById('orderItemsList');
    const emptyOrder = document.getElementById('emptyOrder');
    const itemCount = document.getElementById('itemCount');
    const subtotalEl = document.getElementById('subtotal');
    const grandTotalEl = document.getElementById('grandTotal');
    const discountInput = document.getElementById('discount');
    const taxRateInput = document.getElementById('taxRate');
    const printBtn = document.getElementById('printBtn');

    let orderItems = [];

    function updateOrder() {
        orderItemsList.innerHTML = '';
        if (orderItems.length === 0) emptyOrder.style.display = 'block';
        else emptyOrder.style.display = 'none';

        let subtotal = 0;
        orderItems.forEach((item, index) => {
            const total = item.price * item.quantity;
            subtotal += total;
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td class="text-center">${item.price.toFixed(2)}</td>
                <td class="text-center">
                    <input type="number" min="1" value="${item.quantity}" data-index="${index}" class="quantity-input w-16 text-center border rounded"/>
                </td>
                <td class="text-center">${total.toFixed(2)}</td>
                <td class="text-center"><button class="remove-btn text-red-500" data-index="${index}">×</button></td>
            `;
            orderItemsList.appendChild(row);
        });

        const discount = parseFloat(discountInput.value) || 0;
        const taxRate = parseFloat(taxRateInput.value) || 0;
        const tax = (subtotal - discount) * (taxRate / 100);
        const grandTotal = subtotal - discount + tax;

        subtotalEl.textContent = subtotal.toFixed(2) + ' ر.س';
        grandTotalEl.textContent = grandTotal.toFixed(2) + ' ر.س';
        itemCount.textContent = orderItems.length;

        // Attach events
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', (e) => {
                const idx = e.target.dataset.index;
                const val = parseInt(e.target.value) || 1;
                orderItems[idx].quantity = val;
                updateOrder();
            });
        });
        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const idx = e.target.dataset.index;
                orderItems.splice(idx, 1);
                updateOrder();
            });
        });
    }

    productsGrid.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', () => {
            const id = card.dataset.id;
            const name = card.dataset.name;
            const priceString = card.dataset.price;
            const price = parseFloat(priceString);
            
            if (!id || !name) {
                console.error('بيانات المنتج ناقصة', card);
                return;
            }
            
            if (isNaN(price) || price <= 0) {
                console.warn('السعر غير صالح للمنتج:', name, priceString);
                alert(`المنتج "${name}" لا يمكن إضافته (سعر غير صحيح)`);
                return;
            }
            
            const existing = orderItems.find(i => i.id == id);
            if (existing) {
                existing.quantity += 1;
            } else {
                orderItems.push({ id, name, price, quantity: 1 });
            }
            updateOrder();
        });
    });

    discountInput.addEventListener('input', updateOrder);
    taxRateInput.addEventListener('input', updateOrder);

    // --------------- Save & Print ---------------
    window.printOrder = function () {
        if (orderItems.length === 0) {
            alert('لا يوجد أصناف في الطلب');
            return;
        }

        // إنشاء رقم فاتورة فريد وتاريخ اليوم
        const invoiceNumber = 'INV-' + Date.now();
        const saleDate = new Date().toISOString().split('T')[0];

        const data = {
            invoice_number: invoiceNumber,
            sale_date: saleDate,
            items: orderItems.map(i => ({ 
                product_id: i.id, 
                quantity: i.quantity, 
                sale_price: i.price
            })),
            discount: parseFloat(discountInput.value) || 0,
            discount_type: 'fixed',
            tax: parseFloat(taxRateInput.value) || 0,
            payment_method: document.querySelector('.payment-method-btn.active').dataset.method,
            notes: document.getElementById('orderNotes').value
        };

        console.log('📤 البيانات المرسلة:', JSON.stringify(data, null, 2));

        document.getElementById('loadingOverlay').classList.remove('hidden');

        axios.post('{{ route("pos.store") }}', data)
            .then(res => {
                document.getElementById('loadingOverlay').classList.add('hidden');
                console.log('✅ استجابة الخادم:', res.data);

                if (res.data.success) {
                    window.open(res.data.invoice_url, '_blank');
                    const audio = new Audio('{{ asset("sounds/notification.mp3") }}');
                    audio.play();
                    orderItems = [];
                    updateOrder();
                    document.getElementById('orderNotes').value = '';
                }
            })
            .catch(err => {
                document.getElementById('loadingOverlay').classList.add('hidden');
                console.error('❌ خطأ من الخادم:', err.response);
                if (err.response && err.response.data.errors) {
                    const errors = Object.values(err.response.data.errors).flat().join('\n');
                    alert('أخطاء التحقق:\n' + errors);
                } else {
                    alert(err.response?.data?.message || 'حدث خطأ أثناء حفظ الطلب');
                }
            });
    }

    window.clearOrder = function () {
        orderItems = [];
        updateOrder();
    }
});
</script>
@endsection