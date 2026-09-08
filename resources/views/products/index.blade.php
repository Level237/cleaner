@extends('layouts.store')

@section('content')
<!-- Hero Section Boutique -->
<div class="relative w-full h-[-100vh] mt-[-80px] min-h-[500px] flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <!-- Using a placeholder pattern or a relevant image. Since we need a green overlay, we'll use a dark green color -->
        <img src="{{asset('assets/product.png')}}" alt="Boutique Hero" class="w-full h-full object-cover" />
    </div>
    
    <!-- Green Overlay -->
    <div class="absolute inset-0 z-10 bg-[#1a2217]/80 mix-blend-multiply"></div>
    <div class="absolute inset-0 z-10 bg-gradient-to-t from-[#1a2217] via-transparent to-transparent opacity-80"></div>

    <!-- Content -->
    <div class="relative z-20 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto mt-16">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-6">Notre Boutique</h1>
        
        <!-- Small underline like in the image -->
        <div class="w-16 h-1 bg-white mx-auto mb-6 rounded-full"></div>
        
        <p class="text-lg md:text-xl text-white/90 font-medium max-w-2xl mx-auto leading-relaxed">
            Découvrez notre sélection exclusive de thés naturels, pensés pour votre bien-être et votre équilibre au quotidien.
        </p>
    </div>
</div>

<!-- Products List Section -->
<div class="bg-[#F8F9F5] py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Toolbar (Filters / Sort) -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 pb-6 border-b border-gray-200 gap-4">
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
        
        <!-- Category Filters -->
        <div class="flex items-center gap-3 overflow-x-auto pb-4 mb-8" style="scrollbar-width: none;">
            <a href="{{ route('products.index', ['category' => 'all'] + request()->except('category', 'page')) }}" 
               class="whitespace-nowrap px-5 py-2.5 rounded-full font-medium text-sm transition-colors {{ !request()->has('category') || request('category') === 'all' ? 'bg-[#1a2217] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
                Tout voir
            </a>
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug] + request()->except('category', 'page')) }}" 
                   class="whitespace-nowrap px-5 py-2.5 rounded-full font-medium text-sm transition-colors {{ request('category') === $category->slug ? 'bg-[#1a2217] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Aucun produit trouvé.</p>
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
