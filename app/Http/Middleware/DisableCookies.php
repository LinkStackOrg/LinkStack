<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class DisableCookies
{

    public function handle(Request $request, Closure $next)
    {
        $cookiesAlreadySet = $request->hasCookie(strtolower(config('app.name')).'_session') || $request->hasCookie('XSRF-TOKEN');

        if ($cookiesAlreadySet) {
            return $next($request);
        }

        Cookie::queue(Cookie::forget(str_replace(' ', '_', strtolower(config('app.name')).'_session')));
        Cookie::queue(Cookie::forget('XSRF-TOKEN'));
        config(['session.driver' => 'array']);

        $response = $next($request);
        $response->headers->remove('Set-Cookie');

        return $response;
    }
}
