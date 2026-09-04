<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Collection;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['primaryCategory', 'variants'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->category_id, fn($q) => $q->where('primary_category_id', $request->category_id))
            ->when($request->search, fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();
            
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $collections = Collection::orderBy('name')->get();
        
        return view('admin.products.create', compact('categories', 'collections'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        // Upload image principale
        if ($request->hasFile('main_image')) {
            $data['og_image_path'] = $request->file('main_image')->store('products', 'public'); 
            // fallback for missing main_image_path in db, we use og_image_path for main image or create a media
        }
        
        // Wait, the Product model has 'og_image_path' but no 'main_image_path' in fillable! 
        // We will store the main image as a Media if needed, but since the example used 'main_image_path', let's stick to 'og_image_path' or Media.
        
        // Let's rely on the Media relation for main image as defined in the model.
        unset($data['main_image'], $data['og_image'], $data['collections'], $data['gallery_images']);

        $product = Product::create($data);

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products/main', 'public');
            $product->media()->create([
                'path' => $path,
                'role' => 'image',
                'alt_text' => $request->input('main_image_alt'),
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        }

        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('products/og', 'public');
            $product->update(['og_image_path' => $path]);
        }

        // Gestion des collections
        if ($request->has('collections')) {
            $product->collections()->sync($request->collections);
        }

        // Upload des images galerie
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('products/gallery', 'public');
                
                $product->media()->create([
                    'path' => $path,
                    'role' => 'gallery',
                    'alt_text' => $request->input("gallery_images_alt.{$index}"),
                    'is_primary' => false,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $collections = Collection::orderBy('name')->get();
        $productCollections = $product->collections->pluck('id')->toArray();
        
        return view('admin.products.edit', compact('product', 'categories', 'collections', 'productCollections'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $collections = $request->input('collections', []);

        unset($data['main_image'], $data['og_image'], $data['remove_main_image'], $data['remove_og_image'], $data['collections'], $data['gallery_images'], $data['media']);

        $product->update($data);

        // Gestion de l'image principale via Media
        if ($request->boolean('remove_main_image')) {
            $mainMedia = $product->primaryMedia;
            if ($mainMedia) {
                Storage::disk('public')->delete($mainMedia->path);
                $mainMedia->delete();
            }
        }

        if ($request->hasFile('main_image')) {
            $mainMedia = $product->primaryMedia;
            if ($mainMedia) {
                Storage::disk('public')->delete($mainMedia->path);
                $mainMedia->delete();
            }
            $path = $request->file('main_image')->store('products/main', 'public');
            $product->media()->create([
                'path' => $path,
                'role' => 'image',
                'alt_text' => $request->input('main_image_alt'),
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        } elseif ($product->primaryMedia && $request->has('main_image_alt')) {
            // Update existing main image alt text
            $product->primaryMedia->update([
                'alt_text' => $request->input('main_image_alt')
            ]);
        }

        // Image OG
        if ($request->boolean('remove_og_image') && $product->og_image_path) {
            Storage::disk('public')->delete($product->og_image_path);
            $product->update(['og_image_path' => null]);
        }

        if ($request->hasFile('og_image')) {
            if ($product->og_image_path) {
                Storage::disk('public')->delete($product->og_image_path);
            }
            $path = $request->file('og_image')->store('products/og', 'public');
            $product->update(['og_image_path' => $path]);
        }

        // Collections
        $product->collections()->sync($collections);

        // Galerie : ajouter de nouvelles images
        if ($request->hasFile('gallery_images')) {
            $lastOrder = $product->media()->where('role', 'gallery')->max('sort_order') ?? 0;
            
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('products/gallery', 'public');
                
                $product->media()->create([
                    'path' => $path,
                    'role' => 'gallery',
                    'alt_text' => $request->input("gallery_images_alt.{$index}"),
                    'is_primary' => false,
                    'sort_order' => $lastOrder + $index + 1,
                ]);
            }
        }

        // Media Alt Text Updates
        $mediaUpdates = $request->input('media', []);
        if (is_array($mediaUpdates)) {
            foreach ($mediaUpdates as $mediaId => $mediaData) {
                if (is_array($mediaData) && array_key_exists('alt_text', $mediaData)) {
                    $product->media()->where('id', $mediaId)->update([
                        'alt_text' => $mediaData['alt_text']
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}
