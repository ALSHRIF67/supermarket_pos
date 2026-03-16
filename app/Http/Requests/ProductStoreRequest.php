<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization as needed
    }

    public function rules()
    {
        return [
            'product_name'        => 'required|string|max:255',
            'barcode'             => 'required|string|unique:products,barcode',
            'sku'                 => 'nullable|string|max:50',
            'category_id'         => 'required|exists:categories,id',
            'supplier_id'         => 'required|exists:suppliers,id',
            'purchase_price'      => 'required|numeric|min:0',
            'selling_price'       => 'required|numeric|min:0',
            'production_date'     => 'nullable|date',
            'expiry_date'         => 'nullable|date|after:production_date',
            'product_image'       => 'nullable|image|max:2048',
            'description'         => 'nullable|string',
            // Inventory fields
            'quantity'            => 'required|integer|min:0',
            'minimum_stock_alert' => 'nullable|integer|min:0',
            'unit_type'           => 'required|in:piece,box,kg',
        ];
    }
}