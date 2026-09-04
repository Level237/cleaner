@extends('layouts.admin')

@section('title', 'Archives')

@section('header')
    <div class="flex justify-between items-center w-full">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Archives</h2>
    </div>
@endsection

@section('content')
<div class="w-full">
    
    <!-- Navigation Tabs -->
    <div class="mb-6 border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="{{ route('admin.archives.index', ['type' => 'products']) }}" 
               class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors
               {{ $type === 'products' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Produits
            </a>
            
            <a href="{{ route('admin.archives.index', ['type' => 'categories']) }}" 
               class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors
               {{ $type === 'categories' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Catégories
            </a>

            <a href="{{ route('admin.archives.index', ['type' => 'collections']) }}" 
               class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors
               {{ $type === 'collections' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                Collections
            </a>
        </nav>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de suppression</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->deleted_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.archives.restore', ['type' => $type, 'id' => $item->id]) }}" method="POST" class="inline-block mr-3">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-900 font-medium">Restaurer</button>
                                </form>
                                <form action="{{ route('admin.archives.force-delete', ['type' => $type, 'id' => $item->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Attention, cette action est irréversible. Confirmer la suppression définitive ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Supprimer définitivement</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 whitespace-nowrap text-center text-sm text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                Aucune archive trouvée pour cette catégorie.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($items->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $items->appends(['type' => $type])->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
