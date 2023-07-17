<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

      //check is admin
      if (Auth::user() && Auth::user()->role == 'admin') {
            return $next($request);
      }   

            return redirect(url('dashboard'));
    }
}
