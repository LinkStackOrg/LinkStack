<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckBlockedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
{
    if (Auth::check() && Auth::user()->block === "yes") {
        return redirect()->route('blocked');
    }
    if (env('MAINTENANCE_MODE') == 'true' && (Auth::check() && Auth::user()->role != 'admin')) {
        return redirect(url(''));
    }

    return $next($request);
}
}