

<header x-data="{ mobileMenuOpen: false, scrolled: false }" 
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="{'bg-[#283324]/90 backdrop-blur-md shadow-sm': scrolled, 'bg-transparent': !scrolled}"
        class="fixed w-full top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24">
            
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/logo.png') }}" alt="Mondays Logo" class="h-24 w-auto object-contain brightness-0 invert">
                </a>
            </div>

            <!-- Center: Navigation (Desktop) -->
            <nav class="hidden md:flex space-x-8 items-center">
                <a href="{{ url('/') }}" class="text-white/90 hover:text-white font-medium text-base transition-colors">Accueil</a>
                
                <!-- Boutique Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="#" class="text-white/90 hover:text-white font-medium text-base transition-colors inline-flex items-center">
                        Boutique
                        <svg class="ml-1 w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-0 pt-4 w-56 z-50" 
                         style="display: none;">
                        <div class="bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden py-2">
                            @foreach($categories as $category)
                                <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-500 transition-colors">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Collections Dropdown -->
                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="#" class="text-white/90 hover:text-white font-medium text-base transition-colors inline-flex items-center">
                        Collections
                        <svg class="ml-1 w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="absolute left-0 mt-0 pt-4 w-56 z-50" 
                         style="display: none;">
                        <div class="bg-white border border-gray-100 shadow-xl rounded-2xl overflow-hidden py-2">
                            @foreach($collections as $collection)
                                <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-brand-500 transition-colors">{{ $collection->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="#" class="text-white/90 hover:text-white font-medium text-base transition-colors">Notre Maison</a>
                <a href="#" class="text-white/90 hover:text-white font-medium text-base transition-colors">Journal</a>
                <a href="#" class="text-white/90 hover:text-white font-medium text-base transition-colors">Contact</a>
            </nav>

            <!-- Right: Icons -->
            <div class="flex items-center space-x-5">
                <!-- Search -->
                <button class="text-white/90 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                
                <!-- Account -->
                <a href="{{ route('login') }}" class="text-white/90 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
                
                <!-- Cart -->
                <a href="#" class="text-white/90 hover:text-white transition-colors relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <!-- Cart Badge -->
                    <span class="absolute -top-1 -right-2 bg-brand-500 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">0</span>
                </a>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden ml-4">
                    <button @click="mobileMenuOpen = true" class="text-white/90 hover:text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/50 md:hidden" 
         @click="mobileMenuOpen = false"
         style="display: none;"></div>

    <!-- Mobile Menu Panel (Slide from Right) -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-y-0 right-0 z-50 w-full max-w-sm bg-white overflow-y-auto md:hidden shadow-2xl"
         style="display: none;">
         
        <div class="flex items-center justify-between p-4 border-b border-gray-100">
            <span class="text-xl font-bold text-gray-900 font-serif">Mondays</span>
            <button @click="mobileMenuOpen = false" class="text-gray-500 hover:text-brand-500 focus:outline-none p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="px-4 py-6 space-y-6">
            <a href="{{ url('/') }}" class="block text-xl font-medium text-gray-900 hover:text-brand-500">Accueil</a>
            
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between items-center w-full text-left text-xl font-medium text-gray-900 hover:text-brand-500">
                    Boutique
                    <svg class="w-5 h-5 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" class="mt-4 pl-4 space-y-4 border-l-2 border-gray-100" style="display: none;">
                    @foreach($categories as $category)
                        <a href="#" class="block text-lg text-gray-600 hover:text-brand-500">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between items-center w-full text-left text-xl font-medium text-gray-900 hover:text-brand-500">
                    Collections
                    <svg class="w-5 h-5 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" class="mt-4 pl-4 space-y-4 border-l-2 border-gray-100" style="display: none;">
                    @foreach($collections as $collection)
                        <a href="#" class="block text-lg text-gray-600 hover:text-brand-500">{{ $collection->name }}</a>
                    @endforeach
                </div>
            </div>

            <a href="#" class="block text-xl font-medium text-gray-900 hover:text-brand-500">Notre Maison</a>
            <a href="#" class="block text-xl font-medium text-gray-900 hover:text-brand-500">Journal</a>
            <a href="#" class="block text-xl font-medium text-gray-900 hover:text-brand-500">Contact</a>
        </div>
        
        <div class="absolute bottom-0 left-0 w-full p-6 border-t border-gray-100 bg-gray-50">
            <a href="{{ route('login') }}" class="flex items-center justify-center w-full px-4 py-3 text-base font-medium text-white bg-brand-500 hover:bg-brand-600 rounded-xl transition-colors">
                Se connecter
            </a>
        </div>
    </div>
</header>
