@extends('layouts.store')

@section('content')
<div class="bg-[#F8F9F5] min-h-screen pt-32 pb-24 flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center w-full">
        
        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-gray-100">
            <div class="w-20 h-20 bg-[#f4fbf5] text-[#3ab54a] rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl md:text-4xl font-serif font-extrabold text-[#1a2217] mb-4">Commande confirmée !</h1>
            
            <p class="text-lg text-gray-600 mb-8">
                Merci {{ $order->first_name }} ! Votre commande <strong class="text-[#1a2217]">{{ $order->reference }}</strong> a bien été enregistrée. Nous vous avons envoyé un email de confirmation.
            </p>
            
            <div class="bg-gray-50 rounded-2xl p-6 text-left mb-8">
                <h3 class="font-bold text-[#1a2217] mb-4 border-b border-gray-200 pb-2">Récapitulatif</h3>
                
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-600">Total payé</span>
                    <span class="font-bold text-[#3ab54a] text-xl">{{ number_format($order->total, 2) }} {{ $order->currency }}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-600">Paiement</span>
                    <span class="font-medium text-gray-900">{{ $order->payment_method == 'cash_on_delivery' ? 'À la livraison' : 'En ligne' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Expédition vers</span>
                    <span class="font-medium text-gray-900">{{ $order->city }}, {{ $order->country }}</span>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-[#1a2217] bg-[#d4f977] hover:bg-[#c5e865] focus:outline-none transition-colors">
                    Continuer mes achats
                </a>
                <a href="{{ route('home') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-200 rounded-xl shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-colors">
                    Retour à l'accueil
                </a>
            </div>
        </div>
        
    </div>
</div>
@endsection
