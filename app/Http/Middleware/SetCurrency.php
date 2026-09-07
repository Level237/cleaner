<?php

namespace App\Http\Middleware;

use App\Services\GeoService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SetCurrency
{
    public function __construct(protected GeoService $geo)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        // Première visite : détection pays → devise
        if (! $request->session()->has('currency')) {
            $country = $this->geo->country($request);

            $currency = config('currency.countries.' . $country, config('currency.default'));

            $request->session()->put([
                'country' => $country,
                'currency' => $currency,
            ]);
        }

        // Partagé avec toutes les vues (pour le sélecteur)
        View::share('currentCurrency', $request->session()->get('currency'));

        return $next($request);
    }
}