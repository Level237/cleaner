@extends('layouts.admin')

@section('title', 'Modifier la question FAQ')

@section('header')
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Modifier la question</h2>
            <p class="text-sm text-gray-500 mt-1">Mettez à jour les informations de la FAQ #{{ $faq->id }}.</p>
        </div>
        <a href="{{ route('admin.faqs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent rounded-xl font-semibold text-sm text-gray-700 hover:bg-gray-200 transition-colors">
            &larr; Retour à la liste
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')

        {{-- Question --}}
        <div>
            <label for="question" class="block text-sm font-semibold text-gray-900 mb-2">
                Question <span class="text-red-500">*</span>
            </label>
            <input 
                type="text" 
                name="question" 
                id="question" 
                value="{{ old('question', $faq->question) }}" 
                required 
                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 text-sm py-3 px-4"
            >
            @error('question')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Answer --}}
        <div>
            <label for="answer" class="block text-sm font-semibold text-gray-900 mb-2">
                Réponse <span class="text-red-500">*</span>
            </label>
            <textarea 
                name="answer" 
                id="answer" 
                rows="6" 
                required 
                class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 text-sm py-3 px-4"
            >{{ old('answer', $faq->answer) }}</textarea>
            @error('answer')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
            {{-- Order --}}
            <div>
                <label for="order" class="block text-sm font-semibold text-gray-900 mb-2">
                    Ordre d'affichage
                </label>
                <input 
                    type="number" 
                    name="order" 
                    id="order" 
                    value="{{ old('order', $faq->order) }}" 
                    min="0" 
                    class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500 text-sm py-3 px-4"
                >
                <p class="text-xs text-gray-500 mt-1">Les chiffres les plus petits apparaissent en premier.</p>
                @error('order')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="flex items-center h-full pt-6">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1" 
                        class="sr-only peer" 
                        {{ old('is_active', $faq->is_active) ? 'checked' : '' }}
                    >
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    <span class="ml-3 text-sm font-semibold text-gray-900">Actif (afficher sur le site)</span>
                </label>
            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
            <a href="{{ route('admin.faqs.index') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-semibold text-sm rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-sm">
                Mettre à jour la question
            </button>
        </div>
    </form>
</div>
@endsection
