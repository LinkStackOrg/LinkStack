<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Headers
{
    public function handle(Request $request, Closure $next)
    {
        // Check if FORCE_HTTPS is set to true
        if (env('FORCE_HTTPS') == 'true') {
            \URL::forceScheme('https'); // Force HTTPS
            header("Content-Security-Policy: upgrade-insecure-requests");
        }

        // Check if FORCE_ROUTE_HTTPS is set to true
        if (env('FORCE_ROUTE_HTTPS') == 'true' && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off')) {
            $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header("Location: $redirect_url");
            exit();
        }

        return $next($request);
    }
}
