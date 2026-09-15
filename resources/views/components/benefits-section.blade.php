<section id="bienfaits" class="relative w-full bg-[#1a2217] overflow-hidden border-t border-white/5 py-12 sm:py-20 lg:py-32">

    {{-- Décor d'arrière-plan lumineux --}}
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#d4f977]/10 rounded-full blur-[100px]" aria-hidden="true"></div>
    <div class="absolute -bottom-40 -right-32 w-[32rem] h-[32rem] bg-[#435b39]/20 rounded-full blur-[120px]" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ===== En-tête ===== --}}
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block text-[#d4f977] font-medium text-xs sm:text-sm uppercase tracking-[0.2em]">
                Les bienfaits
            </span>
            <h2 class="mt-3 sm:mt-4 text-2xl sm:text-4xl lg:text-5xl font-serif text-[#F8F9F5] leading-snug sm:leading-tight font-medium">
                Un thé aux bienfaits qui <span class=" text-[#d4f977]">changent votre quotidien</span>
            </h2>
            <p class="mt-3 sm:mt-6 text-sm sm:text-lg text-gray-300 font-normal leading-relaxed">
                Chaque tasse Cleaner associe des plantes soigneusement sélectionnées
                pour accompagner votre corps, naturellement et en douceur.
            </p>
        </div>

        {{-- ===== Grille des 4 bienfaits (Swipe horizontal mobile, Grille desktop) ===== --}}
        <div class="mt-10 sm:mt-16 ml-2 flex overflow-x-auto snap-x snap-mandatory gap-4 sm:gap-6 pb-6 -mx-4 pl-6 pr-6 sm:px-6 lg:mx-0 lg:px-0 lg:grid lg:grid-cols-4 lg:gap-8 lg:overflow-visible lg:pb-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

            {{-- Bienfait 1 : Détox --}}
            <div class="group bg-white/[0.02] border border-white/10 rounded-2xl sm:rounded-[2rem] p-5 sm:p-8 backdrop-blur-md hover:bg-white/[0.04] hover:border-[#d4f977]/30 transition-all duration-500 flex-none w-[68vw] sm:w-[280px] lg:w-auto snap-start flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#283324] flex items-center justify-center text-[#d4f977] shadow-[0_0_15px_rgba(212,249,119,0.1)] group-hover:scale-110 transition-transform duration-500 shrink-0">
                        <!-- Modern Droplet SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 sm:w-7 sm:h-7"><path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/></svg>
                    </div>
                    <h3 class="mt-4 sm:mt-6 text-base sm:text-xl font-serif font-semibold text-white">Détox & élimination</h3>
                    <p class="mt-2 sm:mt-3 text-xs sm:text-sm text-gray-400 font-normal leading-relaxed">
                        Le thé vert et les plantes détox accompagnent l'élimination naturelle
                        des toxines, pour une sensation de pureté jour après jour.
                    </p>
                </div>
                <a href="{{ url('/boutique') }}" class="mt-4 sm:mt-6 inline-flex items-center gap-2 text-xs sm:text-sm font-medium text-[#d4f977] group-hover:gap-3 transition-all">
                    Thé détox →
                </a>
            </div>

            {{-- Bienfait 2 : Énergie --}}
            <div class="group bg-white/[0.02] border border-white/10 rounded-2xl sm:rounded-[2rem] p-5 sm:p-8 backdrop-blur-md hover:bg-white/[0.04] hover:border-[#d4f977]/30 transition-all duration-500 flex-none w-[68vw] sm:w-[280px] lg:w-auto snap-start flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#283324] flex items-center justify-center text-[#d4f977] shadow-[0_0_15px_rgba(212,249,119,0.1)] group-hover:scale-110 transition-transform duration-500 shrink-0">
                        <!-- Modern Lightning SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 sm:w-7 sm:h-7"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    </div>
                    <h3 class="mt-4 sm:mt-6 text-base sm:text-xl font-serif font-semibold text-white">Énergie & vitalité</h3>
                    <p class="mt-2 sm:mt-3 text-xs sm:text-sm text-gray-400 font-normal leading-relaxed">
                        Un coup de fouet naturel, sans la nervosité du café, pour rester
                        actif et concentré du matin au soir.
                    </p>
                </div>
                <a href="{{ url('/boutique') }}" class="mt-4 sm:mt-6 inline-flex items-center gap-2 text-xs sm:text-sm font-medium text-[#d4f977] group-hover:gap-3 transition-all">
                    Thé fraîcheur →
                </a>
            </div>

            {{-- Bienfait 3 : Métabolisme --}}
            <div class="group bg-white/[0.02] border border-white/10 rounded-2xl sm:rounded-[2rem] p-5 sm:p-8 backdrop-blur-md hover:bg-white/[0.04] hover:border-[#d4f977]/30 transition-all duration-500 flex-none w-[68vw] sm:w-[280px] lg:w-auto snap-start flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#283324] flex items-center justify-center text-[#d4f977] shadow-[0_0_15px_rgba(212,249,119,0.1)] group-hover:scale-110 transition-transform duration-500 shrink-0">
                        <!-- Modern Flame SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 sm:w-7 sm:h-7"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>
                    </div>
                    <h3 class="mt-4 sm:mt-6 text-base sm:text-xl font-serif font-semibold text-white">Métabolisme & minceur</h3>
                    <p class="mt-2 sm:mt-3 text-xs sm:text-sm text-gray-400 font-normal leading-relaxed">
                        Le thé vert est reconnu pour soutenir le métabolisme et la combustion
                        des graisses, dans le cadre d'un mode de vie sain.
                    </p>
                </div>
                <a href="{{ url('/boutique') }}" class="mt-4 sm:mt-6 inline-flex items-center gap-2 text-xs sm:text-sm font-medium text-[#d4f977] group-hover:gap-3 transition-all">
                    Thé minceur →
                </a>
            </div>

            {{-- Bienfait 4 : Légèreté --}}
            <div class="group bg-white/[0.02] border border-white/10 rounded-2xl sm:rounded-[2rem] p-5 sm:p-8 backdrop-blur-md hover:bg-white/[0.04] hover:border-[#d4f977]/30 transition-all duration-500 flex-none w-[68vw] sm:w-[280px] lg:w-auto snap-start flex flex-col justify-between">
                <div>
                    <div class="w-11 h-11 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-[#283324] flex items-center justify-center text-[#d4f977] shadow-[0_0_15px_rgba(212,249,119,0.1)] group-hover:scale-110 transition-transform duration-500 shrink-0">
                        <!-- Modern Feather SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 sm:w-7 sm:h-7"><path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"/><line x1="16" x2="2" y1="8" y2="22"/><line x1="17.5" x2="9" y1="15" y2="15"/></svg>
                    </div>
                    <h3 class="mt-4 sm:mt-6 text-base sm:text-xl font-serif font-semibold text-white">Légèreté & ventre plat</h3>
                    <p class="mt-2 sm:mt-3 text-xs sm:text-sm text-gray-400 font-normal leading-relaxed">
                        Une infusion légère à savourer après les repas, pour une digestion
                        confortable et une sensation de ventre plat.
                    </p>
                </div>
                <a href="{{ url('/boutique') }}" class="mt-4 sm:mt-6 inline-flex items-center gap-2 text-xs sm:text-sm font-medium text-[#d4f977] group-hover:gap-3 transition-all">
                    Thé ventre plat →
                </a>
            </div>
        </div>

       
        {{-- ===== CTA final ===== --}}
        <div class="mt-10 sm:mt-16 text-center">
            <a href="{{ url('/collections') }}"
               class="inline-block bg-[#d4f977] text-[#1a2217] font-semibold text-sm sm:text-base px-8 py-4 sm:px-10 sm:py-5 rounded-full shadow-[0_0_30px_rgba(212,249,119,0.2)] hover:shadow-[0_0_40px_rgba(212,249,119,0.4)] hover:bg-[#c4eb63] transition-all duration-300 transform hover:-translate-y-1 w-auto">
                Découvrir Nos collections
            </a>
        </div>
    </div>
</section>
