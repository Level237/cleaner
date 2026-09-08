@extends('layouts.store')

@section('content')
<div class="bg-[#F8F9F5] min-h-screen pt-32 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-serif font-extrabold text-[#1a2217] mb-8">Votre Panier</h1>

        @if(session('success'))
            <div class="mb-8 bg-[#d4f977]/20 border border-[#d4f977] text-[#1a2217] px-4 py-3 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-[#3ab54a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
            <div class="lg:grid lg:grid-cols-12 lg:gap-12">
                <!-- Items List -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <ul role="list" class="divide-y divide-gray-100">
                            @foreach($cartItems as $item)
                                <li class="flex py-6 px-6 sm:px-8">
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                                        @if($item['product']->primaryMedia)
                                            <img src="{{ asset('storage/' . $item['product']->primaryMedia->path) }}" alt="{{ $item['product']->name }}" class="h-full w-full object-cover object-center">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-3xl opacity-50 bg-[#e4f5e7]">🍃</div>
                                        @endif
                                    </div>

                                    <div class="ml-4 flex flex-1 flex-col justify-between">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3 class="text-lg font-bold text-[#1a2217]">
                                                    <a href="{{ route('products.show', $item['product']->slug) }}">{{ $item['product']->name }}</a>
                                                </h3>
                                                <p class="ml-4 font-bold text-[#1a2217]">@price($item['total_price'])</p>
                                            </div>
                                            @if($item['variant'])
                                                <p class="mt-1 text-sm text-gray-500">{{ $item['variant']->name }}</p>
                                            @endif
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <div class="flex items-center border border-gray-200 rounded-lg">
                                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="key" value="{{ $item['key'] }}">
                                                    
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-3 py-1 text-gray-500 hover:text-black hover:bg-gray-50 rounded-l-lg" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                                    <span class="px-2 font-medium text-gray-900">{{ $item['quantity'] }}</span>
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-1 text-gray-500 hover:text-black hover:bg-gray-50 rounded-r-lg">+</button>
                                                </form>
                                            </div>

                                            <div class="flex">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="key" value="{{ $item['key'] }}">
                                                    <button type="submit" class="font-medium text-red-500 hover:text-red-400 flex items-center gap-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        Retirer
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="mt-10 lg:mt-0 lg:col-span-4">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8">
                        <h2 class="text-xl font-bold text-[#1a2217] mb-6">Récapitulatif de la commande</h2>
                        
                        <dl class="space-y-4 text-sm text-gray-600">
                            <div class="flex justify-between">
                                <dt>Sous-total</dt>
                                <dd class="font-medium text-gray-900">@price($subtotal)</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt>Frais de livraison</dt>
                                <dd class="font-medium text-[#3ab54a]">Calculés à l'étape suivante</dd>
                            </div>
                            
                            <div class="border-t border-gray-200 pt-4 flex justify-between">
                                <dt class="text-base font-bold text-[#1a2217]">Total</dt>
                                <dd class="text-xl font-bold text-[#1a2217]">@price($subtotal)</dd>
                            </div>
                        </dl>

                        <div class="mt-8">
                            <a href="{{ route('checkout.index') }}" class="w-full bg-[#1a2217] text-white hover:bg-[#283324] px-8 py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-2 transition-transform transform active:scale-[0.98] shadow-lg shadow-black/10">
                                Procéder au paiement
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                        
                        <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                            <p>
                                ou
                                <a href="{{ url('/') }}" class="font-medium text-[#3ab54a] hover:text-[#283324]">
                                    continuer vos achats
                                    <span aria-hidden="true"> &rarr;</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-[#f4fbf5] text-[#3ab54a] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-[#1a2217] mb-2">Votre panier est vide</h2>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">Vous n'avez pas encore ajouté de thé à votre panier. Découvrez notre sélection pour trouver votre bonheur.</p>
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-8 py-4 bg-[#d4f977] text-[#1a2217] hover:bg-[#c2e666] font-bold rounded-xl transition-all shadow-sm">
                    Découvrir la boutique
                </a>
            </div>
        @endif
        
    </div>
</div>
@endsection
