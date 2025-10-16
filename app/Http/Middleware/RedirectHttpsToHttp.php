<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectHttpsToHttp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only redirect HTTPS to HTTP in local development
        if (app()->environment('local') && $request->secure()) {
            $url = str_replace('https://', 'http://', $request->url());
            return redirect($url, 301);
        }

        return $next($request);
    }
}
