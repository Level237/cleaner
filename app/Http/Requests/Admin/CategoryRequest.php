<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('name') && !$this->filled('slug')) {
            $slug = Str::slug($this->name);
            $originalSlug = $slug;
            $counter = 1;
            
            $categoryId = $this->route('category')?->id;
            
            while (\App\Models\Category::where('slug', $slug)
                ->when($categoryId, fn($q) => $q->where('id', '!=', $categoryId))
                ->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
            
            $this->merge(['slug' => $slug]);
        }
        
        $this->merge([
            'is_visible' => $this->boolean('is_visible'),
        ]);
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($categoryId)],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'is_visible' => ['boolean'],
            'position' => ['required', 'integer', 'min:0'],
            
            // Image
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'remove_image' => ['nullable', 'boolean'],
            
            // SEO
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:500'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            'og_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
            'image.mimes' => 'Formats acceptés : JPEG, PNG, JPG, GIF, WebP.',
        ];
    }
}