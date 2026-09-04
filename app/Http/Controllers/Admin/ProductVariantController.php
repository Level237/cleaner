<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index(Product $product)
    {
        $variants = $product->variants()->orderBy('sort_order')->get();
        
        return view('admin.products.variants.index', compact('product', 'variants'));
    }

    public function create(Product $product)
    {
        return view('admin.products.variants.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255', 'unique:product_variants,sku'],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'weight_grams' => ['nullable', 'integer', 'min:0'],
            'stock_status' => ['required', 'in:in_stock,out_of_stock,preorder'],
            'stock_quantity' => ['nullable', 'integer', 'min:0'],
            'attributes' => ['nullable', 'array'],
            'is_default' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_default'] = $request->has('is_default');

        // Si c'est la variante par défaut, désactiver les autres
        if ($validated['is_default']) {
            $product->variants()->update(['is_default' => false]);
        }

        $product->variants()->create($validated);

        return redirect()
            ->route('admin.products.variants.index', $product)
            ->with('success', 'Variante créée avec succès.');
    }

    public function edit(Product $product, ProductVariant $variant)
    {
        return view('admin.products.variants.edit', compact('product', 'variant'));
    }

    public function update(Request $request, Product $product, ProductVariant $variant)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255', 'unique:product_variants,sku,' . $variant->id],
            'price' => ['required', 'numeric', 'min:0'],
            'compare_price' => ['nullable', 'numeric', 'min:0'],
            'weight_grams' => ['nullable', 'integer', 'min:0'],
            'stock_status' => ['required', 'in:in_stock,out_of_stock,preorder'],
            'stock_quantity' => ['nullable', 'integer', 'min:0'],
            'attributes' => ['nullable', 'array'],
            'is_default' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_default'] = $request->has('is_default');

        // Si c'est la variante par défaut, désactiver les autres
        if ($validated['is_default']) {
            $product->variants()
                ->where('id', '!=', $variant->id)
                ->update(['is_default' => false]);
        }

        $variant->update($validated);

        return redirect()
            ->route('admin.products.variants.index', $product)
            ->with('success', 'Variante modifiée avec succès.');
    }

    public function destroy(Product $product, ProductVariant $variant)
    {
        $variant->delete();

        return redirect()
            ->route('admin.products.variants.index', $product)
            ->with('success', 'Variante supprimée avec succès.');
    }
}
