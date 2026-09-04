@extends('layouts.admin')

@section('title', 'Modifier le produit')

@section('header')
    <div class="flex justify-between items-center w-full">
        <div>Modifier : {{ $product->name }}</div>
        <a href="{{ route('admin.products.variants.index', $product) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
            Gérer les variantes
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Colonne Principale -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informations Générales -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informations générales</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom du produit *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                                <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('sku') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label for="short_description" class="block text-sm font-medium text-gray-700">Description courte</label>
                            <textarea name="short_description" id="short_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('short_description', $product->short_description) }}</textarea>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description complète</label>
                            <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Propriétés du thé -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Caractéristiques (Thé)</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tea_family" class="block text-sm font-medium text-gray-700">Famille de thé</label>
                            <input type="text" name="tea_family" id="tea_family" value="{{ old('tea_family', $product->tea_family) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="origin" class="block text-sm font-medium text-gray-700">Origine</label>
                            <input type="text" name="origin" id="origin" value="{{ old('origin', $product->origin) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="harvest" class="block text-sm font-medium text-gray-700">Récolte</label>
                            <input type="text" name="harvest" id="harvest" value="{{ old('harvest', $product->harvest) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="caffeine_level" class="block text-sm font-medium text-gray-700">Niveau de caféine</label>
                            <input type="text" name="caffeine_level" id="caffeine_level" value="{{ old('caffeine_level', $product->caffeine_level) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="brewing_temp_celsius" class="block text-sm font-medium text-gray-700">Temp. d'infusion (°C)</label>
                            <input type="number" name="brewing_temp_celsius" id="brewing_temp_celsius" value="{{ old('brewing_temp_celsius', $product->brewing_temp_celsius) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="brewing_time" class="block text-sm font-medium text-gray-700">Temps d'infusion</label>
                            <input type="text" name="brewing_time" id="brewing_time" value="{{ old('brewing_time', $product->brewing_time) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Images</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="main_image" class="block text-sm font-medium text-gray-700">Image principale</label>
                            @if($product->primaryMedia)
                                <div class="mt-2 mb-2 flex items-center space-x-4">
                                    <img src="{{ Storage::url($product->primaryMedia->path) }}" alt="Image principale" class="h-24 w-24 rounded-lg object-cover">
                                    <label class="inline-flex items-center text-sm text-red-600">
                                        <input type="checkbox" name="remove_main_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500 mr-2">
                                        Supprimer l'image actuelle
                                    </label>
                                </div>
                            @endif
                            <input type="file" name="main_image" id="main_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                        
                        <div class="pt-4 border-t border-gray-100">
                            <label for="gallery_images" class="block text-sm font-medium text-gray-700">Galerie d'images (ajouter)</label>
                            
                            @if($product->media->where('role', 'gallery')->count() > 0)
                                <div class="mt-2 mb-4 grid grid-cols-4 gap-2">
                                    @foreach($product->media->where('role', 'gallery') as $media)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($media->path) }}" alt="Galerie" class="h-20 w-full rounded-lg object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Référencement (SEO)</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="seo_title" class="block text-sm font-medium text-gray-700">Titre SEO</label>
                            <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $product->seo_title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="seo_description" class="block text-sm font-medium text-gray-700">Description SEO</label>
                            <textarea name="seo_description" id="seo_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('seo_description', $product->seo_description) }}</textarea>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Colonne Latérale -->
            <div class="space-y-6">
                <!-- Statut & Visibilité -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Statut</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut *</label>
                            <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Brouillon</option>
                                <option value="published" {{ old('status', $product->status) == 'published' ? 'selected' : '' }}>Publié</option>
                                <option value="archived" {{ old('status', $product->status) == 'archived' ? 'selected' : '' }}>Archivé</option>
                            </select>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_featured" class="font-medium text-gray-700">Mettre en vedette</label>
                                <p class="text-gray-500">Afficher ce produit en page d'accueil</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_new" name="is_new" type="checkbox" value="1" {{ old('is_new', $product->is_new) ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_new" class="font-medium text-gray-700">Nouveau produit</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarification & Stock -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Tarification & Stock</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Prix unitaire</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">{{ $product->currency ?? '€' }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="compare_price" class="block text-sm font-medium text-gray-700">Prix barré (comparaison)</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="number" step="0.01" name="compare_price" id="compare_price" value="{{ old('compare_price', $product->compare_price) }}" class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">{{ $product->currency ?? '€' }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="stock_status" class="block text-sm font-medium text-gray-700">État du stock</label>
                            <select name="stock_status" id="stock_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="in_stock" {{ old('stock_status', $product->stock_status) == 'in_stock' ? 'selected' : '' }}>En stock</option>
                                <option value="out_of_stock" {{ old('stock_status', $product->stock_status) == 'out_of_stock' ? 'selected' : '' }}>Rupture</option>
                                <option value="preorder" {{ old('stock_status', $product->stock_status) == 'preorder' ? 'selected' : '' }}>Précommande</option>
                            </select>
                        </div>

                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Quantité</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Organisation -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Organisation</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="primary_category_id" class="block text-sm font-medium text-gray-700">Catégorie principale</label>
                            <select name="primary_category_id" id="primary_category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Sélectionnez...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('primary_category_id', $product->primary_category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="collections" class="block text-sm font-medium text-gray-700 mb-2">Collections</label>
                            <div class="space-y-2 max-h-48 overflow-y-auto border border-gray-200 rounded-md p-3">
                                @foreach($collections as $collection)
                                    <div class="flex items-center">
                                        <input type="checkbox" name="collections[]" id="collection_{{ $collection->id }}" value="{{ $collection->id }}" {{ in_array($collection->id, old('collections', $productCollections)) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="collection_{{ $collection->id }}" class="ml-2 block text-sm text-gray-900">
                                            {{ $collection->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="flex justify-end space-x-3 pb-8 mt-6">
            <a href="{{ route('admin.products.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Annuler
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Mettre à jour le produit
            </button>
        </div>
    </form>
</div>
@endsection
