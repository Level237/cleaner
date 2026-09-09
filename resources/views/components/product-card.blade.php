@props(['product'])

@php
    $image = $product->primaryMedia;
    $hasPromo = $product->compare_price && $product->compare_price > $product->price;
@endphp

<a href="{{ url('/produits/' . $product->slug) }}"
   {{ $attributes->merge(['class' => 'group flex flex-col bg-white rounded-2xl sm:rounded-3xl shadow-sm duration-300 overflow-hidden border border-gray-100 h-full']) }}>

    {{-- Image Box --}}
    <div class="relative aspect-[4/5] overflow-hidden bg-[#f4fbf5] rounded-t-2xl sm:rounded-t-3xl">
        @if ($image)
            <img src="{{ asset('storage/' . $image->path) }}"
                 alt="{{ $image->alt_text ?? $product->name }}"
                 loading="lazy"
                 class="w-full h-full object-cover transition-transform duration-700 ">
        @else
            <!-- Fallback Image -->
            <div class="w-full h-full bg-gradient-to-br from-[#f4fbf5] to-[#e4f5e7] flex items-center justify-center text-4xl sm:text-6xl opacity-50">
                🍃
            </div>
        @endif

        {{-- Badges --}}
        <div class="absolute top-2.5 left-2.5 sm:top-4 sm:left-4 flex flex-col items-start gap-1 sm:gap-2 z-10">
            @if ($product->is_featured)
                <span class="bg-[#283324] text-white text-[10px] sm:text-xs font-semibold px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full shadow-sm">★ Best-seller</span>
            @endif
            @if ($product->is_new)
                <span class="bg-[#d4f977] text-[#1a2217] text-[10px] sm:text-xs font-semibold px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full shadow-sm">Nouveau</span>
            @endif
            @if ($hasPromo)
                <span class="bg-red-500 text-white text-[10px] sm:text-xs font-semibold px-2.5 py-1 sm:px-3 sm:py-1.5 rounded-full shadow-sm">Promo</span>
            @endif
        </div>
        
        {{-- Subtle Gradient Overlay on Hover --}}
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300"></div>
    </div>

    {{-- Content --}}
    <div class="flex flex-col flex-1 p-4 sm:p-6">
        {{-- Social Proof (Reviews) --}}
        <div class="flex items-center gap-1 sm:gap-1.5">
            <div class="flex text-[#3ab54a]">
                @php
                    $avgRating = round($product->average_rating);
                @endphp
                @for($i = 1; $i <= 5; $i++)
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 {{ $i <= $avgRating ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                @endfor
            </div>
            <span class="text-gray-500 text-xs font-medium ml-1">({{ $product->reviews_count }})</span>
        </div>

        <h3 class="mt-2 sm:mt-3 text-base sm:text-xl font-serif font-semibold sm:font-bold text-[#1a2217] group-hover:text-[#435b39] transition-colors line-clamp-1">
            {{ $product->name }}
        </h3>

        <p class="mt-1.5 sm:mt-2 text-xs sm:text-sm text-gray-500 line-clamp-2 leading-relaxed font-normal">
            {{ $product->description }}
        </p>

        {{-- Price + CTA --}}
        <div class="mt-auto pt-4 sm:pt-6 flex items-end justify-between gap-2">
            <div class="flex flex-col">
                @if ($hasPromo)
                    <span class="text-xs text-gray-400 line-through mb-0.5 font-normal">
                        @price($product->compare_price)
                    </span>
                @endif
                <span class="text-lg sm:text-2xl max-sm:text-sm font-bold text-[#1a2217] tracking-tight">
                    @price($product->price)
                </span>
            </div>
            
            <div class="bg-[#f4fbf5] text-[#283324] group-hover:bg-[#d4f977] group-hover:text-[#1a2217] w-9 h-9 sm:w-12 sm:h-12 rounded-full flex items-center justify-center transition-all duration-300 shadow-sm shrink-0" aria-hidden="true">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </div>
        </div>
    </div>
</a>
