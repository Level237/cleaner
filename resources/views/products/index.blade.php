@extends('layouts.store')

@section('content')
<!-- Hero Section Boutique -->
<div class="relative w-full bg-[#1a2217] max-sm:mt-[-90px] mt-[-90px] pt-32 sm:pt-40 pb-20 sm:pb-28 flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{asset('assets/product.png')}}" alt="Boutique Hero" class="w-full h-full object-cover opacity-40 object-center" />
    </div>
    
    <!-- Dark & Gradient Overlay -->
    <div class="absolute inset-0 z-10 bg-[#1a2217]/70"></div>
    <div class="absolute inset-0 z-10 bg-gradient-to-t from-[#1a2217] via-transparent to-transparent opacity-90"></div>

    <!-- Content -->
    <div class="relative z-20 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <span class="inline-block text-[#d4f977] font-medium text-xs sm:text-sm uppercase tracking-[0.2em] mb-3">
            Boutique Officielle
        </span>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-medium text-white mb-4 sm:mb-6 leading-tight">Notre Boutique</h1>
        
        <div class="w-16 h-1 bg-[#d4f977] mx-auto mb-4 sm:mb-6 rounded-full"></div>
        
        <p class="text-sm sm:text-lg lg:text-xl text-gray-300 font-normal max-w-2xl mx-auto leading-relaxed">
            Découvrez notre sélection exclusive de thés naturels, pensés pour votre bien-être et votre équilibre au quotidien.
        </p>
    </div>
</div>

<!-- Products List Section -->
<div class="bg-[#F8F9F5] py-12 sm:py-20 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Toolbar (Filters / Sort) -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 pb-6 border-b border-gray-200 gap-4">
            <div class="text-xs sm:text-sm text-gray-500 font-normal">
                Affichage de <span class="font-bold text-[#1a2217]">{{ $products->count() }}</span> sur <span class="font-bold text-[#1a2217]">{{ $products->total() }}</span> produits
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-end">
                <label for="sort" class="text-xs sm:text-sm font-medium text-gray-700 whitespace-nowrap">Trier par :</label>
                <select id="sort" class="bg-white border border-gray-200 text-gray-700 text-xs sm:text-sm rounded-xl focus:ring-[#3ab54a] focus:border-[#3ab54a] block w-auto py-2 px-3 sm:p-2.5">
                    <option>Nouveautés</option>
                    <option>Prix croissant</option>
                    <option>Prix décroissant</option>
                    <option>Meilleures ventes</option>
                </select>
            </div>
        </div>
        
        <!-- Category Filters -->
        <div class="flex items-center gap-2.5 overflow-x-auto pb-4 mb-8 -mx-4 px-4 sm:mx-0 sm:px-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            <a href="{{ route('products.index', ['category' => 'all'] + request()->except('category', 'page')) }}" 
               class="whitespace-nowrap px-4 py-2 sm:px-5 sm:py-2.5 rounded-full font-medium text-xs sm:text-sm transition-colors shrink-0 {{ !request()->has('category') || request('category') === 'all' ? 'bg-[#1a2217] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
                Tout voir
            </a>
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug] + request()->except('category', 'page')) }}" 
                   class="whitespace-nowrap px-4 py-2 sm:px-5 sm:py-2.5 rounded-full font-medium text-xs sm:text-sm transition-colors shrink-0 {{ request('category') === $category->slug ? 'bg-[#1a2217] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <!-- Products Grid: 2-columns on mobile, 4-columns on desktop -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6 lg:gap-8">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-base sm:text-lg">Aucun produit trouvé.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12 sm:mt-16">
            {{ $products->links() }}
        </div>
        
    </div>
</div>
@endsection
