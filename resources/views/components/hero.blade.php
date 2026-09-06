    <div class="relative bg-[#283324] overflow-hidden min-h-[calc(100vh-80px)] flex items-stretch bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/bg.png') }}');">
        
        <!-- Dark overlay to ensure text remains readable depending on the background image -->
        <div class="absolute inset-0 z-0 bg-black/20 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full flex">
            <div class="flex flex-col-reverse lg:flex-row items-stretch w-full justify-between gap-12 lg:gap-8 pt-12 lg:pt-0">
                
                <!-- Left: Content (Vertically centered) -->
                <div class="w-full lg:w-1/2 flex flex-col justify-center text-center lg:text-left pb-12 lg:pb-0 lg:py-24">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-[4rem] font-serif text-[#F8F9F5] leading-[1.1] tracking-tight">
                        Le thé  qui fait du bien-être à<span class="text-[#d4f977] italic"> votre corps.</span>
                    </h1>
                    <p class="mt-6 text-base sm:text-lg text-gray-300 max-w-xl mx-auto lg:mx-0 leading-relaxed font-light">
                        Des infusions aux plantes soigneusement sélectionnées pour accompagner votre détox, booster votre énergie et retrouver votre légèreté jour après jour. Deux sachets par jour, un rituel simple, un bien-être qui se sent.
                    </p>
                    
                    <div class="mt-10 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 sm:gap-6">
                        <!-- Primary CTA -->
                        <a href="#" class="w-full sm:w-auto px-8 py-4 bg-[#d4f977] text-[#1a2217] font-semibold rounded-full hover:bg-[#c4eb63] transition-all shadow-[0_0_30px_rgba(212,249,119,0.2)] hover:shadow-[0_0_40px_rgba(212,249,119,0.4)] text-center">
                            Découvrir nos produits
                        </a>
                        
                        <!-- Secondary CTA -->
                        <a href="#" class="w-full sm:w-auto px-6 py-4 bg-transparent text-white font-medium rounded-full hover:bg-white/5 transition-all flex items-center justify-center gap-3 group">
                            <div class="w-10 h-10 rounded-full bg-white/10 group-hover:bg-white/20 transition-colors flex items-center justify-center backdrop-blur-md">
                                <svg class="w-4 h-4 text-white ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                            Nos collections
                        </a>
                    </div>
                </div>

                <!-- Right: Image (Aligned to bottom) -->
                <div class="w-full lg:w-1/2 flex justify-center items-end relative">
                    <!-- 
                      NOTE: If the image has transparent space at the bottom of the PNG file itself, 
                      you can add a negative margin here like `-mb-8` or `-mb-12` to push the cut part fully out of frame. 
                    -->
                    <img src="{{ asset('assets/hero1.png') }}" alt="Thé bien-être" class="w-full max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl object-contain object-bottom drop-shadow-2xl relative z-10 animate-fade-in-up">
                </div>

            </div>
        </div>
    </div>
