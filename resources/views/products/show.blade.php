@extends('layouts.store')

@section('content')
<div class="relative bg-[#F8F9F5] min-h-screen pb-24">
    <!-- Hero Atmospheric Glow -->
    <div class="absolute inset-x-0 top-0 h-[50vh] overflow-hidden pointer-events-none z-0">
        @if($product->primaryMedia)
            <img src="{{ asset('storage/' . $product->primaryMedia->path) }}" class="w-full h-full object-cover opacity-[0.03] blur-3xl transform scale-125" alt="" aria-hidden="true">
        @endif
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#F8F9F5]/80 to-[#F8F9F5]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32">
        
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}" class="hover:text-[#3ab54a] transition-colors">Accueil</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ url('/boutique') }}" class="hover:text-[#3ab54a] transition-colors">Boutique</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-gray-900 font-medium">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            
            <!-- Left: Product Media Gallery -->
            <div class="flex flex-col-reverse lg:flex-row gap-4 lg:gap-6 lg:sticky lg:top-32 h-fit" x-data="{
                activeImage: '{{ $product->primaryMedia ? asset('storage/' . $product->primaryMedia->path) : '' }}',
                images: [
                    @foreach($product->media as $media)
                        '{{ asset('storage/' . $media->path) }}',
                    @endforeach
                ]
            }">
                <!-- Thumbnails -->
                @if($product->media->count() > 1)
                <div class="flex lg:flex-col gap-3 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 w-full lg:w-24 shrink-0" style="scrollbar-width: none;">
                    <template x-for="(img, index) in images" :key="index">
                        <button @click="activeImage = img" 
                                :class="{'ring-2 ring-[#3ab54a]': activeImage === img, 'ring-1 ring-gray-200 opacity-70': activeImage !== img}"
                                class="relative w-20 h-24 lg:w-full lg:h-28 rounded-xl overflow-hidden shrink-0 hover:opacity-100 transition-all">
                            <img :src="img" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
                @endif
                
                <!-- Main Image -->
                <div class="w-full aspect-[4/5] bg-white rounded-3xl overflow-hidden relative border border-gray-100 group shadow-sm flex-1">
                    @if($product->is_featured)
                        <span class="absolute top-4 left-4 bg-[#283324] text-white text-xs font-bold px-3 py-1.5 rounded-full z-10 shadow-md">★ Best-seller</span>
                    @endif
                    @if($product->compare_price > $product->price)
                        <span class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full z-10 shadow-md">Promo</span>
                    @endif
                    
                    <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" x-show="activeImage">
                    <div x-show="!activeImage" class="w-full h-full bg-gradient-to-br from-[#f4fbf5] to-[#e4f5e7] flex items-center justify-center text-8xl opacity-50">
                        🍃
                    </div>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="mt-10 px-4 sm:px-0 lg:mt-0 lg:pl-8 flex flex-col justify-center">
                @if($product->primaryCategory)
                    <div class="mb-3">
                        <span class="inline-flex items-center rounded-full bg-[#d4f977]/20 px-3 py-1 text-sm font-semibold text-[#3ab54a]">
                            {{ $product->primaryCategory->name }}
                        </span>
                    </div>
                @endif
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-serif font-extrabold text-[#1a2217] tracking-tight">{{ $product->name }}</h1>
                
                <!-- Reviews -->
                <div class="mt-4 flex items-center gap-2">
                    <div class="flex text-[#3ab54a]">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                    <a href="#reviews" class="text-sm font-medium text-gray-500 hover:text-brand-500">128 avis clients</a>
                </div>

                <div class="mt-6 flex items-end gap-3">
                    <p class="text-3xl text-[#1a2217] font-bold">@price($product->price)</p>
                    @if($product->compare_price > $product->price)
                        <p class="text-lg text-gray-400 line-through mb-1">@price($product->compare_price)</p>
                    @endif
                </div>

                <div class="mt-6 text-base text-gray-600 leading-relaxed space-y-4">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <!-- Variants / Options (If any) -->
                <div x-data="{ 
                    selectedVariant: {{ $product->variants->count() > 0 ? $product->variants->first()->id : 'null' }},
                    qty: 1,
                    isAdding: false,
                    addToCart() {
                        this.isAdding = true;
                        return fetch('{{ route('cart.add') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                product_id: {{ $product->id }},
                                quantity: this.qty,
                                variant_id: this.selectedVariant
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.isAdding = false;
                            if (data.success) {
                                // Dispatch event to update cart count in header
                                window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cartCount }}));
                                
                                const btn = this.$refs.addBtn;
                                const originalText = btn.innerHTML;
                                btn.innerHTML = '✔ Ajouté !';
                                btn.classList.add('!bg-[#3ab54a]', '!text-white');
                                
                                // Optional: Redirect to cart if it's the 'commander maintenant' button
                                // But for 'Ajouter', just show feedback
                                setTimeout(() => {
                                    btn.innerHTML = originalText;
                                    btn.classList.remove('!bg-[#3ab54a]', '!text-white');
                                }, 2000);
                            }
                        })
                        .catch(err => {
                            this.isAdding = false;
                            alert('Une erreur est survenue.');
                        });
                    }
                }">
                    @if($product->variants->count() > 0)
                    <div class="mt-8 border-t border-gray-100 pt-8">
                        <h3 class="text-sm font-medium text-gray-900">Format</h3>
                        <div class="mt-4 grid grid-cols-3 gap-3">
                            @foreach($product->variants as $variant)
                            <button type="button" @click="selectedVariant = {{ $variant->id }}"
                                    :class="{'ring-2 ring-[#3ab54a] bg-green-50': selectedVariant === {{ $variant->id }}, 'ring-1 ring-gray-200 bg-white hover:bg-gray-50': selectedVariant !== {{ $variant->id }}}"
                                    class="rounded-xl p-3 flex flex-col items-center justify-center text-center transition-all">
                                <span class="text-sm font-medium text-gray-900">{{ $variant->name }}</span>
                                @if($variant->price)
                                    <span class="text-xs text-gray-500 mt-1">+ @price($variant->price)</span>
                                @endif
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <form @submit.prevent="addToCart" class="mt-8">
                        <!-- Quantity & Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex items-center border border-gray-200 rounded-xl bg-white p-1">
                                <button type="button" @click="if(qty > 1) qty--" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-[#1a2217] hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </button>
                                <input type="number" name="quantity" x-model="qty" class="w-12 text-center border-0 text-[#1a2217] font-bold focus:ring-0 p-0 text-lg" min="1">
                                <button type="button" @click="qty++" class="w-12 h-12 flex items-center justify-center text-gray-500 hover:text-[#1a2217] hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                            
                            <button type="submit" x-ref="addBtn" :disabled="isAdding" class="flex-1 bg-[#1a2217] text-white hover:bg-[#283324] disabled:opacity-70 px-8 py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 transition-all transform active:scale-[0.98] shadow-lg shadow-black/10">
                                <span x-show="isAdding" class="inline-block animate-spin mr-2">
                                    <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                </span>
                                <span x-show="!isAdding" class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Ajouter au panier
                                </span>
                            </button>
                        </div>

                        <!-- Buy Now CTA -->
                        <button type="button" @click="addToCart().then(() => window.location.href = '{{ route('cart.index') }}')" class="mt-3 w-full bg-[#d4f977] text-[#1a2217] hover:bg-[#c2e666] px-8 py-4 rounded-xl font-bold text-lg transition-transform transform active:scale-[0.98] shadow-sm">
                            Commander maintenant
                        </button>
                    </form>
                </div>

                <!-- Trust Badges -->
                <div class="mt-8 grid grid-cols-2 gap-4 border-t border-gray-100 pt-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#e4f5e7] rounded-full flex items-center justify-center text-[#3ab54a] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Paiement 100% sécurisé</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#e4f5e7] rounded-full flex items-center justify-center text-[#3ab54a] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Satisfait ou remboursé</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#e4f5e7] rounded-full flex items-center justify-center text-[#3ab54a] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Expédition en 24h</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#e4f5e7] rounded-full flex items-center justify-center text-[#3ab54a] shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Service client réactif</span>
                    </div>
                </div>

                <!-- Product Details Accordion -->
                <div class="mt-8 border-t border-gray-100 divide-y divide-gray-100" x-data="{ active: 1 }">
                    <div class="py-4">
                        <button @click="active = (active === 1 ? null : 1)" class="flex w-full items-center justify-between text-left focus:outline-none">
                            <span class="text-base font-bold text-gray-900">Ingrédients & Bienfaits</span>
                            <span class="ml-6 flex items-center">
                                <svg class="h-5 w-5 text-gray-400 transition-transform duration-200" :class="{'rotate-180': active === 1}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </button>
                        <div x-show="active === 1"  class="pt-4 text-sm text-gray-600 leading-relaxed" style="display: none;">
                            Ce mélange exclusif a été formulé pour vous apporter tous les bienfaits de la nature. Une synergie de plantes sélectionnées avec soin pour une efficacité optimale et un goût inoubliable.
                        </div>
                    </div>
                    <div class="py-4">
                        <button @click="active = (active === 2 ? null : 2)" class="flex w-full items-center justify-between text-left focus:outline-none">
                            <span class="text-base font-bold text-gray-900">Conseils d'utilisation</span>
                            <span class="ml-6 flex items-center">
                                <svg class="h-5 w-5 text-gray-400 transition-transform duration-200" :class="{'rotate-180': active === 2}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </button>
                        <div x-show="active === 2"  class="pt-4 text-sm text-gray-600 leading-relaxed" style="display: none;">
                            Infusez un sachet dans 250ml d'eau frémissante (90°C) pendant 3 à 5 minutes selon votre goût. Peut se consommer chaud ou glacé.
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
</div>
@endsection
