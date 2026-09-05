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
        unset($data['products'], $data['main_image'], $data['main_image_alt'], $data['og_image'], $data['remove_main_image'], $data['remove_og_image']);

        $collection = Collection::create($data);

        // Gestion de l'image principale via relation Media
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('collections/main', 'public');
            
            $collection->media()->create([
                'path' => $path,
                'role' => 'image',
                'alt_text' => $request->input('main_image_alt'),
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        }

        // Gestion de l'image OG directement sur le modèle
        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('collections/og', 'public');
            $collection->update(['og_image_path' => $path]);
        }

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
        unset($data['products'], $data['main_image'], $data['main_image_alt'], $data['og_image'], $data['remove_main_image'], $data['remove_og_image']);

        $collection->update($data);

        // Suppression de l'image principale si demandé
        if ($request->boolean('remove_main_image')) {
            $mainMedia = $collection->primaryMedia;
            if ($mainMedia) {
                Storage::disk('public')->delete($mainMedia->path);
                $mainMedia->delete();
            }
        }

        // Nouvelle image principale
        if ($request->hasFile('main_image')) {
            $mainMedia = $collection->primaryMedia;
            if ($mainMedia) {
                Storage::disk('public')->delete($mainMedia->path);
                $mainMedia->delete();
            }
            $path = $request->file('main_image')->store('collections/main', 'public');
            $collection->media()->create([
                'path' => $path,
                'role' => 'image',
                'alt_text' => $request->input('main_image_alt'),
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        } elseif ($collection->primaryMedia && $request->has('main_image_alt')) {
            $collection->primaryMedia->update([
                'alt_text' => $request->input('main_image_alt')
            ]);
        }

        // Image OG
        if ($request->boolean('remove_og_image') && $collection->og_image_path) {
            Storage::disk('public')->delete($collection->og_image_path);
            $collection->update(['og_image_path' => null]);
        }

        if ($request->hasFile('og_image')) {
            if ($collection->og_image_path) {
                Storage::disk('public')->delete($collection->og_image_path);
            }
            $path = $request->file('og_image')->store('collections/og', 'public');
            $collection->update(['og_image_path' => $path]);
        }

        $this->syncProducts($collection, $productsData);

        return redirect()
            ->route('admin.collections.index')
            ->with('success', 'Collection modifiée avec succès.');
    }

    public function destroy(Collection $collection)
    {
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
