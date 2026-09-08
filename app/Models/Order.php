<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'reference',
        'status',
        'payment_status',
        'payment_method',
        'first_name',
        'last_name',
        'email',
        'phone',
        'country',
        'city',
        'address',
        'postal_code',
        'notes',
        'shipping_method',
        'tracking_number',
        'currency',
        'subtotal',
        'shipping_cost',
        'discount',
        'total',
        'ip_address',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Utilisateur ayant passé la commande (peut être null si invité)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lignes de la commande
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
