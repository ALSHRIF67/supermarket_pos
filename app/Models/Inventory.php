<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['product_id', 'quantity', 'minimum_stock_alert', 'unit_type'];

    protected $casts = [
        'quantity' => 'integer',
        'minimum_stock_alert' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scope for low stock
    public function scopeLowStock($query)
    {
        return $query->whereRaw('quantity <= minimum_stock_alert');
    }
}
