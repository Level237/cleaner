@extends('layouts.admin')

@section('title', 'Message de ' . $contact->name)

@section('header')
<div class="flex items-center justify-between">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.contacts.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-gray-900 hover:bg-gray-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Message de {{ $contact->name }}</h1>
            <p class="mt-1 text-sm text-gray-500">Reçu le {{ $contact->created_at->format('d/m/Y à H:i') }}</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 space-y-6">
        
        <div class="flex flex-wrap items-center justify-between gap-4 border-b border-gray-100 pb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900">{{ $contact->subject ?? 'Sans sujet' }}</h2>
                <div class="mt-2 text-sm text-gray-600 flex flex-wrap items-center gap-4">
                    <span><strong>De :</strong> {{ $contact->name }} (&lt;<a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:underline">{{ $contact->email }}</a>&gt;)</span>
                    @if($contact->phone)
                        <span><strong>Tél :</strong> {{ $contact->phone }}</span>
                    @endif
                </div>
            </div>

            <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'Votre demande de contact') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium text-sm rounded-xl hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Répondre par Email
            </a>
        </div>

        <div>
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Contenu du message</h3>
            <div class="p-6 bg-gray-50 rounded-xl text-gray-800 text-base leading-relaxed whitespace-pre-line border border-gray-100">
                {{ $contact->message }}
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce message ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-5 py-2.5 bg-red-50 text-red-600 hover:bg-red-100 font-medium text-sm rounded-xl transition-colors">
                    Supprimer ce message
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
