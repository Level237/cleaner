<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('parent')
            ->orderBy('position')
            ->paginate(15);
            
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->get();
        
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        // Nettoyage des champs fichiers avant création
        unset($data['main_image'], $data['main_image_alt'], $data['og_image'], $data['remove_main_image'], $data['remove_og_image']);

        $category = Category::create($data);

        // Gestion de l'image principale via relation Media
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('categories/main', 'public');
            
            $category->media()->create([
                'path' => $path,
                'role' => 'image',
                'alt_text' => $request->input('main_image_alt'),
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        }

        // Gestion de l'image OG directement sur le modèle (comme Product)
        if ($request->hasFile('og_image')) {
            $path = $request->file('og_image')->store('categories/og', 'public');
            $category->update(['og_image_path' => $path]);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();
        
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        // Nettoyage avant update
        unset($data['main_image'], $data['main_image_alt'], $data['og_image'], $data['remove_main_image'], $data['remove_og_image']);

        $category->update($data);

        // Suppression de l'image principale si demandé
        if ($request->boolean('remove_main_image')) {
            $mainMedia = $category->primaryMedia;
            if ($mainMedia) {
                Storage::disk('public')->delete($mainMedia->path);
                $mainMedia->delete();
            }
        }

        // Nouvelle image principale
        if ($request->hasFile('main_image')) {
            $mainMedia = $category->primaryMedia;
            if ($mainMedia) {
                Storage::disk('public')->delete($mainMedia->path);
                $mainMedia->delete();
            }
            $path = $request->file('main_image')->store('categories/main', 'public');
            $category->media()->create([
                'path' => $path,
                'role' => 'image',
                'alt_text' => $request->input('main_image_alt'),
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        } elseif ($category->primaryMedia && $request->has('main_image_alt')) {
            $category->primaryMedia->update([
                'alt_text' => $request->input('main_image_alt')
            ]);
        }

        // Image OG
        if ($request->boolean('remove_og_image') && $category->og_image_path) {
            Storage::disk('public')->delete($category->og_image_path);
            $category->update(['og_image_path' => null]);
        }

        if ($request->hasFile('og_image')) {
            if ($category->og_image_path) {
                Storage::disk('public')->delete($category->og_image_path);
            }
            $path = $request->file('og_image')->store('categories/og', 'public');
            $category->update(['og_image_path' => $path]);
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}