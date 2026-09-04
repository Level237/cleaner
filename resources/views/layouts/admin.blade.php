<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Admin') }} - @yield('title', 'Admin')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-[260px] bg-white border-r border-gray-200/60 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:flex flex-col shadow-sm"
        >
            <!-- Logo Section -->
            <div class="flex items-center h-[72px] px-6 border-b border-gray-100">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center mr-3 shadow-md shadow-blue-600/20">
                    <span class="text-white font-bold font-serif text-lg">M</span>
                </div>
                <h1 class="text-xl font-bold font-sans tracking-tight text-gray-900">Mondays</h1>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <div class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4 px-3">Menu Principal</div>
                
                <a href="{{ route('admin.dashboard') ?? '#' }}" class="flex items-center px-3 py-3 text-base font-semibold rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-all group">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>

                <!-- Produits -->
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-3 py-3 text-base font-semibold rounded-xl {{ request()->routeIs('admin.products.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-all group">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0 {{ request()->routeIs('admin.products.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Produits
                </a>

                <!-- Catégories -->
                <a href="{{ route('admin.categories.index') ?? '#' }}" class="flex items-center px-3 py-3 text-base font-semibold rounded-xl {{ request()->routeIs('admin.categories.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-all group">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0 {{ request()->routeIs('admin.categories.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Catégories
                </a>

                <!-- Collections -->
                <a href="{{ route('admin.collections.index') }}" class="flex items-center px-3 py-3 text-base font-semibold rounded-xl {{ request()->routeIs('admin.collections.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} transition-all group">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0 {{ request()->routeIs('admin.collections.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Collections
                </a>

                <div class="mt-8 mb-4 px-3">
                    <div class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Système</div>
                </div>

                <!-- Médias -->
                <a href="#" class="flex items-center px-3 py-3 text-base font-semibold rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all group">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Médias
                </a>

                <!-- Utilisateurs -->
                <a href="#" class="flex items-center px-3 py-3 text-base font-semibold rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all group">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Utilisateurs
                </a>

                <!-- Paramètres -->
                <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-all group">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Paramètres
                </a>

            </nav>
            
            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-500 hover:text-red-600 hover:bg-red-50 transition-all group">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <header class="h-[72px] bg-white border-b border-gray-100 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-40">
                
                <div class="flex items-center flex-1">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none p-2 mr-3 rounded-md">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <!-- Search Bar (Visible on lg) -->
                    <div class="hidden lg:flex items-center bg-gray-50/80 border border-gray-100 rounded-full px-4 py-2 w-96 group hover:bg-gray-100 transition-colors">
                        <svg class="w-4 h-4 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Search anything..." class="bg-transparent border-none focus:ring-0 p-0 text-sm w-full placeholder-gray-400 text-gray-700">
                        <div class="flex items-center text-gray-400 text-xs ml-2">
                            <kbd class="px-1.5 py-0.5 rounded-md bg-white border border-gray-200 shadow-sm font-sans font-medium text-gray-500">⌘K</kbd>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <!-- Theme Toggle -->
                    <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-full border border-gray-100 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>

                    <!-- Notifications -->
                    <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-full border border-gray-100 transition-colors relative">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>

                    <!-- Avatar -->
                    <div class="ml-1 cursor-pointer">
                        <div class="h-10 w-10 rounded-full bg-gray-200 border-2 border-white shadow-sm flex items-center justify-center overflow-hidden">
                            <!-- Placeholder avatar to match screenshot -->
                            <img src="https://ui-avatars.com/api/?name=Admin&background=f3f4f6&color=374151" alt="Avatar" class="h-full w-full object-cover">
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-gray-50">
                
                @hasSection('header')
                    <div class="mb-6">
                        @yield('header')
                    </div>
                @endif
                
                @if (session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
        
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden transition-opacity" style="display: none;"></div>

    </div>
</body>
</html>
