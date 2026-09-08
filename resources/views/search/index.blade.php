@extends('layouts.store')

@section('content')
<div class="bg-[#F8F9F5] min-h-screen pt-32 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-12">
            <form action="{{ route('search.index') }}" method="GET" class="relative max-w-2xl">
                <input type="text" name="q" value="{{ $query }}" placeholder="Rechercher des produits, collections..." class="w-full pl-12 pr-4 py-4 rounded-2xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a] text-lg bg-white" autofocus>
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <button type="submit" class="absolute inset-y-2 right-2 px-6 bg-[#d4f977] text-[#1a2217] font-bold rounded-xl hover:bg-[#c5e865] transition-colors">
                    Chercher
                </button>
            </form>
        </div>

        @if($query)
            <div class="mb-8">
                <h1 class="text-3xl font-serif font-bold text-[#1a2217]">
                    Résultats pour "{{ $query }}"
                </h1>
                <p class="text-gray-600 mt-2">
                    {{ $products->count() + $categories->count() + $collections->count() }} résultat(s) trouvé(s)
                </p>
            </div>

            @if($products->isEmpty() && $categories->isEmpty() && $collections->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#1a2217] mb-2">Aucun résultat trouvé</h3>
                    <p class="text-gray-600">Essayez avec d'autres mots-clés ou vérifiez l'orthographe.</p>
                </div>
            @else
                
                <div class="space-y-12">
                    <!-- Produits -->
                    @if($products->isNotEmpty())
                        <section>
                            <h2 class="text-2xl font-bold text-[#1a2217] mb-6 flex items-center border-b border-gray-200 pb-2">
                                <svg class="w-6 h-6 mr-2 text-[#3ab54a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Produits ({{ $products->count() }})
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                                @foreach($products as $product)
                                    <a href="{{ route('products.show', $product->slug) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                                        <div class="aspect-square bg-gray-100 relative overflow-hidden">
                                            @if($product->primaryMedia)
                                                <img src="{{ asset('storage/' . $product->primaryMedia->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">Pas d'image</div>
                                            @endif
                                        </div>
                                        <div class="p-4">
                                            <h3 class="font-bold text-[#1a2217] truncate group-hover:text-[#3ab54a] transition-colors">{{ $product->name }}</h3>
                                            <p class="text-[#3ab54a] font-bold mt-1">@price($product->price)</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Collections -->
                    @if($collections->isNotEmpty())
                        <section>
                            <h2 class="text-2xl font-bold text-[#1a2217] mb-6 flex items-center border-b border-gray-200 pb-2">
                                <svg class="w-6 h-6 mr-2 text-[#3ab54a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                Collections ({{ $collections->count() }})
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($collections as $collection)
                                    <a href="{{ route('collections.show', $collection->slug) }}" class="group block relative rounded-2xl overflow-hidden aspect-[16/9] shadow-sm">
                                        @if($collection->media->first())
                                            <img src="{{ asset('storage/' . $collection->media->first()->path) }}" alt="{{ $collection->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                        @else
                                            <div class="absolute inset-0 bg-[#283324]"></div>
                                        @endif
                                        <div class="absolute inset-0 bg-[#d4f977]/80 mix-blend-multiply opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        <div class="absolute inset-0 p-6 flex flex-col justify-end bg-gradient-to-t from-black/80 to-transparent">
                                            <h3 class="text-xl font-bold text-white group-hover:text-[#d4f977] transition-colors">{{ $collection->name }}</h3>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Catégories -->
                    @if($categories->isNotEmpty())
                        <section>
                            <h2 class="text-2xl font-bold text-[#1a2217] mb-6 flex items-center border-b border-gray-200 pb-2">
                                <svg class="w-6 h-6 mr-2 text-[#3ab54a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                Catégories ({{ $categories->count() }})
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($categories as $category)
                                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group flex items-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 hover:border-[#3ab54a] transition-all">
                                        @if($category->media->first())
                                            <img src="{{ asset('storage/' . $category->media->first()->path) }}" alt="{{ $category->name }}" class="w-12 h-12 rounded-lg object-cover mr-4">
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 mr-4">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        <span class="font-bold text-gray-800 group-hover:text-[#3ab54a] transition-colors">{{ $category->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

            @endif
        @else
            <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
                <div class="w-20 h-20 bg-[#f4fbf5] rounded-full flex items-center justify-center mx-auto mb-4 text-[#3ab54a]">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[#1a2217] mb-2">Que recherchez-vous ?</h3>
                <p class="text-gray-600">Tapez un mot-clé ci-dessus pour rechercher parmi nos produits, nos collections et nos catégories.</p>
            </div>
        @endif

    </div>
</div>
@endsection
