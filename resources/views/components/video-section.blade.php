<section class="py-20 lg:py-32 bg-[#F8F9F5] overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            
            {{-- Left: Text & Steps --}}
            <div class="w-full lg:w-1/2">
                <span class="inline-block text-[#283324] font-semibold text-sm uppercase tracking-[0.2em]">
                    Le rituel
                </span>
                <h2 class="mt-4 text-4xl sm:text-5xl font-serif text-[#1a2217] leading-tight">
                    Préparez votre thé Detoxia comme un pro en 3 minutes
                </h2>
                <p class="mt-6 text-lg text-gray-600 font-light leading-relaxed">
                    L'art de l'infusion ne demande ni temps ni matériel compliqué. 
                    Un rituel simple pour libérer tous les arômes et bienfaits de nos plantes.
                </p>

                {{-- Steps --}}
                <ul class="mt-12 space-y-6">
                    <li class="flex items-center gap-5 group">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white border border-[#283324]/10 shadow-sm flex items-center justify-center text-[#283324] font-serif text-xl font-bold group-hover:bg-[#d4f977] group-hover:border-[#d4f977] transition-colors duration-300">
                            1
                        </div>
                        <div class="text-lg text-gray-800">
                            <strong>Eau à 90 °C</strong> — l'eau frémit, elle ne bout pas
                        </div>
                    </li>
                    <li class="flex items-center gap-5 group">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white border border-[#283324]/10 shadow-sm flex items-center justify-center text-[#283324] font-serif text-xl font-bold group-hover:bg-[#d4f977] group-hover:border-[#d4f977] transition-colors duration-300">
                            2
                        </div>
                        <div class="text-lg text-gray-800">
                            <strong>1 infusette</strong> par tasse de 250 ml
                        </div>
                    </li>
                    <li class="flex items-center gap-5 group">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white border border-[#283324]/10 shadow-sm flex items-center justify-center text-[#283324] font-serif text-xl font-bold group-hover:bg-[#d4f977] group-hover:border-[#d4f977] transition-colors duration-300">
                            3
                        </div>
                        <div class="text-lg text-gray-800">
                            <strong>3 à 5 minutes</strong> selon votre goût
                        </div>
                    </li>
                    <li class="flex items-center gap-5 group">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white border border-[#283324]/10 shadow-sm flex items-center justify-center text-[#283324] font-serif text-xl font-bold group-hover:bg-[#d4f977] group-hover:border-[#d4f977] transition-colors duration-300">
                            4
                        </div>
                        <div class="text-lg text-gray-800">
                            <strong>Dégustez</strong> chaud ou glacé
                        </div>
                    </li>
                </ul>
                
                {{-- Astuce --}}
                <div class="mt-12 p-6 bg-white rounded-3xl border border-[#283324]/5 shadow-sm flex gap-5 items-start relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-[#d4f977]/20 rounded-bl-full -mr-10 -mt-10 pointer-events-none"></div>
                    <div class="text-3xl relative z-10 pt-1">🧊</div>
                    <div class="relative z-10">
                        <h4 class="font-bold text-[#1a2217] text-lg">Astuce version glacée</h4>
                        <p class="text-gray-600 mt-1 leading-relaxed">Laissez infuser 8h au frigo dans 1L d'eau froide pour une boisson incroyablement rafraîchissante.</p>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="mt-12">
                    <a href="{{ url('/boutique/cleaner-detoxia') }}" class="inline-flex items-center justify-center px-10 py-5 bg-[#283324] text-white font-semibold rounded-full hover:bg-[#1a2217] transition-all shadow-lg shadow-[#283324]/20 group">
                        Voir le produit
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

            {{-- Right: Video --}}
            <div class="w-full lg:w-1/2 relative">
                <!-- Decorative Blobs behind the video -->
                <div class="absolute -inset-4 bg-[#d4f977]/30 rounded-[3rem] transform rotate-3 scale-105 opacity-50 blur-xl"></div>
                <div class="absolute -inset-4 bg-[#435b39]/20 rounded-[3rem] transform -rotate-2 scale-105 opacity-50 blur-xl"></div>

                <!-- Video Container -->
                <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl aspect-[4/5] bg-[#283324] cursor-pointer group"
                     x-data="{ playing: true }"
                     @click="if(playing) { $refs.video.pause(); playing = false; } else { $refs.video.play(); playing = true; }">
                    
                    <video x-ref="video" class="absolute inset-0 w-full h-full object-cover" autoplay loop muted playsinline>
                        <source src="{{ asset('assets/video1.mp4') }}" type="video/mp4">
                        Votre navigateur ne supporte pas la balise vidéo.
                    </video>
                    
                    <!-- Play/Pause Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300"
                         :class="playing ? 'opacity-0 group-hover:opacity-100 bg-black/10' : 'opacity-100 bg-black/40'">
                        <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center text-white border border-white/30 transform transition-transform duration-300 group-hover:scale-110">
                            <!-- Play Icon (visible when paused) -->
                            <svg x-show="!playing" class="w-8 h-8 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            <!-- Pause Icon (visible when playing) -->
                            <svg x-show="playing" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" style="display: none;">
                                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
