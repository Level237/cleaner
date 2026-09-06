@props(['product'])

@php
    $image = $product->mainImage->first();
    $hasPromo = $product->compare_price && $product->compare_price > $product->price;
@endphp

<a href="{{ url('/produits/' . $product->slug) }}"
   class="group flex flex-col bg-white rounded-3xl shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100">

    {{-- Image Box --}}
    <div class="relative aspect-[4/5] overflow-hidden bg-[#f4fbf5]">
        @if ($image)
            <img src="{{ asset('storage/' . $image->path) }}"
                 alt="{{ $image->alt_text ?? $product->name }}"
                 loading="lazy"
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
        @else
            <!-- Fallback Image -->
            <div class="w-full h-full bg-gradient-to-br from-[#f4fbf5] to-[#e4f5e7] flex items-center justify-center text-6xl opacity-50">
                🍃
            </div>
        @endif

        {{-- Badges --}}
        <div class="absolute top-4 left-4 flex flex-col items-start gap-2 z-10">
            @if ($product->is_featured)
                <span class="bg-[#283324] text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md">★ Best-seller</span>
            @endif
            @if ($product->is_new)
                <span class="bg-[#d4f977] text-[#1a2217] text-xs font-bold px-3 py-1.5 rounded-full shadow-md">Nouveau</span>
            @endif
            @if ($hasPromo)
                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-md">Promo</span>
            @endif
        </div>
        
        {{-- Subtle Gradient Overlay on Hover --}}
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300"></div>
    </div>

    {{-- Content --}}
    <div class="flex flex-col flex-1 p-6">
        {{-- Social Proof (Reviews) --}}
        <div class="flex items-center gap-1.5 text-sm">
            <div class="flex text-[#283324]">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>
            <span class="text-gray-500 font-medium ml-1">(128)</span>
        </div>

        <h3 class="mt-3 text-xl font-serif font-bold text-[#1a2217] group-hover:text-[#435b39] transition-colors line-clamp-1">
            {{ $product->name }}
        </h3>

        <p class="mt-2 text-sm text-gray-500 line-clamp-2 leading-relaxed">
            {{ $product->description }}
        </p>

        {{-- Price + CTA --}}
        <div class="mt-auto pt-6 flex items-end justify-between">
            <div class="flex flex-col">
                @if ($hasPromo)
                    <span class="text-xs text-gray-400 line-through mb-0.5">
                        {{ number_format($product->compare_price, 2, ',', ' ') }} €
                    </span>
                @endif
                <span class="text-2xl font-bold text-[#1a2217]">
                    {{ number_format($product->price, 2, ',', ' ') }} €
                </span>
            </div>
            
            <div class="bg-[#f4fbf5] text-[#283324] group-hover:bg-[#d4f977] group-hover:text-[#1a2217] w-12 h-12 rounded-full flex items-center justify-center transition-colors duration-300 shadow-sm" aria-hidden="true">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </div>
        </div>
    </div>
</a>
