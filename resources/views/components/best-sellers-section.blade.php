@props(['products'])

<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-12">
            <div class="max-w-2xl">
                <div class="flex items-center gap-2">
                    <span class="text-[#d4f977]">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </span>
                    <span class="inline-block text-[#283324] font-semibold text-sm uppercase tracking-[0.2em]">
                        Best-sellers
                    </span>
                </div>
                <h2 class="mt-4 text-4xl sm:text-5xl font-serif text-[#1a2217] leading-tight">
                    Les thés que nos clients recommandent
                </h2>
                <p class="mt-4 text-lg text-gray-600 font-light leading-relaxed">
                    Des milliers de tasses infusées chaque jour : voici les recettes
                    préférées de la communauté Mondays.
                </p>
            </div>

            <a href="{{ url('/boutique') }}"
               class="inline-flex items-center gap-2 font-semibold text-[#283324] hover:text-[#435b39] whitespace-nowrap group pb-2 md:pb-4 transition-colors">
                Voir toute la boutique
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @forelse ($products as $product)
                <x-product-card :product="$product" />
            @empty
                <div class="col-span-full text-center py-12 text-gray-500 bg-gray-50 rounded-3xl">
                    Aucun produit pour le moment.
                </div>
            @endforelse
        </div>
    </div>
</section>
