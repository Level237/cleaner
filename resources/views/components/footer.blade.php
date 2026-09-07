<footer class="bg-[#d4f977] text-[#1a2217] pt-16 pb-8 border-t border-[#1a2217]/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Top Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 lg:gap-8 mb-16">
            
            {{-- Column 1: Brand & SEO --}}
            <div class="lg:col-span-2">
                <a href="{{ url('/') }}" class="inline-block">
                    <!-- Logo in dark mode (brightness-0 makes it black/dark) -->
                    <img src="{{ asset('assets/logo.png') }}" alt="Cleaner Logo" class="h-24 w-auto object-contain  opacity-90">
                </a>
                <p class=" text-[#1a2217]/80 leading-relaxed max-w-sm font-medium">
                    Cleaner vous accompagne vers un bien-être naturel. Découvrez nos infusions détox, minceur et énergie à base de plantes rigoureusement sélectionnées.
                </p>
                <div class="mt-6 flex flex-col gap-2 text-sm font-semibold text-[#1a2217]">
                    <a href="mailto:contact@cleaner.fr" class="hover:text-[#435b39] transition-colors">contact@cleaner.fr</a>
                    <span>Lun - Ven, 9h - 18h</span>
                </div>
                
                {{-- Social & Certifs --}}
                <div class="mt-8 flex items-center gap-4">
                    <!-- Instagram -->
                    <a href="#" class="w-10 h-10 rounded-full bg-[#1a2217]/5 flex items-center justify-center hover:bg-[#1a2217] hover:text-[#d4f977] transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <!-- Facebook -->
                    <a href="#" class="w-10 h-10 rounded-full bg-[#1a2217]/5 flex items-center justify-center hover:bg-[#1a2217] hover:text-[#d4f977] transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                    </a>
                    <!-- Tiktok -->
                    <a href="#" class="w-10 h-10 rounded-full bg-[#1a2217]/5 flex items-center justify-center hover:bg-[#1a2217] hover:text-[#d4f977] transition-all">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v8.12c-.01 2.92-1.74 5.73-4.49 6.57-2.6.81-5.61.16-7.53-1.67-1.99-1.85-2.61-4.73-1.54-7.21 1.05-2.4 3.42-4.04 6.06-4.22v4.06c-1.35.13-2.63 1.02-3.1 2.27-.47 1.25-.13 2.72.84 3.6 1.01.91 2.59 1.11 3.86.5 1.18-.55 1.96-1.81 1.96-3.18V.02z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Column 2: Nos thés --}}
            <div>
                <h3 class="font-bold text-lg mb-6 uppercase tracking-wider text-[#1a2217]">Nos thés</h3>
                <ul class="space-y-4 font-medium">
                    @foreach($categories as $category)
                        <li><a href="{{ url('/boutique/' . $category->slug) }}" class="text-[#1a2217]/70 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 3: Collections --}}
            <div>
                <h3 class="font-bold text-lg mb-6 uppercase tracking-wider text-[#1a2217]">Collections</h3>
                <ul class="space-y-4 font-medium">
                    @forelse($collections as $collection)
                        <li><a href="{{ url('/collections/' . $collection->slug) }}" class="text-[#1a2217]/70 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">{{ $collection->name }}</a></li>
                    @empty
                        <li><span class="text-[#1a2217]/50 italic">Aucune collection</span></li>
                    @endforelse
                </ul>
            </div>

            {{-- Column 4 & 5: Maison & Aide --}}
            <div class="flex flex-col gap-10">
                <div>
                    <h3 class="font-bold text-lg mb-6 uppercase tracking-wider text-[#1a2217]">Maison</h3>
                    <ul class="space-y-4 font-medium">
                        <li><a href="#" class="text-[#1a2217]/70 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">À propos de nous</a></li>
                        <li><a href="#" class="text-[#1a2217]/70 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">Notre vision</a></li>
                        <li><a href="#" class="text-[#1a2217]/70 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">Nos produits</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-6 uppercase tracking-wider text-[#1a2217]">Aide</h3>
                    <ul class="space-y-4 font-medium">
                        <li><a href="#" class="text-[#1a2217]/70 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">FAQ</a></li>
                        <li><a href="#" class="text-[#1a2217]/70 hover:text-[#1a2217] hover:underline decoration-2 underline-offset-4 transition-all">CGV & CGU</a></li>
                    </ul>
                </div>
            </div>

        </div>

        {{-- Bottom Bar --}}
        <div class="pt-8 border-t border-[#1a2217]/10 flex flex-col md:flex-row items-center justify-between gap-6">
            
            <div class="text-[#1a2217]/70 text-sm font-medium">
                &copy; {{ date('Y') }} Cleaner. Tous droits réservés.
            </div>

            {{-- Payments --}}
            <div class="flex items-center gap-3 opacity-80">
                <!-- Visa -->
                <div class="h-8 w-12 bg-white rounded border border-[#1a2217]/10 flex items-center justify-center">
                    <svg class="h-4" viewBox="0 0 38 12" fill="none"><path d="M14.545 0l-2.316 11.455h-3.714L10.832 0h3.713zm15.111 11.455h3.336L30.34 0h-3.52c-.754 0-1.378.435-1.63 1.132L21.365 11.455h3.844l.764-2.128h4.698l.44 2.128zm-4.66-4.996l1.246-3.415.714 3.415h-1.96zm-11.472-3.136c-2.023-1.026-5.46-1.57-5.46-1.57s.035 1.547 2.115 2.502c2.08.955 2.254 1.583 2.254 2.235 0 .903-1.082 1.516-2.614 1.516-1.657 0-3.32-.614-3.32-.614l-.545 3.197s1.865.813 4.09.813c2.463 0 5.867-1.127 5.867-4.48 0-1.528-.908-2.39-2.387-3.6zM6.924 0L4.994 7.828 2.658.98C2.457.172 1.777 0 1.777 0H0l3.666 11.455h3.94L10.932 0H6.924z" fill="#1434CB"/></svg>
                </div>
                <!-- Mastercard -->
                <div class="h-8 w-12 bg-white rounded border border-[#1a2217]/10 flex items-center justify-center">
                    <svg class="h-5" viewBox="0 0 24 18" fill="none"><circle cx="7.5" cy="9" r="7.5" fill="#EB001B"/><circle cx="16.5" cy="9" r="7.5" fill="#F79E1B"/><path d="M12 14.82a7.48 7.48 0 010-11.64A7.48 7.48 0 0012 14.82z" fill="#FF5F00"/></svg>
                </div>
                <!-- Apple Pay -->
                <div class="h-8 w-12 bg-black rounded flex items-center justify-center">
                    <svg class="h-4 fill-white" viewBox="0 0 24 24"><path d="M12.152 6.896c-.022-2.316 1.942-3.834 2.046-3.905-1.092-1.57-2.775-1.787-3.376-1.815-1.425-.138-2.784.82-3.513.82-.728 0-1.85-1.8-3.033-.8-1.536.8-2.71 2.87-3.415 4.06-1.442 2.45-2.54 6.91-1.056 9.42.729 1.232 1.614 2.617 3 2.562 1.336-.057 1.834-.848 3.447-.848 1.613 0 2.15.848 3.493.82 1.383-.028 2.138-1.258 2.856-2.459.83-1.186 1.173-2.345 1.196-2.404-.029-.013-2.3-3.69-2.32-6.524m1.967-8.113c.73-.865 1.222-2.072 1.088-3.275-1.054.04-2.308.68-3.06 1.545-.675.767-1.264 2-1.11 3.193 1.18.087 2.355-.596 3.082-1.463"/></svg>
                </div>
                <!-- PayPal -->
                <div class="h-8 w-12 bg-white rounded border border-[#1a2217]/10 flex items-center justify-center">
                    <svg class="h-4" viewBox="0 0 24 24" fill="none"><path d="M7.076 21.337H2.47a.641.641 0 01-.633-.74L4.944 3.09C5.022 2.618 5.424 2.25 5.908 2.25h6.634c3.087 0 5.485 1.107 6.136 4.316.48 2.35-.145 4.307-1.127 5.76-1.464 2.16-4.065 2.883-6.425 2.883h-1.55c-.485 0-.886.368-.964.84l-.872 5.288z" fill="#003087"/><path d="M10.22 10.375h1.55c2.36 0 4.96-.723 6.425-2.882a6.367 6.367 0 001.076-2.93c.125-.79.055-1.503-.178-2.115-.494-1.296-1.597-2.198-3.297-2.198H9.162a.642.642 0 00-.633.547L6.877 10.375h3.344z" fill="#0079C1"/><path d="M9.162 2.25H5.908a.642.642 0 00-.633.547L2.17 22.316a.642.642 0 00.633.74h4.606L9.69 11.214a.642.642 0 01.633-.547h1.55c2.36 0 4.96-.723 6.425-2.882.982-1.453 1.606-3.41 1.127-5.76-.051-.25-.116-.494-.193-.728C17.65 3.357 15.253 2.25 12.166 2.25H9.162z" fill="#00457C"/></svg>
                </div>
            </div>

            {{-- Country --}}
            <div class="flex items-center gap-2 px-4 py-2 bg-[#1a2217]/5 rounded-full font-bold text-sm">
                <span>🇫🇷</span>
                <span>France</span>
            </div>

        </div>
    </div>
</footer>
