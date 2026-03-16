<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'barcode', 'sku', 'category_id', 'supplier_id',
        'purchase_price', 'selling_price', 'production_date', 'expiry_date',
        'product_image', 'description'
    ];

    protected $casts = [
        'production_date' => 'date',
        'expiry_date' => 'date',
    ];

    // Auto-calculate profit margin (optional)
    public function getProfitMarginAttribute()
    {
        return $this->selling_price - $this->purchase_price;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }
}