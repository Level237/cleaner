<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <title>Connexion</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
        <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/logo.png') }}">

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-white sm:bg-[#f4f7f4]">
        <div class="min-h-screen flex">
            
            <!-- Left Side : Auth Form -->
            <div class="flex-1 flex flex-col justify-center py-12 px-6 sm:px-12 lg:px-20 xl:px-24 bg-white sm:shadow-2xl z-10 relative lg:max-w-xl xl:max-w-2xl">
                <div class="mx-auto w-full max-w-sm lg:max-w-md">
                    
                    <!-- Logo -->
                    <div class="mb-10 text-center sm:text-left">
                        <a href="{{ url('/') }}" class="inline-block group">
                            <img src="{{ asset('assets/logo.png') }}" alt="Cleaner Logo" class="h-24 w-auto mx-auto sm:mx-0 drop-shadow-sm transition-transform duration-500 group-hover:scale-105">
                        </a>
                    </div>

                    <!-- Slot Content (Form) -->
                    {{ $slot }}
                    
                </div>
            </div>

            <!-- Right Side : Image / Brand -->
            <div class="hidden lg:block lg:flex-1 relative bg-[#1a2217] overflow-hidden">
                <img src="{{ asset('assets/choose.png') }}" alt="Thé Cleaner" class="absolute inset-0 w-full h-full object-cover opacity-50 transition-transform duration-1000 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-[#1a2217]/90 to-[#1a2217]/40 mix-blend-multiply"></div>
                
                <div class="absolute inset-0 flex flex-col items-center justify-center p-16 text-center z-10">
                    <h2 class="text-4xl lg:text-5xl font-extrabold text-white mb-6 leading-tight">
                        Votre rituel <br><span class="text-[#d4f977]">bien-être</span>.
                    </h2>
                    <p class="text-lg text-gray-200 max-w-md">
                        Accédez à votre espace pour gérer vos commandes, découvrir nos nouveautés et suivre votre routine bien-être au quotidien.
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>
