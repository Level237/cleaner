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

        // Gestion de l'image principale
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        // Gestion de l'image OG
        if ($request->hasFile('og_image')) {
            $data['og_image_path'] = $request->file('og_image')->store('categories/og', 'public');
        }

        // Nettoyage des champs fichiers
        unset($data['image'], $data['og_image'], $data['remove_image']);

        Category::create($data);

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

        // Suppression de l'image si demandé
        if ($request->boolean('remove_image') && $category->image_path) {
            Storage::disk('public')->delete($category->image_path);
            $data['image_path'] = null;
            $data['image_alt'] = null;
        }

        // Nouvelle image principale
        if ($request->hasFile('image')) {
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }
            $data['image_path'] = $request->file('image')->store('categories', 'public');
        }

        // Nouvelle image OG
        if ($request->hasFile('og_image')) {
            if ($category->og_image_path) {
                Storage::disk('public')->delete($category->og_image_path);
            }
            $data['og_image_path'] = $request->file('og_image')->store('categories/og', 'public');
        }

        // Nettoyage
        unset($data['image'], $data['og_image'], $data['remove_image']);

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(Category $category)
    {
        // Supprime les images physiques
        if ($category->image_path) {
            Storage::disk('public')->delete($category->image_path);
        }
        
        if ($category->og_image_path) {
            Storage::disk('public')->delete($category->og_image_path);
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}