@extends('layouts.admin')

@section('title', 'Créer une collection')

@section('header')
    <div class="flex items-center space-x-3 mb-2">
        <a href="{{ route('admin.collections.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">&larr; Retour aux collections</a>
    </div>
    <div class="flex justify-between items-center w-full">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Créer une collection</h2>
    </div>
@endsection

@section('content')
<div class="w-full max-w-7xl mx-auto" x-data="collectionManager()">
    <form action="{{ route('admin.collections.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Colonne Principale -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Informations Générales -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informations générales</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom de la collection *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug (auto si vide)</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Gestion des Produits -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Produits de la collection</h3>
                    
                    <!-- Search & Add -->
                    <div class="mb-4 relative">
                        <input type="text" x-model="searchQuery" placeholder="Rechercher un produit à ajouter..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        
                        <div x-show="searchQuery.length > 0" class="absolute z-10 w-full mt-1 bg-white shadow-lg rounded-md border border-gray-200 max-h-60 overflow-y-auto" style="display: none;">
                            <template x-for="product in filteredAvailableProducts()" :key="product.id">
                                <div @click="addProduct(product)" class="cursor-pointer px-4 py-2 hover:bg-gray-100 text-sm flex justify-between items-center">
                                    <span x-text="product.name"></span>
                                    <span class="text-blue-600 text-xs font-semibold">+ Ajouter</span>
                                </div>
                            </template>
                            <div x-show="filteredAvailableProducts().length === 0" class="px-4 py-2 text-sm text-gray-500">
                                Aucun produit trouvé.
                            </div>
                        </div>
                    </div>

                    <!-- Selected Products List -->
                    <div class="space-y-2">
                        <template x-for="(product, index) in selectedProducts" :key="product.id">
                            <div class="flex items-center justify-between p-3 bg-gray-50 border border-gray-200 rounded-lg">
                                <!-- Hidden inputs for form submission -->
                                <input type="hidden" :name="'products['+index+'][id]'" :value="product.id">
                                <input type="hidden" :name="'products['+index+'][position]'" :value="index">
                                <input type="hidden" :name="'products['+index+'][is_featured]'" :value="product.is_featured ? 1 : 0">
                                
                                <div class="flex items-center space-x-3">
                                    <!-- Handle sort (Up/Down) -->
                                    <div class="flex flex-col space-y-1">
                                        <button type="button" @click="moveUp(index)" :disabled="index === 0" class="text-gray-400 hover:text-gray-700 disabled:opacity-30">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                        </button>
                                        <button type="button" @click="moveDown(index)" :disabled="index === selectedProducts.length - 1" class="text-gray-400 hover:text-gray-700 disabled:opacity-30">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </button>
                                    </div>
                                    <span class="font-medium text-sm text-gray-900" x-text="product.name"></span>
                                </div>
                                
                                <div class="flex items-center space-x-4">
                                    <button type="button" @click="toggleFeatured(index)" :class="product.is_featured ? 'text-yellow-500' : 'text-gray-300'" class="hover:text-yellow-500 transition-colors" title="Mettre en avant">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </button>
                                    <button type="button" @click="removeProduct(index)" class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                        <div x-show="selectedProducts.length === 0" class="text-center py-6 text-sm text-gray-500 border-2 border-dashed border-gray-200 rounded-lg">
                            Aucun produit dans cette collection. Utilisez la barre de recherche ci-dessus pour en ajouter.
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Référencement (SEO)</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="seo_title" class="block text-sm font-medium text-gray-700">Titre SEO</label>
                            <input type="text" name="seo_title" id="seo_title" value="{{ old('seo_title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="seo_description" class="block text-sm font-medium text-gray-700">Description SEO</label>
                            <textarea name="seo_description" id="seo_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('seo_description') }}</textarea>
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
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_visible" name="is_visible" type="checkbox" value="1" {{ old('is_visible', true) ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_visible" class="font-medium text-gray-700">Visible en boutique</label>
                            </div>
                        </div>

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Position globale</label>
                            <input type="number" name="position" id="position" value="{{ old('position', 0) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Image principale</h3>
                    
                    <div>
                        <input type="file" name="image" id="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pb-8 mt-6">
            <a href="{{ route('admin.collections.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Annuler
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Créer la collection
            </button>
        </div>
    </form>
</div>

<script>
    function collectionManager() {
        return {
            searchQuery: '',
            allProducts: @json($products),
            selectedProducts: [],
            
            filteredAvailableProducts() {
                if (this.searchQuery === '') return [];
                const query = this.searchQuery.toLowerCase();
                return this.allProducts.filter(p => {
                    // Check if not already selected
                    const notSelected = !this.selectedProducts.find(sp => sp.id === p.id);
                    // Match query
                    const matches = p.name.toLowerCase().includes(query);
                    return notSelected && matches;
                });
            },
            
            addProduct(product) {
                this.selectedProducts.push({
                    id: product.id,
                    name: product.name,
                    is_featured: false
                });
                this.searchQuery = ''; // reset search
            },
            
            removeProduct(index) {
                this.selectedProducts.splice(index, 1);
            },
            
            moveUp(index) {
                if (index > 0) {
                    const temp = this.selectedProducts[index];
                    this.selectedProducts[index] = this.selectedProducts[index - 1];
                    this.selectedProducts[index - 1] = temp;
                }
            },
            
            moveDown(index) {
                if (index < this.selectedProducts.length - 1) {
                    const temp = this.selectedProducts[index];
                    this.selectedProducts[index] = this.selectedProducts[index + 1];
                    this.selectedProducts[index + 1] = temp;
                }
            },
            
            toggleFeatured(index) {
                this.selectedProducts[index].is_featured = !this.selectedProducts[index].is_featured;
            }
        }
    }
</script>
@endsection
