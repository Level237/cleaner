@extends('layouts.store')

@section('content')
<div class="relative bg-[#F8F9F5] min-h-screen pb-16 sm:pb-24">
    <!-- Hero Atmospheric Glow -->
    <div class="absolute inset-x-0 top-0 h-[50vh] overflow-hidden pointer-events-none z-0 opacity-40">
        @if($product->primaryMedia)
            <img src="{{ asset('storage/' . $product->primaryMedia->path) }}" class="w-full h-full object-cover opacity-[0.05] blur-3xl transform scale-125" alt="" aria-hidden="true">
        @endif
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#F8F9F5]/80 to-[#F8F9F5]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 sm:pt-32">
        
        <!-- Breadcrumb -->
        <nav class="flex text-xs sm:text-sm text-gray-500 mb-6 sm:mb-8 overflow-x-auto pb-1" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1.5 sm:space-x-3 whitespace-nowrap">
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}" class="hover:text-[#1a2217] transition-colors">Accueil</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3.5 h-3.5 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <a href="{{ url('/boutique') }}" class="hover:text-[#1a2217] transition-colors">Boutique</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3.5 h-3.5 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="text-[#1a2217] font-medium truncate max-w-[200px] sm:max-w-none">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16 items-start">
            
            <!-- Left: Product Media Gallery -->
            <div class="flex flex-col-reverse lg:flex-row gap-4 lg:gap-6 lg:sticky lg:top-28 h-fit" x-data="{
                activeImage: '{{ $product->primaryMedia ? asset('storage/' . $product->primaryMedia->path) : '' }}',
                images: [
                    @foreach($product->media as $media)
                        '{{ asset('storage/' . $media->path) }}',
                    @endforeach
                ]
            }">
                <!-- Thumbnails -->
                @if($product->media->count() > 1)
                <div class="flex lg:flex-col gap-2.5 sm:gap-3 overflow-x-auto lg:overflow-visible pb-2 lg:pb-0 w-full lg:w-24 shrink-0" style="scrollbar-width: none;">
                    <template x-for="(img, index) in images" :key="index">
                        <button @click="activeImage = img" 
                                :class="{'ring-2 ring-[#1a2217]': activeImage === img, 'ring-1 ring-gray-200 opacity-70': activeImage !== img}"
                                class="relative w-16 h-20 sm:w-20 sm:h-24 lg:w-full lg:h-28 rounded-xl overflow-hidden shrink-0 hover:opacity-100 transition-all">
                            <img :src="img" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
                @endif
                
                <!-- Main Image -->
                <div class="w-full aspect-[4/5] bg-white rounded-2xl sm:rounded-3xl overflow-hidden relative border border-gray-100 group shadow-sm flex-1">
                    @if($product->is_featured)
                        <span class="absolute top-4 left-4 bg-[#1a2217] text-white text-[11px] sm:text-xs font-medium px-3 py-1 rounded-full z-10 shadow-sm">Best-seller</span>
                    @endif
                    @if($product->compare_price > $product->price)
                        <span class="absolute top-4 right-4 bg-[#d4f977] text-[#1a2217] text-[11px] sm:text-xs font-semibold px-3 py-1 rounded-full z-10 shadow-sm">Offre spéciale</span>
                    @endif
                    
                    <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" x-show="activeImage">
                    <div x-show="!activeImage" class="w-full h-full bg-[#f4fbf5] flex items-center justify-center text-[#435b39] opacity-40">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div class="mt-8 lg:mt-0 flex flex-col justify-center">
                @if($product->primaryCategory)
                    <div class="mb-3">
                        <span class="inline-flex items-center rounded-full bg-[#d4f977]/30 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-[#435b39]">
                            {{ $product->primaryCategory->name }}
                        </span>
                    </div>
                @endif
                <h1 class="font-serif text-2xl sm:text-4xl lg:text-5xl font-medium text-[#1a2217] tracking-tight leading-snug">{{ $product->name }}</h1>
                
                <!-- Reviews Summary Header -->
                <div class="mt-3 sm:mt-4 flex items-center gap-2.5">
                    <div class="flex text-[#3ab54a]">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 {{ $i <= round($product->average_rating) ? 'fill-current' : 'text-gray-300 fill-current' }}" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <a href="#reviews" class="text-xs sm:text-sm font-normal text-gray-500 hover:text-[#1a2217] transition-colors">
                        @if($product->reviews_count > 0)
                            {{ $product->average_rating }} / 5 ({{ $product->reviews_count }} {{ Str::plural('avis', $product->reviews_count) }})
                        @else
                            Aucun avis (Soyez le premier !)
                        @endif
                    </a>
                </div>

                <div class="mt-4 sm:mt-6 flex items-baseline gap-3">
                    <p class="text-2xl sm:text-3xl lg:text-4xl text-[#1a2217] font-bold">@price($product->price)</p>
                    @if($product->compare_price > $product->price)
                        <p class="text-base sm:text-lg text-gray-400 line-through">@price($product->compare_price)</p>
                    @endif
                </div>

                <div class="mt-4 sm:mt-6 text-xs sm:text-sm lg:text-base text-gray-600 leading-relaxed font-normal space-y-3">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <!-- Variants / Options -->
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
                                window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cartCount }}));
                                
                                const btn = this.$refs.addBtn;
                                const originalText = btn.innerHTML;
                                btn.innerHTML = '✔ Ajouté !';
                                btn.classList.add('!bg-[#3ab54a]', '!text-white');
                                
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
                    <div class="mt-6 sm:mt-8 border-t border-gray-200/60 pt-6">
                        <h3 class="text-xs sm:text-sm font-medium text-[#1a2217]">Format d'infusion</h3>
                        <div class="mt-3 grid grid-cols-3 gap-2.5 sm:gap-3">
                            @foreach($product->variants as $variant)
                            <button type="button" @click="selectedVariant = {{ $variant->id }}"
                                    :class="{'ring-2 ring-[#1a2217] bg-white': selectedVariant === {{ $variant->id }}, 'ring-1 ring-gray-200 bg-white/60 hover:bg-white': selectedVariant !== {{ $variant->id }}}"
                                    class="rounded-xl p-3 flex flex-col items-center justify-center text-center transition-all shadow-sm">
                                <span class="text-xs sm:text-sm font-medium text-[#1a2217]">{{ $variant->name }}</span>
                                @if($variant->price)
                                    <span class="text-[11px] text-gray-500 mt-0.5">+ @price($variant->price)</span>
                                @endif
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <form @submit.prevent="addToCart" class="mt-6 sm:mt-8">
                        <!-- Quantity & Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                            <div class="flex items-center border border-gray-200 rounded-xl bg-white p-1 justify-between sm:justify-start">
                                <button type="button" @click="if(qty > 1) qty--" class="w-10 h-10 sm:w-11 sm:h-11 flex items-center justify-center text-gray-600 hover:text-[#1a2217] hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </button>
                                <input type="number" name="quantity" x-model="qty" class="w-10 text-center border-0 text-[#1a2217] font-semibold focus:ring-0 p-0 text-sm sm:text-base" min="1">
                                <button type="button" @click="qty++" class="w-10 h-10 sm:w-11 sm:h-11 flex items-center justify-center text-gray-600 hover:text-[#1a2217] hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                            
                            <button type="submit" x-ref="addBtn" :disabled="isAdding" class="flex-1 bg-[#1a2217] text-white hover:bg-[#283324] disabled:opacity-70 px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl font-semibold text-xs sm:text-sm flex items-center justify-center gap-2 transition-all shadow-md active:scale-[0.98]">
                                <span x-show="isAdding" class="inline-block animate-spin mr-2">
                                    <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                </span>
                                <span x-show="!isAdding" class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Ajouter au panier
                                </span>
                            </button>
                        </div>

                        <!-- Buy Now CTA -->
                        <button type="button" @click="addToCart().then(() => window.location.href = '{{ route('cart.index') }}')" class="mt-3 w-full bg-[#d4f977] text-[#1a2217] hover:bg-[#c2e666] px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl font-semibold text-xs sm:text-sm transition-all shadow-sm active:scale-[0.98]">
                            Commander maintenant
                        </button>
                    </form>
                </div>

                <!-- Trust Badges -->
                <div class="mt-6 sm:mt-8 grid grid-cols-2 gap-3 sm:gap-4 border-t border-gray-200/60 pt-6">
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-[#f4fbf5] rounded-full flex items-center justify-center text-[#435b39] shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-gray-700">Paiement 100% sécurisé</span>
                    </div>
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-[#f4fbf5] rounded-full flex items-center justify-center text-[#435b39] shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-gray-700">Satisfait ou remboursé</span>
                    </div>
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-[#f4fbf5] rounded-full flex items-center justify-center text-[#435b39] shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-gray-700">Expédition sous 24h</span>
                    </div>
                    <div class="flex items-center gap-2.5 sm:gap-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-[#f4fbf5] rounded-full flex items-center justify-center text-[#435b39] shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <span class="text-xs sm:text-sm font-medium text-gray-700">Service client réactif</span>
                    </div>
                </div>

                <!-- Product Details Accordion -->
                <div class="mt-6 sm:mt-8 border-t border-gray-200/60 divide-y divide-gray-200/60" x-data="{ active: 1 }">
                    <div class="py-3.5 sm:py-4">
                        <button @click="active = (active === 1 ? null : 1)" class="flex w-full items-center justify-between text-left focus:outline-none">
                            <span class="text-xs sm:text-sm font-semibold text-[#1a2217]">Ingrédients & Bienfaits</span>
                            <span class="ml-6 flex items-center">
                                <svg class="h-4 w-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': active === 1}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </button>
                        <div x-show="active === 1" class="pt-3 text-xs sm:text-sm text-gray-600 leading-relaxed font-normal" style="display: none;">
                            Ce mélange exclusif a été formulé pour vous apporter tous les bienfaits de la nature. Une synergie de plantes sélectionnées avec soin pour une efficacité optimale et un goût d'exception.
                        </div>
                    </div>
                    <div class="py-3.5 sm:py-4">
                        <button @click="active = (active === 2 ? null : 2)" class="flex w-full items-center justify-between text-left focus:outline-none">
                            <span class="text-xs sm:text-sm font-semibold text-[#1a2217]">Conseils de préparation</span>
                            <span class="ml-6 flex items-center">
                                <svg class="h-4 w-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': active === 2}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </button>
                        <div x-show="active === 2" class="pt-3 text-xs sm:text-sm text-gray-600 leading-relaxed font-normal" style="display: none;">
                            Infusez une cuillère dans 250 ml d'eau frémissante (90°C) pendant 3 à 5 minutes selon votre convenance. À savourer chaud ou glacé.
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- SECTION AVIS CLIENTS & NOTATION -->
        <div id="reviews" class="mt-16 sm:mt-24 pt-12 sm:pt-16 border-t border-gray-200/80">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 sm:gap-6 mb-8 sm:mb-12">
                    <div>
                        <h2 class="font-serif text-2xl sm:text-3xl font-medium text-[#1a2217]">Avis Clients</h2>
                        <p class="text-gray-500 text-xs sm:text-sm mt-1">Ce que nos clients pensent de {{ $product->name }}</p>
                    </div>

                    <!-- Note Moyenne Global Banner -->
                    <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 sm:gap-6">
                        <div class="text-center">
                            <span class="text-3xl sm:text-4xl font-bold text-[#1a2217]">{{ $product->average_rating }}</span>
                            <span class="text-xs sm:text-sm text-gray-400 font-semibold">/ 5</span>
                        </div>
                        <div>
                            <div class="flex text-[#3ab54a] mb-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 {{ $i <= round($product->average_rating) ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-[11px] sm:text-xs text-gray-500 font-medium">Basé sur {{ $product->reviews_count }} {{ Str::plural('avis', $product->reviews_count) }}</span>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-6 sm:mb-8 p-3.5 sm:p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 text-xs sm:text-sm font-medium">
                        <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-10">
                    
                    <!-- Formulaire de dépôt d'avis -->
                    <div class="lg:col-span-5">
                        <div class="bg-white p-5 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100">
                            <h3 class="font-serif text-lg sm:text-xl font-medium text-[#1a2217] mb-1">Donnez votre avis</h3>
                            <p class="text-xs text-gray-500 mb-5">Partagez votre expérience avec la communauté.</p>

                            <form action="{{ route('products.reviews.store', $product->slug) }}" method="POST" x-data="{ rating: 5, hoverRating: 0 }" class="space-y-4 sm:space-y-5">
                                @csrf
                                
                                <!-- Notation par étoiles -->
                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Votre note *</label>
                                    <input type="hidden" name="rating" :value="rating">
                                    <div class="flex items-center space-x-1 cursor-pointer">
                                        <template x-for="star in 5">
                                            <button type="button" 
                                                    @click="rating = star" 
                                                    @mouseenter="hoverRating = star" 
                                                    @mouseleave="hoverRating = 0"
                                                    class="focus:outline-none transition-transform transform hover:scale-110">
                                                <svg class="w-6 h-6 sm:w-7 sm:h-7 transition-colors" 
                                                     :class="(hoverRating || rating) >= star ? 'text-[#3ab54a] fill-current' : 'text-gray-200 fill-current'" 
                                                     viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </button>
                                        </template>
                                    </div>
                                    @error('rating') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Votre Nom / Pseudo *</label>
                                    <input type="text" name="reviewer_name" required value="{{ old('reviewer_name', auth()->user()->name ?? '') }}" placeholder="Ex: Marie D." class="w-full rounded-xl border-gray-200 text-xs sm:text-sm shadow-sm focus:border-[#1a2217] focus:ring-[#1a2217]">
                                    @error('reviewer_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Adresse Email *</label>
                                    <input type="email" name="reviewer_email" required value="{{ old('reviewer_email', auth()->user()->email ?? '') }}" placeholder="exemple@email.com" class="w-full rounded-xl border-gray-200 text-xs sm:text-sm shadow-sm focus:border-[#1a2217] focus:ring-[#1a2217]">
                                    <p class="text-[11px] text-gray-400 mt-1">Votre email ne sera pas affiché publiquement.</p>
                                    @error('reviewer_email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1">Votre avis *</label>
                                    <textarea name="comment" rows="4" required placeholder="Qu'avez-vous pensé de cette création ?" class="w-full rounded-xl border-gray-200 text-xs sm:text-sm shadow-sm focus:border-[#1a2217] focus:ring-[#1a2217]">{{ old('comment') }}</textarea>
                                    @error('comment') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <button type="submit" class="w-full py-3.5 px-6 bg-[#1a2217] hover:bg-[#283324] text-white font-semibold text-xs sm:text-sm rounded-xl transition-all shadow-sm">
                                    Soumettre mon avis
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Liste des avis -->
                    <div class="lg:col-span-7 space-y-4">
                        @forelse($product->reviews as $review)
                            <div class="bg-white p-4 sm:p-6 rounded-2xl shadow-sm border border-gray-100 space-y-2.5">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#f4fbf5] text-[#435b39] font-bold flex items-center justify-center text-xs sm:text-sm">
                                            {{ strtoupper(substr($review->reviewer_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-[#1a2217] text-xs sm:text-sm">{{ $review->reviewer_name }}</h4>
                                            <span class="text-[11px] text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <div class="flex text-[#3ab54a]">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-600 text-xs sm:text-sm leading-relaxed pt-1">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        @empty
                            <div class="bg-white p-8 sm:p-12 rounded-2xl border border-gray-100 text-center">
                                <div class="w-14 h-14 sm:w-16 sm:h-16 bg-[#f4fbf5] text-[#435b39] rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                </div>
                                <h4 class="font-serif font-medium text-[#1a2217] text-base sm:text-lg mb-1">Aucun avis pour le moment</h4>
                                <p class="text-xs sm:text-sm text-gray-500">Soyez le premier à partager votre expérience sur {{ $product->name }} !</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</div>

@include('partials.schema.product')
@endsection

