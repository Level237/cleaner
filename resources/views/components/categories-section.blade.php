@props(['categories'])

<section class="py-12 sm:py-20 lg:py-32 bg-gradient-to-b from-white to-[#f4fbf5] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block text-[#283324] font-medium text-xs sm:text-sm uppercase tracking-[0.2em]">
                Notre gamme
            </span>
            <h2 class="mt-3 sm:mt-4 text-2xl sm:text-4xl lg:text-5xl font-serif text-[#1a2217] leading-snug sm:leading-tight font-medium">
                Détox, énergie, légèreté : trouvez le thé qu'il vous faut
            </h2>
            <p class="mt-3 sm:mt-6 text-sm sm:text-lg text-gray-600 font-normal leading-relaxed">
                Chaque recette Mondays répond à un objectif bien-être précis.
                Choisissez le vôtre et laissez la magie des plantes opérer.
            </p>
        </div>

        {{-- Category Cards: Performant Horizontal Swipe on Mobile/Tablet, Grid on Desktop --}}
        <div class="mt-10 sm:mt-16 flex overflow-x-auto snap-x snap-mandatory gap-4 sm:gap-6 pb-6 -mr-4  sm:px-6 lg:mx-0 lg:px-0 lg:grid lg:grid-cols-4 lg:gap-8 lg:overflow-visible lg:pb-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
            @foreach ($categories->take(4) as $category)
                @php
                    $image = $category->mainImage->first();
                @endphp

                <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                   class="group relative overflow-hidden rounded-2xl sm:rounded-[2rem] shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 bg-[#283324] flex-none w-[64vw] sm:w-[270px] lg:w-auto aspect-[4/5] flex flex-col justify-end snap-start">

                    {{-- Category Image --}}
                    @if ($image)
                        <img src="{{ asset('storage/' . $image->path) }}"
                             alt="{{ $image->alt_text ?? $category->name }}"
                             loading="lazy"
                             decoding="async"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
                    @else
                        <!-- Fallback Pattern -->
                        <div class="absolute inset-0 bg-gradient-to-br from-[#435b39] to-[#1a2217] opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                    @endif

                    {{-- Elegant Dark Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1a2217] via-[#1a2217]/50 to-transparent opacity-90"></div>

                    {{-- Content --}}
                    <div class="relative z-10 p-5 sm:p-8 transform transition-transform duration-500">
                        <h3 class="text-xl sm:text-2xl font-serif text-white font-medium">{{ $category->name }}</h3>
                        @if($category->description)
                            <p class="mt-2 text-xs sm:text-sm text-gray-300 font-normal line-clamp-2 leading-relaxed opacity-90 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity duration-500">
                                {{ $category->description }}
                            </p>
                        @endif
                        <div class="mt-4 sm:mt-6 inline-flex items-center gap-2 text-xs sm:text-sm font-medium text-[#d4f977] transition-all duration-300 group-hover:gap-4">
                            Découvrir 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Mobile Swipe Hint --}}
       
        
        {{-- See all button --}}
        <div class="mt-10 sm:mt-16 text-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-7 py-3.5 sm:px-8 sm:py-4 border border-[#283324]/20 text-sm sm:text-base font-medium rounded-full text-[#283324] hover:bg-[#283324] hover:text-white transition-all duration-300 shadow-sm w-auto">
                Voir tous les produits
            </a>
        </div>
    </div>
</section>
