<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <x-seo :model="$seoModel ?? null" :title="$seoTitle ?? null" :description="$seoDescription ?? null" :image="$seoImage ?? null" />

        <!-- Favicon / Logo Icon -->
        <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
        <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/logo.png') }}">



        <!-- Preconnect & DNS Prefetch for CDNs & Fonts -->
        <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
        <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

        <!-- Preload Critical LCP Assets -->
        <link rel="preload" as="image" href="{{ asset('assets/logo.png') }}" type="image/png">
        @if(request()->routeIs('home'))
            <link rel="preload" as="image" href="{{ asset('assets/hero1.png') }}" type="image/png" fetchpriority="high">
            <link rel="preload" as="image" href="{{ asset('assets/bg.png') }}" type="image/png">
        @endif

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased text-gray-900 bg-white">
        
        <!-- Header -->
        <x-store-header />

        <!-- Page Content -->
        <main class="flex-grow pt-20">
            @yield('content')
        </main>
        
        <x-footer />

        <!-- Floating WhatsApp Live Chat Widget -->
        <x-whatsapp-widget />

    @stack('scripts')
</body>
</html>
