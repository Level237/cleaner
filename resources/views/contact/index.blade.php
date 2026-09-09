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
                <!-- Carte WhatsApp Live Assistance -->
                <div class="bg-gradient-to-br from-[#f4fbf5] via-[#eaf8ec] to-[#e4f5e7] p-5 sm:p-7 rounded-2xl sm:rounded-3xl border border-[#25D366]/30 shadow-sm relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-[#25D366] text-white flex items-center justify-center shadow-sm shrink-0">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.205 1.624zm6.095-4.225l.394.234c1.47.872 3.161 1.333 4.887 1.334 5.158 0 9.356-4.198 9.359-9.359.001-2.5-.972-4.85-2.741-6.62-1.769-1.769-4.118-2.743-6.62-2.743-5.159 0-9.357 4.198-9.359 9.358-.001 1.792.511 3.535 1.482 5.053l.257.401-1.001 3.655 3.743-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-serif font-medium text-[#1a2217] text-sm sm:text-base">Assistance WhatsApp</h3>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                    </span>
                                    <span class="text-[11px] font-semibold text-emerald-700 uppercase tracking-wider">Conseillers en ligne</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-xs sm:text-sm text-gray-600 font-normal leading-relaxed mb-4">
                        Une question sur nos infusions ou le suivi de votre commande ? Discutez en direct avec notre équipe pour un conseil personnalisé.
                    </p>

                    <a href="https://wa.me/237682826160?text=Bonjour%20Cleaner%20Tea%2C%20j%27aimerais%20avoir%20des%20informations%20sur..." 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="w-full inline-flex items-center justify-center px-4 py-3 sm:py-3.5 bg-[#25D366] hover:bg-[#20ba5a] text-white font-semibold text-xs sm:text-sm rounded-xl transition-all shadow-sm gap-2 active:scale-[0.98]">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.205 1.624zm6.095-4.225l.394.234c1.47.872 3.161 1.333 4.887 1.334 5.158 0 9.356-4.198 9.359-9.359.001-2.5-.972-4.85-2.741-6.62-1.769-1.769-4.118-2.743-6.62-2.743-5.159 0-9.357 4.198-9.359 9.358-.001 1.792.511 3.535 1.482 5.053l.257.401-1.001 3.655 3.743-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span>Discuter sur WhatsApp</span>
                    </a>
                    <p class="text-[11px] text-emerald-800 text-center mt-2.5 font-medium">Réponse rapide assurée (< 15 min)</p>
                </div>

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
                                <p class="text-gray-600 text-xs sm:text-sm mt-0.5 sm:mt-1 font-normal">Douala, Cameroun<br>Akwa, Ancien 3ième</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-[#f4fbf5] text-[#3ab54a] flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-[#1a2217] text-xs sm:text-sm uppercase tracking-wide">Téléphone</h3>
                                <p class="text-gray-600 text-xs sm:text-sm mt-0.5 sm:mt-1 font-normal">+237 6 82 82 61 60</p>
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
