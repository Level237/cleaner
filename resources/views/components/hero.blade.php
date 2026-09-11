<div class="relative bg-[#283324] mt-[-80px] overflow-hidden min-h-[calc(100vh-80px)] flex items-center lg:items-stretch">
    
    <!-- Background Image Mobile -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat block lg:hidden" style="background-image: url('{{ asset('assets/bg-mobile.png') }}');"></div>
    
    <!-- Background Image Desktop -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat hidden lg:block" style="background-image: url('{{ asset('assets/bg.png') }}');"></div>

    <!-- Dark overlay to ensure text readability -->
    <div class="absolute inset-0 z-0 bg-black/30 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full flex items-center">
        <div class="flex flex-col lg:flex-row items-center lg:items-stretch w-full justify-between gap-8 pt-24 pb-12 lg:pt-0 lg:pb-0">
            
            <!-- Left: Content (Vertically centered) -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center text-center lg:text-left lg:py-24">
                <h1 class="text-4xl sm:text-5xl md:text-6xl mt-24 max-sm:mt-12 lg:text-[3.9rem] text-[#F8F9F5] leading-[1.15]">
                    Le thé qui fait du bien à <span class="text-[#d4f977]">votre corps.</span>
                </h1>
                <p class="mt-4 sm:mt-6 text-sm sm:text-base md:text-lg text-gray-200 max-w-xl mx-auto lg:mx-0 leading-relaxed font-light">
                    Des infusions aux plantes soigneusement sélectionnées pour accompagner votre détox, booster votre énergie et retrouver votre légèreté jour après jour.
                </p>
                
                <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 sm:gap-6">
                    <!-- Primary CTA -->
                    <a href="{{ route('products.index') }}" class="w-auto px-7 py-3.5 sm:px-8 sm:py-4 bg-[#d4f977] text-[#1a2217] font-semibold rounded-full hover:bg-[#c4eb63] transition-all shadow-[0_0_30px_rgba(212,249,119,0.2)] hover:shadow-[0_0_40px_rgba(212,249,119,0.4)] text-center text-sm sm:text-base">
                        Découvrir nos produits
                    </a>
                    
                    <!-- Secondary CTA -->
                    <a href="{{ route('collections.index') }}" class="w-auto px-5 py-3 sm:px-6 sm:py-4 bg-transparent text-white font-medium rounded-full hover:bg-white/10 transition-all flex items-center justify-center gap-3 group text-sm sm:text-base">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/10 group-hover:bg-white/20 transition-colors flex items-center justify-center backdrop-blur-md">
                            <svg class="w-4 h-4 text-white ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </div>
                        Nos collections
                    </a>
                </div>
            </div>

            <!-- Right: Image (Hidden on mobile, displayed on desktop/laptop) -->
            <div class="hidden lg:flex mt-20 lg:w-1/2 justify-center items-end relative">
                <img src="{{ asset('assets/hero1.png') }}" alt="Thé bien-être" width="600" height="600" fetchpriority="high" decoding="async" class="w-full max-w-lg xl:max-w-xl object-contain object-bottom drop-shadow-2xl relative z-10 animate-fade-in-up">
            </div>

        </div>
    </div>
</div>
