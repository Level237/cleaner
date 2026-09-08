@extends('layouts.store')

@section('content')
<!-- Hero Section Collection Detail -->
<div class="relative w-full h-[50vh] min-h-[400px] flex items-center justify-center overflow-hidden pt-24">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        @if($collection->mainImage->first())
            <img src="{{ asset('storage/' . $collection->mainImage->first()->path) }}" alt="{{ $collection->name }}" class="w-full h-full object-cover" />
        @else
            <!-- Placeholder if no image -->
            <div class="w-full h-full bg-gray-200"></div>
        @endif
    </div>
    
    <!-- Lime Green Overlay (Vert Citron) -->
    <div class="absolute inset-0 z-10 bg-[#d4f977]/80 mix-blend-multiply"></div>
    <!-- A slight dark gradient at the bottom so the text stays legible, or we just rely on the lime green overlay -->
    <div class="absolute inset-0 z-10 bg-gradient-to-t from-[#1a2217]/50 via-transparent to-transparent"></div>

    <!-- Content -->
    <div class="relative z-20 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto mt-16">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-6 drop-shadow-md">{{ $collection->name }}</h1>
        
        <div class="w-16 h-1 bg-white mx-auto mb-6 rounded-full"></div>
        
        @if($collection->description)
            <p class="text-lg md:text-xl text-white font-medium max-w-2xl mx-auto leading-relaxed drop-shadow-sm">
                {{ $collection->description }}
            </p>
        @endif
    </div>
</div>

<!-- Products List Section -->
<div class="bg-[#F8F9F5] py-24 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Toolbar (Filters / Sort) -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-12 pb-6 border-b border-gray-200 gap-4">
            <div class="text-gray-500">
                Affichage de <span class="font-bold text-[#1a2217]">{{ $products->count() }}</span> sur <span class="font-bold text-[#1a2217]">{{ $products->total() }}</span> produits
            </div>
            <div class="flex items-center gap-4">
                <label for="sort" class="text-sm font-medium text-gray-700">Trier par :</label>
                <select id="sort" class="bg-white border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-[#3ab54a] focus:border-[#3ab54a] block w-full p-2.5">
                    <option>Nouveautés</option>
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                    <option>Meilleures ventes</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <div class="w-24 h-24 bg-[#f4fbf5] text-[#3ab54a] rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-[#1a2217] mb-2">Collection vide</h2>
                    <p class="text-gray-500 text-lg">Il n'y a pas encore de thés dans cette collection.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-16">
            {{ $products->links() }}
        </div>
        
    </div>
</div>
@endsection
