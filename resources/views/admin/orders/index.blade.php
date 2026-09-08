@extends('layouts.admin')

@section('title', 'Commandes')

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Commandes</h1>
        <p class="mt-1 text-sm text-gray-500">Gérez les commandes de vos clients.</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-4 border-b border-gray-100 flex flex-wrap gap-2">
        <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ !request('status') || request('status') == 'all' ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Toutes</a>
        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request('status') == 'pending' ? 'bg-amber-50 text-amber-700' : 'text-gray-600 hover:bg-gray-50' }}">En attente</a>
        <a href="{{ route('admin.orders.index', ['status' => 'paid']) }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request('status') == 'paid' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50' }}">Payées</a>
        <a href="{{ route('admin.orders.index', ['status' => 'shipped']) }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request('status') == 'shipped' ? 'bg-purple-50 text-purple-700' : 'text-gray-600 hover:bg-gray-50' }}">Expédiées</a>
        <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request('status') == 'delivered' ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-50' }}">Livrées</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Référence</th>
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Statut</th>
                    <th class="px-6 py-4 text-right">Total</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $order->reference }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</div>
                            <div class="text-xs text-gray-500">{{ $order->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
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
                                $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                                $label = $statusLabels[$order->status] ?? ucfirst($order->status);
                            @endphp
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full {{ $color }}">
                                {{ $label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-medium text-gray-900">
                            {{ number_format($order->total, 2) }} {{ $order->currency }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-900 font-medium bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                Voir
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            Aucune commande trouvée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
