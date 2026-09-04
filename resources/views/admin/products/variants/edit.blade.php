@extends('layouts.admin')

@section('title', 'Modifier la variante')

@section('header')
    <div class="flex items-center space-x-3 mb-2">
        <a href="{{ route('admin.products.variants.index', $product) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">&larr; Retour aux variantes</a>
    </div>
    <div class="flex justify-between items-center w-full">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Modifier : {{ $variant->name }}</h2>
    </div>
@endsection

@section('content')
<div class="w-full max-w-7xl mx-auto">
    <form action="{{ route('admin.products.variants.update', [$product, $variant]) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Modifier la variante pour : {{ $product->name }}</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom de la variante *</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $variant->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- SKU -->
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700">SKU de la variante</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $variant->sku) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('sku') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                
                <!-- Prix -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix unitaire *</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $variant->price) }}" required class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">€</span>
                        </div>
                    </div>
                    @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Prix comparé -->
                <div>
                    <label for="compare_price" class="block text-sm font-medium text-gray-700">Prix barré</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" step="0.01" name="compare_price" id="compare_price" value="{{ old('compare_price', $variant->compare_price) }}" class="block w-full rounded-md border-gray-300 pl-3 pr-12 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">€</span>
                        </div>
                    </div>
                </div>

                <!-- Poids -->
                <div>
                    <label for="weight_grams" class="block text-sm font-medium text-gray-700">Poids (en grammes)</label>
                    <input type="number" name="weight_grams" id="weight_grams" value="{{ old('weight_grams', $variant->weight_grams) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700">Ordre d'affichage</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $variant->sort_order) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>

                <!-- Stock Status -->
                <div>
                    <label for="stock_status" class="block text-sm font-medium text-gray-700">État du stock *</label>
                    <select name="stock_status" id="stock_status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="in_stock" {{ old('stock_status', $variant->stock_status) == 'in_stock' ? 'selected' : '' }}>En stock</option>
                        <option value="out_of_stock" {{ old('stock_status', $variant->stock_status) == 'out_of_stock' ? 'selected' : '' }}>Rupture</option>
                        <option value="preorder" {{ old('stock_status', $variant->stock_status) == 'preorder' ? 'selected' : '' }}>Précommande</option>
                    </select>
                </div>

                <!-- Stock Quantity -->
                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Quantité en stock</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $variant->stock_quantity) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                </div>

                <!-- Is Default -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_default" id="is_default" value="1" {{ old('is_default', $variant->is_default) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_default" class="ml-2 block text-sm text-gray-900">
                            Définir comme variante par défaut (sélectionnée automatiquement)
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.products.variants.index', $product) }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Annuler
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Mettre à jour la variante
            </button>
        </div>
    </form>
</div>
@endsection
