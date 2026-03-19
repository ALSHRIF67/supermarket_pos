<!DOCTYPE html>
<html dir="rtl">
<head>
<meta charset="UTF-8">
<title>فاتورة #{{ $order->id }}</title>

<style>
@page {
    size: 80mm auto;
    margin: 0;
}

body {
    font-family: 'Courier New', monospace;
    width: 76mm;
    margin: auto;
    font-size: 13px;
    font-weight: bold;
    color: #000;
}

.center {
    text-align: center;
}

.right {
    text-align: right;
}

.line {
    border-top: 2px dashed #000;
    margin: 6px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

th, td {
    padding: 4px 0;
    word-break: break-word;
}

th {
    border-bottom: 2px dashed #000;
    font-size: 12px;
}

td {
    border-bottom: 1px dashed #ccc;
    font-size: 12px;
}

/* اسم المنتج + الكمية */
.name-qty {
    text-align: right;
    width: 65%;
}

/* السعر */
.price {
    width: 35%;
    text-align: center;
    white-space: nowrap;
}

/* الكمية */
.qty {
    font-size: 11px;
    margin-right: 3px;
}

/* التوتال */
.total-section {
    margin-top: 5px;
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin: 4px 0;
    font-size: 13px;
}

.grand {
    font-size: 15px;
    border-top: 2px dashed #000;
    padding-top: 5px;
}

.footer {
    text-align: center;
    margin-top: 10px;
    font-size: 12px;
}

</style>
</head>

<body>

<div class="center" style="font-size:16px">
    سوبر ماركت
</div>

<div class="center" style="font-size:12px">
    نظام نقاط البيع
</div>

<div class="line"></div>

<div class="right">
    رقم الفاتورة : {{ $order->invoice_number }}<br>
    التاريخ : {{ $order->created_at->format('Y-m-d H:i') }}<br>
    الكاشير : {{ $order->user->name ?? '-' }}
</div>

<div class="line"></div>

<table>
<thead>
<tr>
    <th class="name-qty">الصنف × الكمية</th>
    <th class="price">السعر</th>
</tr>
</thead>

<tbody>
@foreach($order->items as $item)
<tr>
    <td class="name-qty">
        {{ Str::limit($item->product->name, 25) }}
        <span class="qty">×{{ $item->quantity }}</span>
    </td>
    <td class="price">
        {{ number_format($item->price, 2) }}
    </td>
</tr>
@endforeach
</tbody>
</table>

<div class="line"></div>

<div class="total-section">

<div class="total-row">
    <span>المجموع الفرعي</span>
    <span>{{ number_format($order->subtotal, 2) }}</span>
</div>

@if($order->tax > 0)
<div class="total-row">
    <span>الضريبة</span>
    <span>{{ number_format($order->tax, 2) }}</span>
</div>
@endif

@if($order->discount > 0)
<div class="total-row">
    <span>الخصم</span>
    <span>{{ number_format($order->discount, 2) }}</span>
</div>
@endif

<div class="total-row grand">
    <span>الإجمالي</span>
    <span>{{ number_format($order->total, 2) }}</span>
</div>

</div>

<div class="line"></div>

<div class="center">
    طريقة الدفع :
    @switch($order->payment_method)
        @case('cash') نقدي @break
        @case('card') بطاقة @break
        @case('wallet') محفظة @break
        @default نقدي
    @endswitch
</div>

<div class="footer">
    شكراً لتسوقكم معنا ❤️<br>
    نتمنى لكم يوماً سعيداً
</div>

<script>
window.onload = function() {
    window.print();
    setTimeout(() => window.close(), 500);
}
</script>

</body>
</html>