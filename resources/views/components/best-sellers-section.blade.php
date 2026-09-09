@props(['products'])

<section class="py-12 sm:py-20 lg:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 sm:gap-6 mb-8 sm:mb-12">
            <div class="max-w-2xl">
                <div class="flex items-center gap-2">
                    <span class="text-[#d4f977]">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </span>
                    <span class="inline-block text-[#283324] font-medium text-xs sm:text-sm uppercase tracking-[0.2em]">
                        Best-sellers
                    </span>
                </div>
                <h2 class="mt-3 sm:mt-4 text-2xl sm:text-4xl lg:text-5xl font-serif text-[#1a2217] leading-snug sm:leading-tight font-medium">
                    Les thés que nos clients recommandent
                </h2>
                <p class="mt-3 sm:mt-4 text-sm sm:text-lg text-gray-600 font-normal leading-relaxed">
                    Des milliers de tasses infusées chaque jour : voici les recettes
                    préférées de la communauté Mondays.
                </p>
            </div>

            <a href="{{ url('/boutique') }}"
               class="hidden md:inline-flex items-center gap-2 font-medium text-sm sm:text-base text-[#283324] hover:text-[#435b39] whitespace-nowrap group pb-2 md:pb-4 transition-colors">
                Voir toute la boutique
                <svg class="w-4 h-4 sm:w-5 sm:h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        {{-- Products Grid: Performant Horizontal Swipe on Mobile/Tablet, Grid on Desktop --}}
        <div class="mt-8 sm:mt-12 ml-1 flex overflow-x-auto snap-x snap-mandatory gap-4 sm:gap-6 pb-6 -mx-4 pl-6 pr-6 sm:px-6 lg:mx-0 lg:px-0 lg:grid lg:grid-cols-4 lg:gap-8 lg:overflow-visible lg:pb-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            @forelse ($products as $product)
                <div class="flex-none w-[64vw] sm:w-[270px] lg:w-auto snap-start flex flex-col">
                    <x-product-card :product="$product" />
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500 bg-gray-50 rounded-3xl w-full">
                    Aucun produit pour le moment.
                </div>
            @endforelse
        </div>

        

        {{-- Mobile Bottom CTA --}}
        <div class="mt-8 text-center md:hidden">
            <a href="{{ url('/boutique') }}"
               class="inline-flex items-center justify-center px-7 py-3.5 border border-[#283324]/20 text-sm font-medium rounded-full text-[#283324] hover:bg-[#283324] hover:text-white transition-all duration-300 shadow-sm w-auto gap-2">
                Voir  la boutique
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
    </div>
</section>
