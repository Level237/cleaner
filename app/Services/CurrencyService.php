<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    protected string $base;

    protected string $current;

    public function __construct()
    {
        $this->base = config('currency.base');

        $this->current = app()->runningInConsole()
            ? config('currency.default')
            : session('currency', config('currency.default'));
    }

    /** Devise actuelle du visiteur */
    public function current(): string
    {
        return $this->current;
    }

    /** Taux de conversion depuis la devise de base */
    public function rate(string $currency): float
    {
        if ($currency === $this->base) {
            return 1.0;
        }

        $rates = Cache::remember(
            'currency:rates:' . $this->base,
            now()->addMinutes(config('currency.rates_cache_minutes')),
            function () {
                try {
                    return Http::timeout(3)
                        ->get(config('currency.rates_endpoint'))
                        ->json('rates', []);
                } catch (\Throwable $e) {
                    Log::warning('Taux de change indisponibles : ' . $e->getMessage());

                    return [];
                }
            }
        );

        return (float) ($rates[$currency] ?? 1.0);
    }

    /** Convertit un montant de la devise de base vers la devise cible */
    public function convert(float $amount, ?string $to = null): float
    {
        return round($amount * $this->rate($to ?? $this->current), 2);
    }

    /** Convertit + formate avec le bon symbole */
    public function format(float $amount, ?string $to = null): string
    {
        $to ??= $this->current;

        $converted = $this->convert($amount, $to);

        $format = config("currency.formats.{$to}", ['symbol' => $to, 'after' => true]);

        $number = number_format($converted, 2, ',', ' ');

        return $format['after']
            ? $number . ' ' . $format['symbol']
            : $format['symbol'] . ' ' . $number;
    }
}