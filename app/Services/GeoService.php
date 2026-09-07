<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeoService
{
    /**
     * Détecte le code pays du visiteur.
     */
    public function country(Request $request): string
    {
        // 1. Déjà détecté précédemment
        if ($country = $request->session()->get('country')) {
            return $country;
        }

        // 2. Robots d'indexation → pays par défaut (SEO cohérent)
        if ($this->isBot($request)) {
            return config('currency.default_country');
        }

        // 3. Header Cloudflare (si ton site est derrière Cloudflare)
        if ($cf = $request->header('CF-IPCountry')) {
            return strtoupper($cf);
        }

        $ip = $request->ip();

        // 4. IP locale / privée (localhost) → pays par défaut
        if (! $ip || ! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return config('currency.default_country');
        }

        // 5. Appel API (résultat caché 24h par IP)
        return Cache::remember(
            'geo:' . $ip,
            now()->addMinutes(config('currency.geo_cache_minutes')),
            function () use ($ip) {
                try {
                    $url = str_replace('{ip}', $ip, config('currency.geo_endpoint'));

                    $country = Http::timeout(2)->get($url)->json('countryCode');

                    return $country ? strtoupper($country) : config('currency.default_country');
                } catch (\Throwable $e) {
                    Log::warning('Géolocalisation impossible : ' . $e->getMessage());

                    return config('currency.default_country');
                }
            }
        );
    }

    /**
     * Détecte les robots (Googlebot, Bingbot...).
     */
    protected function isBot(Request $request): bool
    {
        $ua = strtolower($request->userAgent() ?? '');

        foreach (['googlebot', 'bingbot', 'bot', 'crawl', 'spider', 'slurp'] as $needle) {
            if (str_contains($ua, $needle)) {
                return true;
            }
        }

        return false;
    }
}