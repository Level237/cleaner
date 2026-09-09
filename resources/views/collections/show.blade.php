@extends('layouts.store')

@section('content')
<!-- Hero Section Collection Detail -->
<div class="relative w-full bg-[#1a2217] pt-28 sm:pt-36 lg:pt-40 pb-16 sm:pb-24 lg:pb-28 text-white overflow-hidden text-center">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0 opacity-40">
        @if($collection->mainImage->first())
            <img src="{{ asset('storage/' . $collection->mainImage->first()->path) }}" alt="{{ $collection->name }}" class="w-full h-full object-cover" />
        @else
            <div class="w-full h-full bg-[#283324]"></div>
        @endif
    </div>
    
    <!-- Editorial Gradient Overlays -->
    <div class="absolute inset-0 z-10 bg-gradient-to-b from-[#1a2217]/80 via-[#1a2217]/60 to-[#1a2217]"></div>

    <!-- Content -->
    <div class="relative z-20 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="inline-block text-[11px] sm:text-xs font-semibold uppercase tracking-[0.2em] text-[#d4f977] mb-3 sm:mb-4 bg-[#283324]/80 backdrop-blur-sm px-3.5 py-1 rounded-full border border-[#d4f977]/20">
            Collection Exclusives
        </span>
        <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl font-medium tracking-tight text-white mb-4 sm:mb-6 leading-tight">
            {{ $collection->name }}
        </h1>
        
        <div class="w-12 sm:w-16 h-0.5 bg-[#d4f977]/60 mx-auto mb-4 sm:mb-6 rounded-full"></div>
        
        @if($collection->description)
            <p class="text-sm sm:text-base lg:text-lg text-gray-300 font-normal max-w-2xl mx-auto leading-relaxed">
                {{ $collection->description }}
            </p>
        @endif
    </div>
</div>

<!-- Products List Section -->
<div class="bg-[#F8F9F5] py-10 sm:py-16 lg:py-20 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Toolbar (Filters / Sort) -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 sm:mb-12 pb-4 sm:pb-6 border-b border-gray-200/80 gap-3 sm:gap-4">
            <div class="text-xs sm:text-sm text-gray-500 font-normal">
                Affichage de <span class="font-semibold text-[#1a2217]">{{ $products->count() }}</span> sur <span class="font-semibold text-[#1a2217]">{{ $products->total() }}</span> produits
            </div>
            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                <label for="sort" class="text-xs sm:text-sm font-medium text-gray-700 whitespace-nowrap">Trier par :</label>
                <select id="sort" class="bg-white border border-gray-200 text-gray-800 text-xs sm:text-sm rounded-xl focus:ring-[#1a2217] focus:border-[#1a2217] block w-full sm:w-auto px-3 py-2 font-normal shadow-sm">
                    <option>Nouveautés</option>
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                    <option>Meilleures ventes</option>
                </select>
            </div>
        </div>

        <!-- Products Grid (2-columns on mobile, 4-columns on desktop) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6 lg:gap-8">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12 sm:py-16 bg-white rounded-2xl sm:rounded-3xl border border-gray-100 shadow-sm px-4">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[#f4fbf5] text-[#435b39] rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-serif font-medium text-[#1a2217] mb-2">Collection vide</h2>
                    <p class="text-gray-500 text-xs sm:text-sm max-w-md mx-auto">Il n'y a pas encore de thés disponibles dans cette collection.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-10 sm:mt-16">
            {{ $products->links() }}
        </div>
        
    </div>
</div>
@endsection

