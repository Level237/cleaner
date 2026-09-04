<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Admin') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AlpineJS for interaction -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

    <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:flex flex-col"
        >
            <!-- Brand Logo -->
            <div class="flex items-center justify-center h-20 mt-4 mb-2">
                <h1 class="text-3xl font-bold font-serif tracking-tight text-black">Mondays</h1>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
                
                <!-- Dashboard (Active) -->
                <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl bg-blue-600 text-white shadow-sm transition-colors group">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>

                <!-- Produits -->
                <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors group">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    Produits
                </a>

                <!-- Catégories -->
                <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors group">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Catégories
                </a>

                <!-- Collections -->
                <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors group">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Collections
                </a>

                <!-- Médias -->
                <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors group">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Médias
                </a>

                <!-- Utilisateurs -->
                <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors group">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Utilisateurs
                </a>

                <!-- Diviseur -->
                <div class="pt-6 pb-2">
                    <hr class="border-gray-100">
                </div>

                <!-- Paramètres -->
                <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors group">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Paramètres
                </a>

            </nav>
            
            <!-- User / Logout section at the bottom -->
            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2.5 text-sm font-medium rounded-xl text-red-600 hover:bg-red-50 transition-colors group">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0 text-red-500 group-hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden">
            
            <!-- Topbar -->
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-4 sm:px-6 lg:px-8 z-40">
                
                <div class="flex items-center">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 p-1 mr-3 rounded-md">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    
                    <h2 class="text-xl font-semibold text-gray-800">
                        Vue d'ensemble
                    </h2>
                </div>

                <!-- Right Topbar Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Notification Button -->
                    <button class="text-gray-400 hover:text-gray-500 relative p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
                    </button>

                    <!-- Profile dropdown placeholder -->
                    <div class="flex items-center cursor-pointer">
                        <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">{{ Auth::user()->name ?? 'Administrateur' }}</span>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    
                    <!-- Welcome Card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Bienvenue sur votre tableau de bord !</h3>
                            <p class="text-sm text-gray-500 mt-1">Voici un aperçu de vos activités aujourd'hui.</p>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        
                        <!-- Stat Card 1 -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-50 p-3 rounded-lg">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-500">Utilisateurs</h4>
                                    <span class="text-2xl font-bold text-gray-900">1,250</span>
                                </div>
                            </div>
                        </div>

                        <!-- Stat Card 2 -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-50 p-3 rounded-lg">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-500">Produits</h4>
                                    <span class="text-2xl font-bold text-gray-900">342</span>
                                </div>
                            </div>
                        </div>

                        <!-- Stat Card 3 -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-50 p-3 rounded-lg">
                                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-500">Ventes</h4>
                                    <span class="text-2xl font-bold text-gray-900">€4,500</span>
                                </div>
                            </div>
                        </div>

                        <!-- Stat Card 4 -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-50 p-3 rounded-lg">
                                    <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-500">Avis</h4>
                                    <span class="text-2xl font-bold text-gray-900">4.8</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Content Zone Placeholder -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Activité récente</h3>
                        <div class="h-64 border-2 border-dashed border-gray-200 rounded-xl flex items-center justify-center text-gray-400">
                            Zone de contenu dynamique
                        </div>
                    </div>
                    
                </div>
            </main>
        </div>
        
        <!-- Mobile Sidebar Overlay -->
        <div 
            x-show="sidebarOpen" 
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden transition-opacity"
            style="display: none;"
        ></div>

    </div>
</body>
</html>
