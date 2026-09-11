<footer class="bg-[#d4f977] text-[#1a2217] pt-12 sm:pt-16 pb-8 border-t border-[#1a2217]/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Top Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 sm:gap-10 lg:gap-8 mb-12 sm:mb-16">
            
            {{-- Column 1: Brand & Details --}}
            <div class="sm:col-span-2 lg:col-span-2">
                <a href="{{ url('/') }}" class="inline-block mb-3 sm:mb-4">
                    <img src="{{ asset('assets/logo.png') }}" alt="Cleaner Logo" width="160" height="96" loading="lazy" decoding="async" class="h-20 sm:h-24 w-auto object-contain opacity-90">
                </a>
                <p class="text-xs sm:text-sm text-[#1a2217]/80 leading-relaxed max-w-sm font-normal">
                    Cleaner vous accompagne vers un bien-être naturel. Découvrez nos infusions détox, minceur et énergie à base de plantes rigoureusement sélectionnées.
                </p>
                <div class="mt-4 sm:mt-6 flex flex-col gap-1.5 text-xs sm:text-sm font-semibold text-[#1a2217]">
                    <a href="mailto:contact@cleaner.fr" class="hover:text-[#435b39] transition-colors">contact@cleaner.fr</a>
                    <span class="text-xs font-normal text-[#1a2217]/70">Du lundi au vendredi, 9h - 18h</span>
                </div>
            </div>

            {{-- Column 2: Nos thés --}}
            <div class="lg:col-span-1">
                <h3 class="font-serif font-semibold text-sm sm:text-base mb-4 sm:mb-6 uppercase tracking-wider text-[#1a2217]">Nos thés</h3>
                <ul class="space-y-2.5 sm:space-y-3.5 text-xs sm:text-sm font-medium">
                    @foreach($categories as $category)
                        <li><a href="{{ url('/boutique/' . $category->slug) }}" class="text-[#1a2217]/75 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 3: Collections --}}
            <div class="lg:col-span-1">
                <h3 class="font-serif font-semibold text-sm sm:text-base mb-4 sm:mb-6 uppercase tracking-wider text-[#1a2217]">Collections</h3>
                <ul class="space-y-2.5 sm:space-y-3.5 text-xs sm:text-sm font-medium">
                    @forelse($collections as $collection)
                        <li><a href="{{ url('/collections/' . $collection->slug) }}" class="text-[#1a2217]/75 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">{{ $collection->name }}</a></li>
                    @empty
                        <li><span class="text-[#1a2217]/50 italic text-xs">Aucune collection</span></li>
                    @endforelse
                </ul>
            </div>

            {{-- Column 4: Liens rapides --}}
            <div class="lg:col-span-1">
                <h3 class="font-serif font-semibold text-sm sm:text-base mb-4 sm:mb-6 uppercase tracking-wider text-[#1a2217]">Liens rapides</h3>
                <ul class="space-y-2.5 sm:space-y-3.5 text-xs sm:text-sm font-medium">
                    <li><a href="{{ url('/notre-maison') }}" class="text-[#1a2217]/75 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">Notre maison</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-[#1a2217]/75 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">Contactez-nous</a></li>
                    <li><a href="{{ url('/faq') }}" class="text-[#1a2217]/75 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">FAQ</a></li>
                </ul>
            </div>

        </div>

        {{-- Bottom Bar --}}
        <div class="pt-6 sm:pt-8 border-t border-[#1a2217]/15 flex flex-col md:flex-row items-center justify-between gap-6">
            
            {{-- Social Media Networks --}}
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold uppercase tracking-wider text-[#1a2217]/70 mr-1 hidden sm:inline">Suivez-nous :</span>
                <!-- Instagram -->
                <a href="#" aria-label="Instagram" class="w-9 h-9 rounded-full bg-[#1a2217]/10 flex items-center justify-center hover:bg-[#1a2217] hover:text-[#d4f977] transition-all text-[#1a2217]">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <!-- Facebook -->
                <a href="https://www.facebook.com/share/1GQNqEuxAN" aria-label="Facebook" class="w-9 h-9 rounded-full bg-[#1a2217]/10 flex items-center justify-center hover:bg-[#1a2217] hover:text-[#d4f977] transition-all text-[#1a2217]">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                </a>
                <!-- TikTok -->
                <a href="#" aria-label="TikTok" class="w-9 h-9 rounded-full bg-[#1a2217]/10 flex items-center justify-center hover:bg-[#1a2217] hover:text-[#d4f977] transition-all text-[#1a2217]">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v8.12c-.01 2.92-1.74 5.73-4.49 6.57-2.6.81-5.61.16-7.53-1.67-1.99-1.85-2.61-4.73-1.54-7.21 1.05-2.4 3.42-4.04 6.06-4.22v4.06c-1.35.13-2.63 1.02-3.1 2.27-.47 1.25-.13 2.72.84 3.6 1.01.91 2.59 1.11 3.86.5 1.18-.55 1.96-1.81 1.96-3.18V.02z"/></svg>
                </a>
            </div>

            {{-- Copyright --}}
            <div class="text-[#1a2217]/75 text-xs sm:text-sm font-medium text-center">
                &copy; {{ date('Y') }} Cleaner. Tous droits réservés.
            </div>

            {{-- Payments & Country --}}
           

        </div>
    </div>
</footer>

