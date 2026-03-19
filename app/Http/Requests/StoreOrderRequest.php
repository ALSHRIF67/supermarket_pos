<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'invoice_number' => 'required|string|unique:orders',
            'items'          => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.sale_price' => 'required|numeric|min:0',
            'discount'       => 'nullable|numeric|min:0',
            'discount_type'  => 'nullable|in:fixed,percentage',
            'tax'            => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string|in:cash,card,wallet',
            'notes'          => 'nullable|string',
        ];
    }
}