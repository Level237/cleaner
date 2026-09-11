<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCacheHeaders
{
    /**
     * Handle an incoming request and set performance HTTP headers.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Do not cache authenticated sessions or POST requests
        if ($request->isMethod('GET') && !auth()->check() && $response->getStatusCode() === 200) {
            $response->headers->set('Cache-Control', 'public, max-age=3600, stale-while-revalidate=86400');
        }

        return $response;
    }
}
