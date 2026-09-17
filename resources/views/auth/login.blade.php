<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-[#1a2217] mb-2 tracking-tight">Bon retour !</h1>
        <p class="text-gray-500 mb-8 text-base">Veuillez entrer vos identifiants pour vous connecter.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-bold text-[#1a2217] mb-2">Adresse e-mail</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-400"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="block w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#d4f977] focus:border-[#1a2217] text-gray-900 sm:text-sm transition-all bg-gray-50/50 hover:bg-white outline-none" 
                    placeholder="entrez votre email">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm font-medium" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-bold text-[#1a2217]">Mot de passe</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-gray-500 hover:text-[#1a2217] hover:underline transition-colors">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-400"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="block w-full pl-11 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#d4f977] focus:border-[#1a2217] text-gray-900 sm:text-sm transition-all bg-gray-50/50 hover:bg-white outline-none" 
                    placeholder="Entrez votre mot de passe">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm font-medium" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-2">
            <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-[#1a2217] focus:ring-[#1a2217] border-gray-300 rounded cursor-pointer transition-colors">
            <label for="remember_me" class="ml-2 block text-sm font-medium text-gray-600 cursor-pointer">
                Se souvenir de moi
            </label>
        </div>

        <!-- Cloudflare Turnstile Captcha -->
        <div class="pt-2">
            <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
            <div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.key') }}" data-theme="light"></div>
            @error('cf-turnstile-response')
                <span class="text-red-500 text-sm font-medium mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center items-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-base font-bold text-white bg-[#1a2217] hover:bg-[#435b39] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1a2217] transition-all transform hover:-translate-y-0.5 hover:shadow-lg">
                Se connecter
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 ml-2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </button>
        </div>
    </form>

  
</x-guest-layout>
