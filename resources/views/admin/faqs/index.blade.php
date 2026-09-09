@extends('layouts.admin')

@section('title', 'Gestion de la FAQ')

@section('header')
    <div class="flex justify-between items-center w-full">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Foire Aux Questions (FAQ)</h2>
            <p class="text-sm text-gray-500 mt-1">Gérez les questions et réponses affichées sur le site.</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-xl font-semibold text-sm text-white tracking-wide hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Ajouter une question
        </a>
    </div>
@endsection

@section('content')
<div class="w-full">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ordre</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Question</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Réponse</th>
                        <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                        <th scope="col" class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($faqs as $faq)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                #{{ $faq->order }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-900 line-clamp-2">{{ $faq->question }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 line-clamp-2 max-w-md">{{ $faq->answer }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($faq->is_active)
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                        Actif
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600 border border-gray-200">
                                        Masqué
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition-colors">
                                        Modifier
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette question ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition-colors">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center space-y-3">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-base font-medium">Aucune question FAQ pour le moment.</p>
                                    <a href="{{ route('admin.faqs.create') }}" class="text-sm font-semibold text-blue-600 hover:underline">Ajouter une première question</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($faqs->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                {{ $faqs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
