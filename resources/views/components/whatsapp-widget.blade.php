<div x-data="{ 
    open: false, 
    showBadge: true,
    isTyping: false,
    hasLoaded: false,
    toggleChat() {
        this.open = !this.open;
        this.showBadge = false;
        if (this.open && !this.hasLoaded) {
            this.isTyping = true;
            setTimeout(() => {
                this.isTyping = false;
                this.hasLoaded = true;
            }, 1200);
        }
    },
    startChat(customText) {
        const text = customText ? encodeURIComponent(customText) : encodeURIComponent('Bonjour Cleaner, j\'aimerais avoir des conseils sur vos thés.');
        window.open(`https://wa.me/237682826160?text=${text}`, '_blank');
    }
}" class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-50 flex flex-col items-end">

    <!-- Chat Popup Box -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         @click.outside="open = false"
         class="w-[calc(100vw-2rem)] sm:w-[360px] md:w-[390px] bg-white rounded-2xl sm:rounded-3xl shadow-2xl border border-gray-100 overflow-hidden mb-3.5 relative"
         style="display: none;">
        
        <!-- Header -->
        <div class="bg-[#1a2217] text-white p-3.5 sm:p-4 flex items-center justify-between relative">
            <div class="flex items-center gap-2.5 sm:gap-3">
                <div class="relative">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center font-semibold text-xs shadow-inner">
                        <svg class="w-4.5 h-4.5 sm:w-5 sm:h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.205 1.624zm6.095-4.225l.394.234c1.47.872 3.161 1.333 4.887 1.334 5.158 0 9.356-4.198 9.359-9.359.001-2.5-.972-4.85-2.741-6.62-1.769-1.769-4.118-2.743-6.62-2.743-5.159 0-9.357 4.198-9.359 9.358-.001 1.792.511 3.535 1.482 5.053l.257.401-1.001 3.655 3.743-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </div>
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-[#1a2217] rounded-full"></span>
                </div>
                <div>
                    <h4 class="font-serif font-medium text-xs sm:text-sm text-white">Conseiller Cleaner</h4>
                    <p class="text-[10px] sm:text-xs text-[#d4f977] font-normal" x-text="isTyping ? 'En train d\'écrire...' : 'Disponible • Réponse immédiate'"></p>
                </div>
            </div>
            
            <button @click="open = false" class="text-gray-400 hover:text-white transition-colors p-1 rounded-full">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Chat Content Area (Constant Height) -->
        <div class="p-3.5 sm:p-5 bg-[#F8F9F5] h-[290px] sm:h-[330px] flex flex-col justify-between overflow-y-auto">
            
            <!-- Constant Top Date Tag -->
            <div class="text-center shrink-0">
                <span class="text-[9px] sm:text-[10px] uppercase tracking-wider text-gray-400 font-semibold bg-white/80 px-2.5 py-0.5 rounded-full border border-gray-100">Aujourd'hui</span>
            </div>

            <!-- Animated Typing Indicator Phase -->
            <div x-show="isTyping" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="flex-1 flex flex-col justify-center items-start space-y-2">
                <div class="bg-white px-4 py-3 rounded-2xl rounded-tl-none shadow-xs border border-gray-100 flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-[#435b39] rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                    <span class="w-2 h-2 bg-[#435b39] rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                    <span class="w-2 h-2 bg-[#435b39] rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                </div>
                <span class="text-[10px] sm:text-[11px] text-gray-400 pl-1 font-normal">Un conseiller rédige le message...</span>
            </div>

            <!-- Welcome Message & Options Phase -->
            <div x-show="!isTyping" 
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="space-y-3 flex-1 flex flex-col justify-between pt-1">
                
                <!-- Welcome Message Bubble -->
                <div class="flex items-start gap-2">
                    <div class="bg-white p-3 sm:p-3.5 rounded-2xl rounded-tl-none shadow-xs border border-gray-100 text-xs sm:text-sm text-gray-700 leading-relaxed">
                        Bonjour et bienvenue chez Cleaner.<br>
                        Comment pouvons-nous vous guider aujourd'hui ?
                    </div>
                </div>

                <!-- Navigation & Action Options -->
                <div class="space-y-1.5 sm:space-y-2">
                    <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider px-1">Accès rapide :</p>
                    
                    <!-- Direct Link: Boutique -->
                    <a href="{{ url('/boutique') }}" 
                       class="w-full text-left bg-white hover:bg-[#f4fbf5] hover:border-[#1a2217]/30 p-2 sm:p-2.5 rounded-xl border border-gray-200/80 text-xs sm:text-sm text-gray-800 font-medium transition-all flex items-center justify-between group shadow-xs">
                        <span>Découvrir la boutique</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 group-hover:text-[#1a2217] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <!-- Direct Link: Collections -->
                    <a href="{{ url('/collections') }}" 
                       class="w-full text-left bg-white hover:bg-[#f4fbf5] hover:border-[#1a2217]/30 p-2 sm:p-2.5 rounded-xl border border-gray-200/80 text-xs sm:text-sm text-gray-800 font-medium transition-all flex items-center justify-between group shadow-xs">
                        <span>Explorer les collections</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 group-hover:text-[#1a2217] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>

                    <!-- WhatsApp Advice -->
                    <button @click="startChat('Bonjour Cleaner, j\'aimerais avoir des conseils sur vos thés et infusions.')" 
                            class="w-full text-left bg-white hover:bg-[#f4fbf5] hover:border-[#25D366]/40 p-2 sm:p-2.5 rounded-xl border border-gray-200/80 text-xs sm:text-sm text-gray-800 font-medium transition-all flex items-center justify-between group shadow-xs">
                        <span>Conseil personnalisé sur WhatsApp</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 group-hover:text-[#25D366] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>

                    <!-- WhatsApp Order Tracking -->
                    <button @click="startChat('Bonjour Cleaner, je souhaite suivre l\'état de ma commande.')" 
                            class="w-full text-left bg-white hover:bg-[#f4fbf5] hover:border-[#25D366]/40 p-2 sm:p-2.5 rounded-xl border border-gray-200/80 text-xs sm:text-sm text-gray-800 font-medium transition-all flex items-center justify-between group shadow-xs">
                        <span>Suivi de ma commande</span>
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400 group-hover:text-[#25D366] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Direct WhatsApp CTA Footer -->
        <div class="p-3 sm:p-3.5 bg-white border-t border-gray-100">
            <button @click="startChat()" 
                    class="w-full bg-[#25D366] hover:bg-[#20ba5a] text-white font-semibold text-xs sm:text-sm py-2.5 sm:py-3 px-3.5 rounded-xl transition-all shadow-md flex items-center justify-center gap-2 active:scale-[0.98]">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.205 1.624zm6.095-4.225l.394.234c1.47.872 3.161 1.333 4.887 1.334 5.158 0 9.356-4.198 9.359-9.359.001-2.5-.972-4.85-2.741-6.62-1.769-1.769-4.118-2.743-6.62-2.743-5.159 0-9.357 4.198-9.359 9.358-.001 1.792.511 3.535 1.482 5.053l.257.401-1.001 3.655 3.743-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span>Discuter en direct sur WhatsApp</span>
            </button>
        </div>
    </div>

    <!-- Floating Circular Button Trigger -->
    <div class="relative">
        <!-- Floating Tooltip Notification Badge -->
        <div x-show="!open && showBadge" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="absolute max-sm:hidden right-13 sm:right-14 top-1/2 -translate-y-1/2 bg-[#1a2217] text-white text-[11px] sm:text-xs py-1.5 px-3 sm:py-2 sm:px-3.5 rounded-2xl shadow-xl whitespace-nowrap flex items-center gap-2 border border-[#d4f977]/20 pointer-events-auto">
            <span>Une question ?</span>
            <button @click.stop="showBadge = false" class="text-gray-400 hover:text-white">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <button @click="toggleChat()" 
                aria-label="Ouvrir l'assistance WhatsApp"
                class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-xl hover:scale-105 active:scale-95 transition-all duration-200 flex items-center justify-center relative focus:outline-none ring-4 ring-[#25D366]/20">
            
            <!-- WhatsApp Icon (When closed) -->
            <svg x-show="!open" class="w-6 h-6 sm:w-7 sm:h-7 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.205 1.624zm6.095-4.225l.394.234c1.47.872 3.161 1.333 4.887 1.334 5.158 0 9.356-4.198 9.359-9.359.001-2.5-.972-4.85-2.741-6.62-1.769-1.769-4.118-2.743-6.62-2.743-5.159 0-9.357 4.198-9.359 9.358-.001 1.792.511 3.535 1.482 5.053l.257.401-1.001 3.655 3.743-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            
            <!-- Close Icon (When open) -->
            <svg x-show="open" class="w-5 h-5 sm:w-6 sm:h-6 stroke-current" fill="none" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>

            <!-- Green Online Indicator Badge -->
            <span x-show="!open" class="absolute top-0 right-0 flex h-3.5 w-3.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-500 border-2 border-white"></span>
            </span>
        </button>
    </div>

</div>
