<?php
namespace Database\Seeders;

use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $product = Product::create([
            'product_name'    => 'Milk 1L',
            'barcode'         => '1234567890123',
            'sku'             => 'MILK001',
            'category_id'     => 1,
            'supplier_id'     => 1,
            'purchase_price'  => 3.50,
            'selling_price'   => 5.00,
            'production_date' => now()->subDays(5),
            'expiry_date'     => now()->addDays(10),
            'description'     => 'Fresh pasteurized milk',
        ]);

        Inventory::create([
            'product_id'          => $product->id,
            'quantity'            => 50,
            'minimum_stock_alert' => 10,
            'unit_type'           => 'piece',
        ]);

        // Add more products as needed
    }
}