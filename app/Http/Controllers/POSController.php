<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreOrderRequest;

class PosController extends Controller
{

public function index()
{
    // مثال: عرض آخر 10 طلبات
    $orders = Order::with('user')->latest()->take(10)->get();
    return view('pos.index', compact('orders'));
}
    public function create()
    {
        $products = Product::with('inventory')->get();
        return view('pos.create', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $products = Product::with('inventory')
            ->where('name', 'like', "%{$query}%")
            ->orWhere('barcode', 'like', "%{$query}%")
            ->limit(10)
            ->get();

        return response()->json($products);
    }

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            // حساب المجموع
            $subtotal = 0;
            $totalProfit = 0;
            foreach ($validated['items'] as $item) {
                $product = Product::find($item['product_id']);
                $itemSubtotal = $item['quantity'] * $item['sale_price'];
                $subtotal += $itemSubtotal;

                if ($product && $product->purchase_price) {
                    $totalProfit += ($item['sale_price'] - $product->purchase_price) * $item['quantity'];
                }
            }

            $discount = $validated['discount'] ?? 0;
            $discountType = $validated['discount_type'] ?? 'fixed';
            $discountAmount = $discountType === 'percentage' ? ($subtotal * $discount / 100) : $discount;
            $tax = $validated['tax'] ?? 0;
            $total = $subtotal - $discountAmount + $tax;

            // إنشاء الطلب
            $order = Order::create([
                'invoice_number' => $validated['invoice_number'],
                'user_id'        => auth()->id(),
                'subtotal'       => $subtotal,
                'tax'            => $tax,
                'discount'       => $discountAmount,
                'total'          => $total,
                'profit'         => $totalProfit,
                'payment_method' => $validated['payment_method'] ?? 'cash',
                'status'         => 'completed',
                'notes'          => $validated['notes'] ?? null,
            ]);

            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                // إنشاء عنصر الطلب
                $order->items()->create([
                    'product_id'     => $product->id,
                    'quantity'       => $item['quantity'],
                    'price'          => $item['sale_price'],
                    'purchase_price' => $product->purchase_price ?? 0,
                    'subtotal'       => $item['quantity'] * $item['sale_price'],
                    'profit'         => ($item['sale_price'] - ($product->purchase_price ?? 0)) * $item['quantity'],
                ]);

                // خصم المخزون بدون تحقق
                if ($product->inventory) {
                    $product->inventory->decrement('quantity', $item['quantity']);
                } else {
                    $product->inventory()->create([
                        'quantity'            => -$item['quantity'],
                        'minimum_stock_alert' => 0,
                        'unit_type'           => 'piece',
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success'     => true,
                'message'     => 'تم حفظ الطلب بنجاح',
                'invoice_url' => route('pos.invoice', $order->id),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function invoice(Order $order)
    {
        $order->load('items.product', 'user');
        return view('pos.invoice', compact('order'));
    }
}