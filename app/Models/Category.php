<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
       use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'is_visible',
        'position',
        'image_path',
        'image_alt',
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
     * Catégorie parente.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Catégories enfants.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Produits dont cette catégorie est la catégorie principale.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'primary_category_id');
    }

    /**
     * Images de la catégorie.
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

    /**
     * Scope catégories visibles.
     */
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }
}
