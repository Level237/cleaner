@extends('layouts.admin')

@section('title', 'Médias')

@section('content')
<div class="space-y-6">

    <!-- Header & Stats -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Médiathèque
            </h1>
            <p class="text-sm text-gray-500 mt-1">Gérez toutes les images et optimisez leur SEO.</p>
        </div>
        
        <div class="flex gap-4">
            <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 text-center">
                <span class="block text-2xl font-black text-gray-900">{{ $stats['total'] }}</span>
                <span class="text-xs text-gray-500 font-medium uppercase tracking-wider">Fichiers</span>
            </div>
            <div class="bg-orange-50 px-4 py-2 rounded-xl shadow-sm border border-orange-100 text-center">
                <span class="block text-2xl font-black text-orange-600">{{ $stats['missing_alt'] }}</span>
                <span class="text-xs text-orange-600 font-medium uppercase tracking-wider">Sans Alt (SEO)</span>
            </div>
            <div class="bg-red-50 px-4 py-2 rounded-xl shadow-sm border border-red-100 text-center">
                <span class="block text-2xl font-black text-red-600">{{ $stats['orphans'] }}</span>
                <span class="text-xs text-red-600 font-medium uppercase tracking-wider">Orphelins</span>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
        <form method="GET" action="{{ route('admin.media.index') }}" class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.media.index') }}" class="px-4 py-2 rounded-full text-sm font-medium {{ !request('filter') ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Tous</a>
                <a href="{{ route('admin.media.index', ['filter' => 'no_alt']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('filter') === 'no_alt' ? 'bg-orange-500 text-white' : 'bg-orange-50 text-orange-700 hover:bg-orange-100' }}">
                    Sans alt text ⚠️
                </a>
                <a href="{{ route('admin.media.index', ['filter' => 'product']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('filter') === 'product' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Produits</a>
                <a href="{{ route('admin.media.index', ['filter' => 'category']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('filter') === 'category' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Catégories</a>
                <a href="{{ route('admin.media.index', ['filter' => 'collection']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('filter') === 'collection' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Collections</a>
                <a href="{{ route('admin.media.index', ['filter' => 'orphan']) }}" class="px-4 py-2 rounded-full text-sm font-medium {{ request('filter') === 'orphan' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">Orphelins</a>
            </div>
            
            <div class="relative w-full md:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 text-sm">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                @if(request('filter'))
                    <input type="hidden" name="filter" value="{{ request('filter') }}">
                @endif
            </div>
        </form>
    </div>

    <!-- Media Table (with Bulk Update Form) -->
    <form action="{{ route('admin.media.bulk-update') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @csrf
        
        <!-- Header Actions -->
        <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <span class="text-sm text-gray-600 font-medium">Modification rapide des textes alternatifs</span>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 shadow-sm transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Sauvegarder tout
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4">Image</th>
                        <th class="px-6 py-4">Détails</th>
                        <th class="px-6 py-4">Type / Associé à</th>
                        <th class="px-6 py-4 w-1/3">Texte alternatif (Alt)</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($media as $medium)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <a href="{{ Storage::url($medium->path) }}" target="_blank" class="block w-20 h-20 rounded-lg overflow-hidden border border-gray-200 group relative">
                                    <img src="{{ Storage::url($medium->path) }}" alt="{{ $medium->alt_text }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </div>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs text-gray-500 font-mono mb-1 truncate w-40" title="{{ $medium->path }}">
                                    {{ basename($medium->path) }}
                                </div>
                                @php
                                    $size = Storage::disk('public')->exists($medium->path) ? Storage::disk('public')->size($medium->path) : 0;
                                    $sizeKb = round($size / 1024);
                                @endphp
                                <div class="text-xs {{ $sizeKb > 500 ? 'text-red-600 font-bold' : 'text-gray-400' }}">
                                    {{ $sizeKb }} KB
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
                                    {{ $medium->created_at->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($medium->mediable)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 mb-1">
                                        {{ class_basename($medium->mediable_type) }}
                                    </span>
                                    <br>
                                    <a href="#" class="text-sm font-semibold text-gray-900 hover:text-blue-600">
                                        {{ $medium->mediable->name ?? 'ID: '.$medium->mediable_id }}
                                    </a>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                        Orphelin
                                    </span>
                                @endif
                                <div class="text-xs text-gray-500 mt-1 uppercase">
                                    Role: {{ $medium->role }} {!! $medium->is_primary ? '<span class="text-orange-500 font-bold" title="Principale">★</span>' : '' !!}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <input type="hidden" name="media_ids[]" value="{{ $medium->id }}">
                                <div class="relative">
                                    <input type="text" name="alt_texts[]" value="{{ $medium->alt_text }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm {{ !$medium->alt_text ? 'border-orange-300 bg-orange-50' : '' }}" placeholder="Aucun texte alternatif...">
                                    @if(!$medium->alt_text)
                                        <div class="absolute right-3 top-2.5 text-orange-500" title="Manquant !">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <!-- Delete form -->
                                <button type="button" onclick="if(confirm('Supprimer définitivement ce média ?')) document.getElementById('delete-media-{{ $medium->id }}').submit()" class="p-2 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Supprimer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 text-gray-400 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-sm font-medium text-gray-900">Aucun média trouvé</h3>
                                <p class="mt-1 text-sm text-gray-500">Essayez de modifier vos filtres.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($media->hasPages())
            <div class="p-4 border-t border-gray-100 bg-gray-50">
                {{ $media->links() }}
            </div>
        @endif
    </form>

    <!-- Hidden delete forms -->
    @foreach($media as $medium)
        <form id="delete-media-{{ $medium->id }}" action="{{ route('admin.media.destroy', $medium) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

</div>
@endsection
