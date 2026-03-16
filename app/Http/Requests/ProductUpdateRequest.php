<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_name'        => 'sometimes|required|string|max:255',
            'barcode'             => ['sometimes','required','string', Rule::unique('products')->ignore($this->product)],
            'sku'                 => 'nullable|string|max:50',
            'category_id'         => 'sometimes|required|exists:categories,id',
            'supplier_id'         => 'sometimes|required|exists:suppliers,id',
            'purchase_price'      => 'sometimes|required|numeric|min:0',
            'selling_price'       => 'sometimes|required|numeric|min:0',
            'production_date'     => 'nullable|date',
            'expiry_date'         => 'nullable|date|after:production_date',
            'product_image'       => 'nullable|image|max:2048',
            'description'         => 'nullable|string',
            // Inventory fields
            'quantity'            => 'sometimes|required|integer|min:0',
            'minimum_stock_alert' => 'nullable|integer|min:0',
            'unit_type'           => 'sometimes|required|in:piece,box,kg',
        ];
    }
}