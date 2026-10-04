<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Headers
{
    public function handle(Request $request, Closure $next)
    {
        $csp = [];

        // Check if FORCE_HTTPS is set to true
        if (config('app.force_https')) {
            \URL::forceScheme('https'); // Force HTTPS
            $csp[] = 'upgrade-insecure-requests';
        }

        // Who may embed this instance in a frame, written into frame-ancestors. Empty
        // sends no directive and embedding stays unrestricted, which is the long-standing
        // behaviour; naming anyone opts in, with 'self' always kept so an instance never
        // locks out its own pages. Read through config so a cached config keeps working.
        // Note embedding across sites also needs SESSION_SAME_SITE=none, or the browser
        // withholds the session cookie inside the frame and the page renders logged out.
        $frameAncestors = (array) config('app.allowed_frame_origins', []);

        if (! empty($frameAncestors)) {
            $csp[] = "frame-ancestors 'self' ".implode(' ', $frameAncestors);
        }

        if (! empty($csp)) {
            header('Content-Security-Policy: '.implode('; ', $csp));
        }

        // Check if FORCE_ROUTE_HTTPS is set to true
        if (config('app.force_route_https') && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off')) {
            $redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header("Location: $redirect_url");
            exit();
        }

        return $next($request);
    }
}
