<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CollectionRequest extends FormRequest
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
            'is_visible' => $this->has('is_visible'),
        ]);

        // Clean up products array if it comes structured weirdly
        // Actually, we'll validate products data dynamically.
    }

    public function rules(): array
    {
        $collectionId = $this->route('collection') ? $this->route('collection')->id : null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('collections')->ignore($collectionId)],
            'description' => ['nullable', 'string'],
            'is_visible' => ['boolean'],
            'position' => ['required', 'integer', 'min:0'],
            
            // SEO
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            
            // Image
            'main_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'main_image_alt' => ['nullable', 'string', 'max:255'],
            'remove_main_image' => ['nullable', 'boolean'],
            'og_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'remove_og_image' => ['nullable', 'boolean'],

            // Products sync
            'products' => ['nullable', 'array'],
            'products.*.id' => ['required', 'exists:products,id'],
            'products.*.position' => ['nullable', 'integer', 'min:0'],
            'products.*.is_featured' => ['nullable', 'boolean'],
        ];
    }
}
