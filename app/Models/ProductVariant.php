<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'price',
        'compare_price',
        'weight_grams',
        'stock_status',
        'stock_quantity',
        'attributes',
        'is_default',
        'sort_order',
    ];

    protected $casts = [
        'attributes' => 'array',
        'is_default' => 'boolean',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'weight_grams' => 'integer',
        'stock_quantity' => 'integer',
    ];

    /**
     * Produit associé à la variante.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Variante en stock.
     */
    public function isInStock(): bool
    {
        return $this->stock_status === 'in_stock';
    }
}
