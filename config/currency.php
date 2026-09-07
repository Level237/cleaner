<?php

return [
    // Devise de base stockée en base de données
    'base' => 'XAF',

    // Devise par défaut si géolocalisation impossible
    'default' => 'XAF',

    // Pays par défaut (fallback)
    'default_country' => 'CM',

    // API géolocalisation IP (gratuite, sans clé)
    'geo_endpoint' => env('GEO_ENDPOINT', 'http://ip-api.com/json/{ip}?fields=countryCode'),

    // API taux de change (gratuite, sans clé)
    'rates_endpoint' => env('RATES_ENDPOINT', 'https://open.er-api.com/v6/latest/XAF'),

    // Durées de cache en minutes
    'geo_cache_minutes' => 60 * 24,
    'rates_cache_minutes' => 60 * 12,

    // Correspondance PAYS => DEVISE
    'countries' => [
        // Zone euro
        'FR' => 'EUR', 'BE' => 'EUR', 'DE' => 'EUR', 'ES' => 'EUR',
        'IT' => 'EUR', 'PT' => 'EUR', 'NL' => 'EUR', 'LU' => 'EUR',
        'IE' => 'EUR', 'AT' => 'EUR', 'GR' => 'EUR', 'FI' => 'EUR',

        // Amérique / Europe hors euro
        'US' => 'USD', 'CA' => 'CAD', 'GB' => 'GBP', 'CH' => 'CHF',

        // Maghreb
        'MA' => 'MAD', 'DZ' => 'DZD', 'TN' => 'TND',

        // Afrique de l'Ouest — FRANC CFA (XOF)
        'SN' => 'XOF', 'CI' => 'XOF', 'ML' => 'XOF', 'BF' => 'XOF',
        'NE' => 'XOF', 'TG' => 'XOF', 'BJ' => 'XOF', 'GW' => 'XOF',

        // Afrique centrale — FRANC CFA (XAF)
        'CM' => 'XAF', 'GA' => 'XAF', 'CG' => 'XAF', 'TD' => 'XAF',
        'GQ' => 'XAF', 'CF' => 'XAF',

        // Moyen-Orient
        'AE' => 'AED', 'SA' => 'SAR',
    ],

    // Devises proposées dans le sélecteur manuel
    'available' => ['EUR', 'USD', 'CAD', 'GBP', 'CHF', 'MAD', 'XOF', 'XAF', 'AED'],

    // Format d'affichage par devise
     'formats' => [
        'EUR' => ['symbol' => '€',    'after' => true],
        'USD' => ['symbol' => '$',    'after' => false],
        'CAD' => ['symbol' => '$ CA', 'after' => false],
        'GBP' => ['symbol' => '£',    'after' => false],
        'CHF' => ['symbol' => 'CHF',  'after' => true],
        'MAD' => ['symbol' => 'DH',   'after' => true],
        'XOF' => ['symbol' => 'FCFA', 'after' => true, 'decimals' => 0],
        'XAF' => ['symbol' => 'FCFA', 'after' => true, 'decimals' => 0],
        'AED' => ['symbol' => 'AED',  'after' => true],
    ],
];