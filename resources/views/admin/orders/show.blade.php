@extends('layouts.admin')

@section('title', 'Commande ' . $order->reference)

@section('header')
<div class="flex items-center justify-between">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.orders.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Commande {{ $order->reference }}</h1>
            <p class="mt-1 text-sm text-gray-500">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
        </div>
    </div>
    
    @php
        $statusColors = [
            'pending' => 'bg-amber-100 text-amber-800',
            'paid' => 'bg-indigo-100 text-indigo-800',
            'shipped' => 'bg-purple-100 text-purple-800',
            'delivered' => 'bg-emerald-100 text-emerald-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'refunded' => 'bg-gray-100 text-gray-800',
        ];
        $statusLabels = [
            'pending' => 'En attente',
            'paid' => 'Payée',
            'shipped' => 'Expédiée',
            'delivered' => 'Livrée',
            'cancelled' => 'Annulée',
            'refunded' => 'Remboursée',
        ];
    @endphp
    <span class="px-3 py-1.5 text-sm font-medium rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100' }}">
        {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
    </span>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Colonne Principale -->
    <div class="lg:col-span-2 space-y-8">
        
        <!-- Articles -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">Articles commandés</h2>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($order->items as $item)
                    <div class="p-6 flex items-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-xl flex items-center justify-center flex-shrink-0">
                            <!-- SVG Placeholder -->
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $item->product_name }}</h3>
                                    @if($item->variant_name)
                                        <p class="text-sm text-gray-500">{{ $item->variant_name }}</p>
                                    @endif
                                    <p class="text-xs text-gray-400 mt-1">SKU: {{ $item->sku ?? 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-900">{{ number_format($item->total_price, 2) }} {{ $order->currency }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->quantity }} x {{ number_format($item->unit_price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-gray-50 p-6 border-t border-gray-100">
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-gray-600">
                        <span>Sous-total</span>
                        <span>{{ number_format($order->subtotal, 2) }} {{ $order->currency }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Frais de port</span>
                        <span>{{ number_format($order->shipping_cost, 2) }} {{ $order->currency }}</span>
                    </div>
                    @if($order->discount > 0)
                        <div class="flex justify-between text-green-600">
                            <span>Remise</span>
                            <span>-{{ number_format($order->discount, 2) }} {{ $order->currency }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between items-center text-lg font-bold text-gray-900 pt-3 border-t border-gray-200 mt-3">
                        <span>Total</span>
                        <span>{{ number_format($order->total, 2) }} {{ $order->currency }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mettre à jour le statut -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">Gestion de la commande</h2>
            </div>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Statut de la commande</label>
                        <select name="status" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach($statusLabels as $val => $label)
                                <option value="{{ $val }}" @if($order->status == $val) selected @endif>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Statut du paiement</label>
                        <select name="payment_status" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="pending" @if($order->payment_status == 'pending') selected @endif>En attente</option>
                            <option value="paid" @if($order->payment_status == 'paid') selected @endif>Payé</option>
                            <option value="failed" @if($order->payment_status == 'failed') selected @endif>Échoué</option>
                            <option value="refunded" @if($order->payment_status == 'refunded') selected @endif>Remboursé</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Numéro de suivi (Tracking)</label>
                        <input type="text" name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Ex: 1Z9999999999999999">
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-colors">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>

    </div>

    <!-- Colonne Latérale -->
    <div class="space-y-8">
        
        <!-- Client -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">Client</h2>
            </div>
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-xl">
                        {{ substr($order->first_name, 0, 1) }}{{ substr($order->last_name, 0, 1) }}
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</p>
                        @if($order->user_id)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 mt-1">Client inscrit</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 mt-1">Invité</span>
                        @endif
                    </div>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:{{ $order->email }}" class="text-blue-600 hover:underline">{{ $order->email }}</a>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        {{ $order->phone }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Expédition -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">Adresse de livraison</h2>
            </div>
            <div class="p-6">
                <p class="text-gray-900 font-medium">{{ $order->first_name }} {{ $order->last_name }}</p>
                <p class="text-gray-600 mt-1 text-sm leading-relaxed">
                    {{ $order->address }}<br>
                    @if($order->postal_code)
                        {{ $order->postal_code }} 
                    @endif
                    {{ $order->city }}<br>
                    {{ $order->country }}
                </p>
                
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider mb-2">Méthode</p>
                    <p class="text-gray-900 text-sm font-medium">{{ $order->shipping_method == 'standard' ? 'Livraison Standard' : $order->shipping_method }}</p>
                </div>
            </div>
        </div>

        <!-- Notes -->
        @if($order->notes)
            <div class="bg-amber-50 rounded-2xl border border-amber-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-amber-200/50 bg-amber-100/50">
                    <h2 class="text-sm font-bold text-amber-900 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Note du client
                    </h2>
                </div>
                <div class="p-6">
                    <p class="text-amber-800 text-sm italic">"{{ $order->notes }}"</p>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
