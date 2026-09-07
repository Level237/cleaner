<section id="bienfaits" class="relative w-full bg-[#1a2217] overflow-hidden border-t border-white/5">

    {{-- Décor d'arrière-plan lumineux --}}
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#d4f977]/10 rounded-full blur-[100px]" aria-hidden="true"></div>
    <div class="absolute -bottom-40 -right-32 w-[32rem] h-[32rem] bg-[#435b39]/20 rounded-full blur-[120px]" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">

        {{-- ===== En-tête ===== --}}
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block text-[#d4f977] font-semibold text-sm uppercase tracking-[0.2em]">
                Les bienfaits
            </span>
            <h2 class="mt-4 text-4xl sm:text-5xl font-serif text-[#F8F9F5] leading-tight">
                Un thé aux bienfaits qui <span class="italic text-[#d4f977]">changent votre quotidien</span>
            </h2>
            <p class="mt-6 text-lg text-gray-300 font-light leading-relaxed">
                Chaque tasse Cleaner associe des plantes soigneusement sélectionnées
                pour accompagner votre corps, naturellement et en douceur.
            </p>
        </div>

        {{-- ===== Grille des 4 bienfaits ===== --}}
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

            {{-- Bienfait 1 : Détox --}}
            <div class="group bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-md hover:bg-white/[0.04] hover:border-[#d4f977]/30 transition-all duration-500 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-[#283324] flex items-center justify-center text-[#d4f977] shadow-[0_0_15px_rgba(212,249,119,0.1)] group-hover:scale-110 transition-transform duration-500">
                    <!-- FA Leaf SVG -->
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 384 512"><path d="M372.4 121.2C361.6 77.2 316.6 42.6 264.4 23 212.1 3.5 154.5-4.4 102.5 13.9 50.4 32.2 9.5 73.5 1.5 125.7c-8.1 52.2 16.7 101.4 61.2 131.7L32 304c-8.8 8.8-8.8 23.2 0 32s23.2 8.8 32 0l38.2-38.2c44.5 19 96.8 23 148.9 9.3 52.1-13.6 96.7-47.5 119.5-96 22.8-48.4 20.3-104.9-3.2-152.9l5-5c8.8-8.8 8.8-23.2 0-32s-23.2-8.8-32 0l-67 67zm-55 128.5c-15.9 33.7-46.9 57.3-83.2 66.8-36.4 9.5-72.7 6.6-103.7-6.5l112.5-112.5c8.8-8.8 8.8-23.2 0-32s-23.2-8.8-32 0L98.5 278c-30.8-21.2-48.1-55.5-42.5-91.8 5.6-36.3 34.1-65.1 70.3-77.9 36.3-12.8 76.5-7.3 112.9 14.8 36.4 22.1 56 59.8 52.9 99.4l43.2-43.2c8.9 20 12.9 42 10 63.8-2.9 21.8-11.8 42.3-24.9 59z"/></svg>
                </div>
                <h3 class="mt-6 text-xl font-serif font-bold text-white">Détox & élimination</h3>
                <p class="mt-3 text-sm text-gray-400 font-light leading-relaxed">
                    Le thé vert et les plantes détox accompagnent l'élimination naturelle
                    des toxines, pour une sensation de pureté jour après jour.
                </p>
                <a href="{{ url('/boutique') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#d4f977] group-hover:gap-3 transition-all">
                    Thé détox →
                </a>
            </div>

            {{-- Bienfait 2 : Énergie --}}
            <div class="group bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-md hover:bg-white/[0.04] hover:border-[#d4f977]/30 transition-all duration-500 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-[#283324] flex items-center justify-center text-[#d4f977] shadow-[0_0_15px_rgba(212,249,119,0.1)] group-hover:scale-110 transition-transform duration-500">
                    <!-- FA Bolt/Energy SVG -->
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 448 512"><path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288H175.5L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H272.5L349.4 44.6z"/></svg>
                </div>
                <h3 class="mt-6 text-xl font-serif font-bold text-white">Énergie & vitalité</h3>
                <p class="mt-3 text-sm text-gray-400 font-light leading-relaxed">
                    Un coup de fouet naturel, sans la nervosité du café, pour rester
                    actif et concentré du matin au soir.
                </p>
                <a href="{{ url('/boutique') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#d4f977] group-hover:gap-3 transition-all">
                    Thé fraîcheur →
                </a>
            </div>

            {{-- Bienfait 3 : Métabolisme --}}
            <div class="group bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-md hover:bg-white/[0.04] hover:border-[#d4f977]/30 transition-all duration-500 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-[#283324] flex items-center justify-center text-[#d4f977] shadow-[0_0_15px_rgba(212,249,119,0.1)] group-hover:scale-110 transition-transform duration-500">
                    <!-- FA Fire SVG -->
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 384 512"><path d="M153.6 29.9l16-21.3C173.6 3.2 180 0 186.7 0C198.4 0 208 9.6 208 21.3V43.5c0 13.1 5.4 25.7 15.1 34.7L288 142.2c43.7 41.3 64 100.4 64 161.8c0 123.7-100.3 224-224 224C60.3 528 0 467.7 0 392c0-79.6 42.1-152.1 112.5-191.1l23.5-13.1c9.7-5.4 15.1-15.6 15.1-26.7V29.9zM224 352c0-35.3-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64s64-28.7 64-64z"/></svg>
                </div>
                <h3 class="mt-6 text-xl font-serif font-bold text-white">Métabolisme & minceur</h3>
                <p class="mt-3 text-sm text-gray-400 font-light leading-relaxed">
                    Le thé vert est reconnu pour soutenir le métabolisme et la combustion
                    des graisses, dans le cadre d'un mode de vie sain.
                </p>
                <a href="{{ url('/boutique') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#d4f977] group-hover:gap-3 transition-all">
                    Thé minceur →
                </a>
            </div>

            {{-- Bienfait 4 : Légèreté --}}
            <div class="group bg-white/[0.02] border border-white/10 rounded-[2rem] p-8 backdrop-blur-md hover:bg-white/[0.04] hover:border-[#d4f977]/30 transition-all duration-500 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-2xl bg-[#283324] flex items-center justify-center text-[#d4f977] shadow-[0_0_15px_rgba(212,249,119,0.1)] group-hover:scale-110 transition-transform duration-500">
                    <!-- FA Feather SVG -->
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 512 512"><path d="M16 288c-11.5 0-19.1-11.8-14.7-22.3l29.8-71.5C44.7 161.4 77 132.8 114 117l248-106.3c15.8-6.8 33.3 2.6 37 19.3l38 171.1c5.9 26.6-4.9 54-28.4 69.7l-265 176.7c-9.5 6.3-22 3.6-28.2-5.9l-19.2-28.8-19.2 28.8c-6.3 9.5-18.7 12.2-28.2 5.9l-26.6-17.7C18.6 303.4 16 295.9 16 288zM416 32a32 32 0 1 0 0 64 32 32 0 1 0 0-64z"/></svg>
                </div>
                <h3 class="mt-6 text-xl font-serif font-bold text-white">Légèreté & ventre plat</h3>
                <p class="mt-3 text-sm text-gray-400 font-light leading-relaxed">
                    Une infusion légère à savourer après les repas, pour une digestion
                    confortable et une sensation de ventre plat.
                </p>
                <a href="{{ url('/boutique') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-[#d4f977] group-hover:gap-3 transition-all">
                    Thé ventre plat →
                </a>
            </div>
        </div>

        {{-- ===== Mini-benefits ===== --}}
     

        {{-- ===== CTA final ===== --}}
        <div class="mt-16 text-center">
            <a href="{{ url('/boutique') }}"
               class="inline-block bg-[#d4f977] text-[#1a2217] font-bold px-10 py-5 rounded-full shadow-[0_0_30px_rgba(212,249,119,0.2)] hover:shadow-[0_0_40px_rgba(212,249,119,0.4)] hover:bg-[#c4eb63] transition-all duration-300 transform hover:-translate-y-1">
                Découvrir la boutique
            </a>
            
        </div>
    </div>
</section>
