@extends('layouts.store')

@section('content')
<div class="bg-[#F8F9F5] min-h-screen pt-24 sm:pt-32 pb-16 sm:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Title & Item Count -->
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between mb-6 sm:mb-8 border-b border-gray-200/60 pb-4">
            <h1 class="font-serif text-2xl sm:text-4xl font-medium text-[#1a2217] tracking-tight">Votre Panier</h1>
            @if(count($cartItems) > 0)
                <span class="text-xs sm:text-sm font-normal text-gray-500 mt-1 sm:mt-0">
                    {{ count($cartItems) }} {{ count($cartItems) > 1 ? 'articles' : 'article' }}
                </span>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-6 sm:mb-8 bg-[#d4f977]/20 border border-[#d4f977]/60 text-[#1a2217] px-4 py-3 sm:py-3.5 rounded-2xl flex items-center gap-3 text-xs sm:text-sm font-medium shadow-sm">
                <div class="w-6 h-6 rounded-full bg-[#3ab54a]/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-[#3ab54a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(count($cartItems) > 0)
            <div class="lg:grid lg:grid-cols-12 lg:gap-10 items-start">
                <!-- Items List -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <ul role="list" class="divide-y divide-gray-100">
                            @foreach($cartItems as $item)
                                <li class="flex flex-col sm:flex-row py-5 sm:py-6 px-4 sm:px-8 gap-4 sm:gap-6">
                                    <!-- Image Container -->
                                    <div class="h-20 w-20 sm:h-24 sm:w-24 flex-shrink-0 overflow-hidden rounded-xl sm:rounded-2xl border border-gray-100 bg-[#f4fbf5] relative">
                                        @if($item['product']->primaryMedia)
                                            <img src="{{ asset('storage/' . $item['product']->primaryMedia->path) }}" alt="{{ $item['product']->name }}" class="h-full w-full object-cover object-center">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[#435b39] opacity-40">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Content & Actions -->
                                    <div class="flex flex-1 flex-col justify-between">
                                        <div>
                                            <div class="flex justify-between items-start text-sm sm:text-base gap-2">
                                                <h3 class="font-serif font-medium text-[#1a2217] hover:text-[#435b39] transition-colors leading-snug">
                                                    <a href="{{ route('products.show', $item['product']->slug) }}">{{ $item['product']->name }}</a>
                                                </h3>
                                                <p class="font-semibold text-[#1a2217] whitespace-nowrap text-sm sm:text-base">@price($item['total_price'])</p>
                                            </div>
                                            @if($item['variant'])
                                                <p class="mt-1 text-xs sm:text-sm text-gray-500 font-normal">{{ $item['variant']->name }}</p>
                                            @endif
                                        </div>

                                        <div class="flex items-center justify-between mt-4 text-xs sm:text-sm pt-2">
                                            <!-- Quantity Selector -->
                                            <div class="inline-flex items-center border border-gray-200 rounded-xl bg-gray-50/50 p-0.5">
                                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="key" value="{{ $item['key'] }}">
                                                    
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center text-gray-600 hover:text-black hover:bg-white rounded-lg transition-colors disabled:opacity-30 disabled:cursor-not-allowed" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                                    <span class="px-3 font-medium text-gray-900 text-xs sm:text-sm">{{ $item['quantity'] }}</span>
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center text-gray-600 hover:text-black hover:bg-white rounded-lg transition-colors">+</button>
                                                </form>
                                            </div>

                                            <!-- Remove Action -->
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="key" value="{{ $item['key'] }}">
                                                <button type="submit" class="font-medium text-red-500 hover:text-red-600 transition-colors inline-flex items-center gap-1.5 text-xs sm:text-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    <span>Supprimer</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Order Summary (Sticky Sidebar) -->
                <div class="mt-8 lg:mt-0 lg:col-span-4 lg:sticky lg:top-28">
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 p-5 sm:p-8">
                        <h2 class="font-serif text-lg sm:text-xl font-medium text-[#1a2217] mb-5 sm:mb-6 pb-4 border-b border-gray-100">
                            Récapitulatif
                        </h2>
                        
                        <dl class="space-y-3.5 text-xs sm:text-sm text-gray-600">
                            <div class="flex justify-between">
                                <dt class="font-normal text-gray-500">Sous-total</dt>
                                <dd class="font-medium text-gray-900">@price($subtotal)</dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="font-normal text-gray-500">Livraison</dt>
                                <dd class="font-medium text-[#435b39] text-xs">Calculés à l'étape suivante</dd>
                            </div>
                            
                            <div class="border-t border-gray-100 pt-4 flex justify-between items-baseline">
                                <dt class="font-serif font-medium text-base sm:text-lg text-[#1a2217]">Total HT/TTC</dt>
                                <dd class="font-bold text-xl sm:text-2xl text-[#1a2217]">@price($subtotal)</dd>
                            </div>
                        </dl>

                        <div class="mt-6 sm:mt-8">
                            <a href="{{ route('checkout.index') }}" class="w-full bg-[#1a2217] text-white hover:bg-[#283324] px-6 sm:px-8 py-3.5 sm:py-4 rounded-xl font-semibold text-xs sm:text-sm flex items-center justify-center gap-2 transition-all shadow-md active:scale-[0.98]">
                                <span>Procéder au paiement</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                        
                        <div class="mt-5 text-center">
                            <a href="{{ url('/') }}" class="inline-flex items-center gap-1 text-xs sm:text-sm font-medium text-gray-500 hover:text-[#1a2217] transition-colors">
                                <span>&larr; Continuer vos achats</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart State -->
            <div class="text-center py-12 sm:py-20 bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 px-4 max-w-2xl mx-auto">
                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-[#f4fbf5] text-[#435b39] rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h2 class="font-serif text-xl sm:text-2xl font-medium text-[#1a2217] mb-2">Votre panier est vide</h2>
                <p class="text-gray-500 text-xs sm:text-sm mb-6 sm:mb-8 max-w-md mx-auto leading-relaxed">Vous n'avez pas encore ajouté de création de thé à votre panier. Découvrez nos assemblages artisanaux pour éveiller vos sens.</p>
                <a href="{{ url('/boutique') }}" class="inline-flex items-center justify-center px-6 sm:px-8 py-3.5 sm:py-4 bg-[#1a2217] text-white hover:bg-[#283324] font-semibold text-xs sm:text-sm rounded-xl transition-all shadow-sm">
                    Découvrir la boutique
                </a>
            </div>
        @endif
        
    </div>
</div>
@endsection

