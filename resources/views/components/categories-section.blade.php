@props(['categories'])

<section class="py-20 lg:py-32 bg-gradient-to-b from-white to-[#f4fbf5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block text-[#283324] font-semibold text-sm uppercase tracking-[0.2em]">
                Notre gamme
            </span>
            <h2 class="mt-4 text-4xl sm:text-5xl font-serif text-[#1a2217] leading-tight">
                Détox, énergie, légèreté : trouvez le thé qu'il vous faut
            </h2>
            <p class="mt-6 text-lg text-gray-600 font-light leading-relaxed">
                Chaque recette Mondays répond à un objectif bien-être précis.
                Choisissez le vôtre et laissez la magie des plantes opérer.
            </p>
        </div>

        {{-- Category Cards --}}
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @foreach ($categories->take(4) as $category)
                @php
                    $image = $category->mainImage->first();
                @endphp

                <a href="{{ url('/boutique/' . $category->slug) }}"
                   class="group relative overflow-hidden rounded-[2rem] shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 bg-[#283324] aspect-[4/5] flex flex-col justify-end">

                    {{-- Category Image --}}
                    @if ($image)
                        <img src="{{ asset('storage/' . $image->path) }}"
                             alt="{{ $image->alt_text ?? $category->name }}"
                             loading="lazy"
                             class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-90 group-hover:opacity-100">
                    @else
                        <!-- Fallback Pattern -->
                        <div class="absolute inset-0 bg-gradient-to-br from-[#435b39] to-[#1a2217] opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                    @endif

                    {{-- Elegant Dark Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1a2217] via-[#1a2217]/40 to-transparent opacity-90"></div>

                    {{-- Content --}}
                    <div class="relative z-10 p-8 transform transition-transform duration-500">
                        <h3 class="text-2xl font-serif text-white">{{ $category->name }}</h3>
                        @if($category->description)
                            <p class="mt-3 text-sm text-gray-300 line-clamp-2 font-light leading-relaxed opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                                {{ $category->description }}
                            </p>
                        @endif
                        <div class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#d4f977] transition-all duration-300 group-hover:gap-4">
                            Découvrir 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        {{-- See all button --}}
        <div class="mt-16 text-center">
            <a href="#" class="inline-flex items-center justify-center px-8 py-4 border border-[#283324]/20 text-base font-medium rounded-full text-[#283324] hover:bg-[#283324] hover:text-white transition-all duration-300 shadow-sm">
                Voir toutes les catégories
            </a>
        </div>
    </div>
</section>
