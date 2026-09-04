<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use App\Http\Requests\Admin\CollectionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $collections = Collection::orderBy('position')
            ->orderBy('name')
            ->paginate(15);
            
        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('admin.collections.create', compact('products'));
    }

    public function store(CollectionRequest $request)
    {
        $data = $request->validated();
        
        $productsData = $data['products'] ?? [];
        unset($data['products'], $data['image'], $data['remove_image']);

        if ($request->hasFile('image')) {
            $data['og_image_path'] = $request->file('image')->store('collections', 'public');
        }

        $collection = Collection::create($data);

        $this->syncProducts($collection, $productsData);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection créée avec succès.');
    }

    public function edit(Collection $collection)
    {
        $products = Product::orderBy('name')->get();
        
        // Prepare attached products with pivot data
        $attachedProducts = $collection->products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'position' => $product->pivot->position,
                'is_featured' => (bool) $product->pivot->is_featured,
            ];
        })->values()->toArray();

        return view('admin.collections.edit', compact('collection', 'products', 'attachedProducts'));
    }

    public function update(CollectionRequest $request, Collection $collection)
    {
        $data = $request->validated();
        
        $productsData = $data['products'] ?? [];
        unset($data['products'], $data['image'], $data['remove_image']);

        if ($request->boolean('remove_image') && $collection->og_image_path) {
            Storage::disk('public')->delete($collection->og_image_path);
            $data['og_image_path'] = null;
        }

        if ($request->hasFile('image')) {
            if ($collection->og_image_path) {
                Storage::disk('public')->delete($collection->og_image_path);
            }
            $data['og_image_path'] = $request->file('image')->store('collections', 'public');
        }

        $collection->update($data);

        $this->syncProducts($collection, $productsData);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection modifiée avec succès.');
    }

    public function destroy(Collection $collection)
    {
        if ($collection->og_image_path) {
            Storage::disk('public')->delete($collection->og_image_path);
        }

        $collection->products()->detach();
        $collection->delete();

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection supprimée avec succès.');
    }

    private function syncProducts(Collection $collection, array $productsData)
    {
        $syncData = [];
        foreach ($productsData as $item) {
            if (isset($item['id'])) {
                $syncData[$item['id']] = [
                    'position' => $item['position'] ?? 0,
                    'is_featured' => isset($item['is_featured']) && $item['is_featured'] == 1,
                ];
            }
        }
        $collection->products()->sync($syncData);
    }
}
