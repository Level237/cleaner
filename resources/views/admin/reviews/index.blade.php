@extends('layouts.admin')

@section('title', 'Avis Clients')

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Avis Clients</h1>
        <p class="mt-1 text-sm text-gray-500">Gérez et modérez les avis déposés par vos clients sur vos produits.</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    
    <!-- Filtres -->
    <div class="p-4 border-b border-gray-100 flex flex-wrap gap-2">
        <a href="{{ route('admin.reviews.index') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ !request('status') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50' }}">Tous</a>
        <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request('status') == 'approved' ? 'bg-emerald-50 text-emerald-700' : 'text-gray-600 hover:bg-gray-50' }}">Approuvés / Visibles</a>
        <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request('status') == 'pending' ? 'bg-amber-50 text-amber-700' : 'text-gray-600 hover:bg-gray-50' }}">Masqués / En attente</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Produit</th>
                    <th class="px-6 py-4">Note</th>
                    <th class="px-6 py-4">Avis</th>
                    <th class="px-6 py-4">Statut</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $rev)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900">{{ $rev->reviewer_name }}</div>
                            <div class="text-xs text-gray-500">{{ $rev->reviewer_email }}</div>
                            <div class="text-[11px] text-gray-400 mt-0.5">{{ $rev->created_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            @if($rev->product)
                                <a href="{{ route('products.show', $rev->product->slug) }}" target="_blank" class="hover:text-blue-600 flex items-center">
                                    {{ $rev->product->name }}
                                    <svg class="w-3.5 h-3.5 ml-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            @else
                                <span class="text-gray-400 italic">Produit supprimé</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex text-amber-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $rev->rating ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500 font-bold mt-0.5 block">{{ $rev->rating }}/5</span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 max-w-xs leading-relaxed">
                            {{ $rev->comment }}
                        </td>
                        <td class="px-6 py-4">
                            @if($rev->is_approved)
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                    Visible
                                </span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                    Masqué
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right flex items-center justify-end space-x-2">
                            <form action="{{ route('admin.reviews.toggle', $rev) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors {{ $rev->is_approved ? 'bg-amber-50 text-amber-700 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }}">
                                    {{ $rev->is_approved ? 'Masquer' : 'Approuver' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.reviews.destroy', $rev) }}" method="POST" onsubmit="return confirm('Supprimer cet avis ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            Aucun avis client déposé pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($reviews->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $reviews->links() }}
        </div>
    @endif
</div>
@endsection
