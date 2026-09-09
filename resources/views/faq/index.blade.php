@extends('layouts.store')

@section('content')
<div class="bg-[#fcfbf9] py-12 sm:py-16 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="text-center mb-12 sm:mb-16">
            <span class="inline-block px-3.5 py-1 bg-[#1a2217]/5 text-[#1a2217] rounded-full text-xs font-semibold uppercase tracking-wider mb-3">
                Assistance & Réponses
            </span>
            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl font-bold text-[#1a2217] tracking-tight mb-4">
                Foire Aux Questions
            </h1>
            <p class="text-base sm:text-lg text-gray-600 max-w-2xl mx-auto">
                Tout ce que vous devez savoir sur nos infusions bien-être, vos commandes, et la livraison.
            </p>
        </div>

        {{-- FAQ Accordion List --}}
        <div class="space-y-6">
            @forelse($faqs as $faq)
                <div class="bg-white rounded-2xl p-6 sm:p-8 shadow-sm border border-gray-100">
                    <h3 class="font-serif text-lg sm:text-xl font-bold text-[#1a2217] mb-3">
                        {{ $faq->question }}
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        {!! nl2br(e($faq->answer)) !!}
                    </p>
                </div>
            @empty
                <div class="bg-white rounded-2xl p-8 text-center border border-gray-100">
                    <p class="text-gray-500 italic">Aucune question fréquente pour le moment.</p>
                </div>
            @endforelse
        </div>

        {{-- Contact CTA --}}
        <div class="mt-12 text-center bg-[#d4f977]/30 rounded-3xl p-8 border border-[#d4f977]">
            <h4 class="font-serif text-xl font-bold text-[#1a2217] mb-2">Vous n'avez pas trouvé votre réponse ?</h4>
            <p class="text-sm text-gray-700 mb-6">Notre équipe est là pour vous guider au quotidien.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact.index') }}" class="px-6 py-3 bg-[#1a2217] text-white rounded-full text-sm font-semibold hover:bg-[#2e3b29] transition-all">
                    Envoyer un message
                </a>
                <a href="https://wa.me/33600000000" target="_blank" class="px-6 py-3 bg-[#25D366] text-white rounded-full text-sm font-semibold hover:bg-[#20bd5a] transition-all flex items-center gap-2">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                    Discuter sur WhatsApp
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
