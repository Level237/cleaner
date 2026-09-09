<section class="py-12 sm:py-20 lg:py-32 bg-[#F8F9F5] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-10 sm:mb-16">
            <span class="inline-block text-[#283324] font-medium text-xs sm:text-sm uppercase tracking-[0.2em]">
                Le rituel de dégustation
            </span>
            <h2 class="mt-3 sm:mt-4 text-2xl sm:text-4xl lg:text-5xl font-serif text-[#1a2217] leading-snug sm:leading-tight font-medium">
                L'art d'une infusion parfaite en <span class=" text-[#435b39]">3 minutes</span>
            </h2>
            <p class="mt-3 sm:mt-6 text-sm sm:text-lg text-gray-600 font-normal leading-relaxed">
                Un rituel simple et raffiné pour révéler la plénitude des arômes et les bienfaits naturels de nos plantes.
            </p>
        </div>

        {{-- Grid: Video (Left) + Ritual Steps & Tips (Right) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-center">

            {{-- Video Showcase Column --}}
            <div class="lg:col-span-5 relative w-full">
                <!-- Soft background glow -->
                <div class="absolute -inset-4 bg-[#d4f977]/25 rounded-[3rem] transform rotate-2 scale-105 opacity-60 blur-xl pointer-events-none"></div>
                <div class="absolute -inset-4 bg-[#435b39]/15 rounded-[3rem] transform -rotate-2 scale-105 opacity-50 blur-xl pointer-events-none"></div>

                <!-- Video Card -->
                <div class="relative rounded-2xl sm:rounded-[2.5rem] overflow-hidden shadow-xl aspect-[4/5] bg-[#283324] cursor-pointer group"
                     x-data="{ playing: true }"
                     @click="if(playing) { $refs.video.pause(); playing = false; } else { $refs.video.play(); playing = true; }">
                    
                    <video x-ref="video" class="absolute inset-0 w-full h-full object-cover" autoplay loop muted playsinline>
                        <source src="{{ asset('assets/video1.mp4') }}" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture vidéo.
                    </video>
                    
                    <!-- Top Badge -->
                    <div class="absolute top-4 left-4 z-10">
                        <span class="inline-flex items-center gap-1.5 bg-[#1a2217]/80 backdrop-blur-md text-[#d4f977] text-xs font-medium px-3 py-1.5 rounded-full border border-white/10 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-[#d4f977] animate-pulse"></span>
                            Rituel en vidéo
                        </span>
                    </div>

                    <!-- Play/Pause Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300"
                         :class="playing ? 'opacity-0 group-hover:opacity-100 bg-black/10' : 'opacity-100 bg-black/40'">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/30 transform transition-transform duration-300 group-hover:scale-110">
                            <!-- Play Icon -->
                            <svg x-show="!playing" class="w-7 h-7 sm:w-8 sm:h-8 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            <!-- Pause Icon -->
                            <svg x-show="playing" class="w-7 h-7 sm:w-8 sm:h-8" fill="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Steps & Tip Column --}}
            <div class="lg:col-span-7 flex flex-col justify-center">

                <!-- 4 Interactive Steps Timeline Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                    
                    <!-- Step 1 -->
                    <div class="bg-white p-5 sm:p-6 rounded-2xl sm:rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold tracking-wider text-[#435b39] uppercase bg-[#f4fbf5] px-2.5 py-1 rounded-full">Étape 01</span>
                            <span class="text-xs text-gray-400 font-medium">90 °C</span>
                        </div>
                        <h3 class="text-base sm:text-lg font-serif font-semibold text-[#1a2217]">Eau frémissante</h3>
                        <p class="mt-1.5 text-xs sm:text-sm text-gray-500 font-normal leading-relaxed">
                            Faites chauffer une eau pure à 90 °C. L'eau doit frémir sans bouillir pour conserver la délicatesse des plantes.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white p-5 sm:p-6 rounded-2xl sm:rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold tracking-wider text-[#435b39] uppercase bg-[#f4fbf5] px-2.5 py-1 rounded-full">Étape 02</span>
                            <span class="text-xs text-gray-400 font-medium">1 Infusette</span>
                        </div>
                        <h3 class="text-base sm:text-lg font-serif font-semibold text-[#1a2217]">Dosage équilibré</h3>
                        <p class="mt-1.5 text-xs sm:text-sm text-gray-500 font-normal leading-relaxed">
                            Déposez 1 infusette (ou 2g de mélange) dans une tasse ou une théière de 250 ml.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white p-5 sm:p-6 rounded-2xl sm:rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold tracking-wider text-[#435b39] uppercase bg-[#f4fbf5] px-2.5 py-1 rounded-full">Étape 03</span>
                            <span class="text-xs text-gray-400 font-medium">3 à 5 min</span>
                        </div>
                        <h3 class="text-base sm:text-lg font-serif font-semibold text-[#1a2217]">Temps d'infusion</h3>
                        <p class="mt-1.5 text-xs sm:text-sm text-gray-500 font-normal leading-relaxed">
                            Laissez infuser 3 à 5 minutes à couvert afin de capturer l'ensemble des huiles essentielles.
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div class="bg-white p-5 sm:p-6 rounded-2xl sm:rounded-3xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold tracking-wider text-[#435b39] uppercase bg-[#f4fbf5] px-2.5 py-1 rounded-full">Étape 04</span>
                            <span class="text-xs text-gray-400 font-medium">Chaud / Glacé</span>
                        </div>
                        <h3 class="text-base sm:text-lg font-serif font-semibold text-[#1a2217]">Dégustation</h3>
                        <p class="mt-1.5 text-xs sm:text-sm text-gray-500 font-normal leading-relaxed">
                            Dégustez bien chaud pour un moment réconfortant ou laissez refroidir selon vos envies.
                        </p>
                    </div>

                </div>

                <!-- Cold Brew Tip (No emoji, clean SVG icon) -->
                <div class="mt-6 p-5 sm:p-6 bg-white rounded-2xl sm:rounded-3xl border border-[#283324]/10 shadow-sm flex items-start gap-4 relative overflow-hidden">
                    <div class="w-10 h-10 rounded-xl bg-[#283324] flex items-center justify-center text-[#d4f977] shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18m-9-9h18M5.636 5.636l12.728 12.728M5.636 18.364L18.364 5.636"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-semibold text-[#1a2217] text-sm sm:text-base">Astuce infusion à froid</h4>
                        <p class="text-gray-600 mt-1 text-xs sm:text-sm font-normal leading-relaxed">
                            Laissez infuser 8 heures au réfrigérateur dans 1 litre d'eau fraîche pour une boisson naturellement désaltérante.
                        </p>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="mt-8 text-left">
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center justify-center px-7 py-3.5 sm:px-9 sm:py-4 bg-[#283324] text-white font-medium text-sm sm:text-base rounded-full hover:bg-[#1a2217] transition-all shadow-md hover:shadow-lg group w-auto gap-2">
                        Découvrir la collection
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>
