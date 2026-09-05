<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_visible',
        'position',
        'seo_title',
        'seo_description',
        'canonical_url',
        'og_image_path',
        'structured_data',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'position' => 'integer',
        'structured_data' => 'array',
    ];

    /**
     * Route model binding par slug.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Produits de la collection.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'collection_product')
            ->withPivot([
                'position',
                'is_featured',
            ])
            ->withTimestamps()
            ->orderByPivot('position');
    }

    /**
     * Produits mis en avant dans la collection.
     */
    public function featuredProducts(): BelongsToMany
    {
        return $this->products()
            ->wherePivot('is_featured', true);
    }

    /**
     * Images de la collection.
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
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

    public function primaryMedia()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('is_primary', true)
            ->orderBy('sort_order');
    }

    /**
     * Collections visibles.
     */
    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_visible', true);
    }
}
