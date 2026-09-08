@extends('layouts.admin')

@section('title', 'Messages de Contact')

@section('header')
<div class="flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Messages de Contact</h1>
        <p class="mt-1 text-sm text-gray-500">Consultez les messages reçus depuis le formulaire de contact.</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4">Expéditeur</th>
                    <th class="px-6 py-4">Sujet</th>
                    <th class="px-6 py-4">Téléphone</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4">Statut</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors {{ !$msg->is_read ? 'bg-amber-50/40 font-medium' : '' }}">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-900">{{ $msg->name }}</div>
                            <div class="text-xs text-gray-500">{{ $msg->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-900">
                            {{ Str::limit($msg->subject ?? 'Sans sujet', 40) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $msg->phone ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-xs">
                            {{ $msg->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @if(!$msg->is_read)
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                    Nouveau
                                </span>
                            @else
                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-600">
                                    Lu
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.contacts.show', $msg) }}" class="text-blue-600 hover:text-blue-900 font-medium bg-blue-50 px-3 py-1.5 rounded-lg transition-colors">
                                Lire
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $msg) }}" method="POST" onsubmit="return confirm('Supprimer ce message ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium bg-red-50 px-3 py-1.5 rounded-lg transition-colors">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            Aucun message de contact reçu pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection
