<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class MaxUsers
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
        $userCount = User::count(); // get the number of users
        $userCap = config('linkstack.user_cap'); // get the user cap from the config file
    
        if (!empty($userCap)) {
            if ($userCount >= $userCap) {
                abort(403, 'Maximum number of users reached.');
            }
        }
        
        return $next($request);
    }
}
