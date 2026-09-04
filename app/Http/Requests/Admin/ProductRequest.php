<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('name') && !$this->filled('slug')) {
            $this->merge([
                'slug' => Str::slug($this->name)
            ]);
        }
        
        $this->merge([
            'is_featured' => $this->has('is_featured'),
            'is_new' => $this->has('is_new'),
            'currency' => $this->input('currency', 'EUR'),
            'status' => $this->input('status', 'draft'),
            'stock_status' => $this->input('stock_status', 'in_stock'),
        ]);
    }

    public function rules(): array
    {
        $productId = $this->route('product') ? $this->route('product')->id : null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($productId)],
            'sku' => ['nullable', 'string', 'max:255', Rule::unique('products')->ignore($productId)],
            'primary_category_id' => ['nullable', 'exists:categories,id'],
            'collections' => ['nullable', 'array'],
            'collections.*' => ['exists:collections,id'],
            'status' => ['required', 'string', 'in:draft,published,archived'],
            'published_at' => ['nullable', 'date'],
            'is_featured' => ['boolean'],
            'is_new' => ['boolean'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            
            // Propriétés du thé
            'tea_family' => ['nullable', 'string', 'max:255'],
            'origin' => ['nullable', 'string', 'max:255'],
            'harvest' => ['nullable', 'string', 'max:255'],
            'tasting_notes' => ['nullable', 'array'],
            'tasting_notes.*' => ['string'],
            'ingredients' => ['nullable', 'array'],
            'ingredients.*' => ['string'],
            'brewing_temp_celsius' => ['nullable', 'integer'],
            'brewing_time' => ['nullable', 'string', 'max:255'],
            'caffeine_level' => ['nullable', 'string', 'max:255'],
            
            // Prix
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            
            // Stock
            'stock_status' => ['required', 'string', 'in:in_stock,out_of_stock,preorder'],
            'stock_quantity' => ['nullable', 'integer', 'min:0'],
            
            // SEO
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            
            // Images
            'main_image' => ['nullable', 'image', 'max:2048'],
            'main_image_alt' => ['nullable', 'string', 'max:255'],
            'remove_main_image' => ['nullable', 'boolean'],
            'og_image' => ['nullable', 'image', 'max:2048'],
            'remove_og_image' => ['nullable', 'boolean'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'max:2048'],
            
            // Media Updates
            'media' => ['nullable', 'array'],
            'media.*.alt_text' => ['nullable', 'string', 'max:255'],
        ];
    }
}
