@extends('layouts.store')

@section('content')
<div class="bg-[#F8F9F5] min-h-screen pt-32 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-serif font-extrabold text-[#1a2217] mb-8">Finaliser la commande</h1>

        @if(session('error'))
            <div class="mb-8 p-4 bg-red-50 text-red-700 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Formulaire -->
            <div class="lg:col-span-7">
                <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <!-- Coordonnées -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-[#1a2217] mb-4">Informations personnelles</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                                <input type="text" name="first_name" required value="{{ old('first_name') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">
                                @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                                <input type="text" name="last_name" required value="{{ old('last_name') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">
                                @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" required value="{{ old('email') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">
                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                <input type="text" name="phone" required value="{{ old('phone') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">
                                @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Livraison -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-[#1a2217] mb-4">Adresse de livraison</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                                <input type="text" name="address" required value="{{ old('address') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">
                                @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                                <input type="text" name="city" required value="{{ old('city') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">
                                @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Code postal (Optionnel)</label>
                                <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">
                                @error('postal_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                                <select name="country" required class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">
                                    <option value="Cameroun">Cameroun</option>
                                    <option value="Sénégal">Sénégal</option>
                                    <option value="France">France</option>
                                    <option value="Maroc">Maroc</option>
                                </select>
                                @error('country') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="md:col-span-2 mt-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Méthode de livraison</label>
                                <div class="space-y-2">
                                    <label class="flex items-center p-3 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50">
                                        <input type="radio" name="shipping_method" value="standard" checked class="text-[#3ab54a] focus:ring-[#3ab54a]">
                                        <span class="ml-3 font-medium text-gray-700">Livraison Standard (5.00)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Paiement -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-[#1a2217] mb-4">Paiement</h2>
                        <div class="space-y-3">
                            <label class="flex items-center p-4 border border-[#3ab54a] bg-[#f4fbf5] rounded-xl cursor-pointer">
                                <input type="radio" name="payment_method" value="cash_on_delivery" checked class="text-[#3ab54a] focus:ring-[#3ab54a]">
                                <span class="ml-3 font-bold text-[#1a2217]">Paiement à la livraison</span>
                            </label>
                            <label class="flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="mobile_money" class="text-[#3ab54a] focus:ring-[#3ab54a]">
                                <span class="ml-3 font-medium text-gray-700">Mobile Money (Prochainement)</span>
                            </label>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes concernant la commande (Optionnel)</label>
                        <textarea name="notes" rows="3" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a]">{{ old('notes') }}</textarea>
                    </div>
                </form>
            </div>

            <!-- Résumé -->
            <div class="lg:col-span-5">
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 sticky top-32">
                    <h2 class="text-xl font-bold text-[#1a2217] mb-6">Résumé de la commande</h2>
                    
                    <div class="space-y-4 mb-6">
                        @foreach($cartItems as $item)
                            <div class="flex gap-4 items-center">
                                <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                    @if($item['product']->mainImage->first())
                                        <img src="{{ asset('storage/' . $item['product']->mainImage->first()->path) }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-[#1a2217] text-sm">{{ $item['product']->name }}</h3>
                                    @if($item['variant'])
                                        <p class="text-xs text-gray-500">{{ $item['variant']->name }}</p>
                                    @endif
                                    <p class="text-sm text-gray-600 mt-1">Qté: {{ $item['quantity'] }}</p>
                                </div>
                                <div class="font-bold text-[#3ab54a]">
                                    {{ number_format($item['total_price'], 2) }} {{ session('currency', 'XAF') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Sous-total</span>
                            <span class="font-medium">{{ number_format($subtotal, 2) }} {{ session('currency', 'XAF') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Frais de livraison</span>
                            <span class="font-medium">{{ number_format($shipping_cost, 2) }} {{ session('currency', 'XAF') }}</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 mb-8">
                        <div class="flex justify-between items-center text-lg font-bold text-[#1a2217]">
                            <span>Total</span>
                            <span class="text-2xl text-[#3ab54a]">{{ number_format($total, 2) }} {{ session('currency', 'XAF') }}</span>
                        </div>
                    </div>

                    <button type="submit" form="checkout-form" class="w-full flex justify-center items-center px-6 py-4 border border-transparent rounded-xl shadow-sm text-lg font-medium text-[#1a2217] bg-[#d4f977] hover:bg-[#c5e865] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#d4f977] transition-colors">
                        Confirmer la commande
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    
                    <p class="text-xs text-gray-500 text-center mt-4 flex items-center justify-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Paiement sécurisé et données cryptées
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
