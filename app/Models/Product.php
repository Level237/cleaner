<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
        use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'primary_category_id',
        'status',
        'published_at',
        'is_featured',
        'is_new',
        'short_description',
        'description',
        'tea_family',
        'origin',
        'harvest',
        'tasting_notes',
        'ingredients',
        'brewing_temp_celsius',
        'brewing_time',
        'caffeine_level',
        'badges',
        'price',
        'compare_price',
        'currency',
        'stock_status',
        'stock_quantity',
        'seo_title',
        'seo_description',
        'canonical_url',
        'og_image_path',
        'structured_data',
        'meta',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'tasting_notes' => 'array',
        'ingredients' => 'array',
        'badges' => 'array',
        'structured_data' => 'array',
        'meta' => 'array',
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
    ];

    /**
     * Route model binding par slug.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Catégorie principale.
     */
    public function primaryCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'primary_category_id');
    }

    /**
     * Variantes du produit.
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Variante par défaut.
     */
    public function defaultVariant(): HasOne
    {
        return $this->hasOne(ProductVariant::class)
            ->where('is_default', true)
            ->orderBy('sort_order');
    }

    /**
     * Collections associées au produit.
     */
    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'collection_product')
            ->withPivot([
                'position',
                'is_featured',
            ])
            ->withTimestamps();
    }

    /**
     * Images du produit.
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function primaryMedia(): MorphOne
{
    return $this->morphOne(Media::class, 'mediable')
        ->where('is_primary', true)
        ->orderBy('sort_order');
}

public function fallbackMedia(): MorphOne
{
    return $this->morphOne(Media::class, 'mediable')
        ->orderBy('sort_order');
}

public function setPrimaryMedia(Media $media): void
{
    $this->media()
        ->where('is_primary', true)
        ->where('id', '!=', $media->id)
        ->update([
            'is_primary' => false,
        ]);

    $media->update([
        'is_primary' => true,
    ]);
}

public function getMainImageAttribute(): ?Media
{
    return $this->primaryMedia ?? $this->fallbackMedia;
}
    /**
     * Image principale.
     */
    public function mainImage(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')
            ->where('role', 'image')
            ->orderBy('sort_order');
    }

    /**
     * Images galerie.
     */
    public function galleryImages(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')
            ->where('role', 'gallery')
            ->orderBy('sort_order');
    }

    public function ogImage(): MorphOne
{
    return $this->morphOne(Media::class, 'mediable')
        ->where('role', 'og_image')
        ->orderBy('sort_order');
}

    /**
     * Produit publié.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where(function (Builder $query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    /**
     * Produits mis en avant.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Produits en stock.
     */
    public function scopeInStock(Builder $query): Builder
    {
        return $query->where('stock_status', 'in_stock');
    }
}
