@extends('layouts.store')

@section('content')
<!-- Hero Section -->
<div class="relative bg-[#1a2217] text-white pt-32 sm:pt-40 pb-16 sm:pb-20 overflow-hidden">
    <div class="absolute inset-0 opacity-15">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#d4f977] rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#3ab54a] rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-3.5 py-1 sm:px-4 sm:py-1.5 rounded-full bg-[#d4f977]/10 text-[#d4f977] text-xs sm:text-sm font-medium tracking-wider uppercase mb-3">
            Besoin d'aide ou d'informations ?
        </span>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-serif font-medium tracking-tight mb-3 sm:mb-4">
            Contactez-nous
        </h1>
        <p class="max-w-2xl mx-auto text-sm sm:text-lg text-gray-300 font-normal leading-relaxed">
            Une question sur un produit, une commande ou un partenariat ? Notre équipe est à votre entière disposition pour vous répondre.
        </p>
    </div>
</div>

<!-- Main Section -->
<div class="bg-[#F8F9F5] py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-8 p-4 sm:p-5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 sm:gap-4 shadow-sm">
                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0 text-emerald-600">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="font-medium text-sm sm:text-base">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            
            <!-- Informations de contact -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-5 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 space-y-6 sm:space-y-8">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-serif font-semibold text-[#1a2217] mb-1 sm:mb-2">Nos Coordonnées</h2>
                        <p class="text-xs sm:text-sm text-gray-500 font-normal">N'hésitez pas à nous contacter directement par téléphone ou email.</p>
                    </div>

                    <div class="space-y-5 sm:space-y-6">
                        <div class="flex items-start gap-3.5 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-[#f4fbf5] text-[#3ab54a] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#1a2217] text-xs sm:text-sm uppercase tracking-wide">Adresse</h3>
                                <p class="text-gray-600 text-xs sm:text-sm mt-0.5 sm:mt-1 font-normal">Douala, Cameroun<br>Akwa, Boulevard de la Liberté</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-[#f4fbf5] text-[#3ab54a] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#1a2217] text-xs sm:text-sm uppercase tracking-wide">Téléphone</h3>
                                <p class="text-gray-600 text-xs sm:text-sm mt-0.5 sm:mt-1 font-normal">+237 6 00 00 00 00</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-[#f4fbf5] text-[#3ab54a] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#1a2217] text-xs sm:text-sm uppercase tracking-wide">Email</h3>
                                <p class="text-gray-600 text-xs sm:text-sm mt-0.5 sm:mt-1 font-normal">contact@cleaner.com</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-[#f4fbf5] text-[#3ab54a] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#1a2217] text-xs sm:text-sm uppercase tracking-wide">Horaires d'ouverture</h3>
                                <p class="text-gray-600 text-xs sm:text-sm mt-0.5 sm:mt-1 font-normal">Lundi - Samedi : 8h00 - 18h00<br>Dimanche : Fermé</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire de contact -->
            <div class="lg:col-span-8">
                <div class="bg-white p-5 sm:p-8 md:p-10 rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100">
                    <h2 class="text-xl sm:text-2xl font-serif font-semibold text-[#1a2217] mb-1 sm:mb-2">Envoyez-nous un message</h2>
                    <p class="text-xs sm:text-sm text-gray-500 mb-6 sm:mb-8 font-normal">Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-4 sm:space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1.5 sm:mb-2">Nom complet *</label>
                                <input type="text" name="name" required value="{{ old('name') }}" placeholder="Votre nom et prénom" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a] py-2.5 px-3.5 sm:py-3 sm:px-4 text-xs sm:text-sm">
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1.5 sm:mb-2">Adresse Email *</label>
                                <input type="email" name="email" required value="{{ old('email') }}" placeholder="exemple@email.com" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a] py-2.5 px-3.5 sm:py-3 sm:px-4 text-xs sm:text-sm">
                                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1.5 sm:mb-2">Téléphone</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+237 6..." class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a] py-2.5 px-3.5 sm:py-3 sm:px-4 text-xs sm:text-sm">
                                @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1.5 sm:mb-2">Sujet</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Objet de votre demande" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a] py-2.5 px-3.5 sm:py-3 sm:px-4 text-xs sm:text-sm">
                                @error('subject') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-medium text-gray-700 mb-1.5 sm:mb-2">Message *</label>
                            <textarea name="message" rows="4" required placeholder="Comment pouvons-nous vous aider ?" class="w-full rounded-xl border-gray-200 shadow-sm focus:border-[#3ab54a] focus:ring-[#3ab54a] py-2.5 px-3.5 sm:py-3 sm:px-4 text-xs sm:text-sm">{{ old('message') }}</textarea>
                            @error('message') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-7 py-3.5 sm:px-8 sm:py-4 bg-[#d4f977] text-[#1a2217] font-semibold text-sm sm:text-base rounded-full hover:bg-[#c5e865] transition-colors shadow-sm gap-2">
                            Envoyer le message
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
