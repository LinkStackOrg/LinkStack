<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return mixed
     */
    protected function authenticate($request, array $guards)
    {
        // Before checking authentication, try to re-authenticate from cache if user is not logged in
        // This is specifically for the update process where sessions may be lost
        if (!Auth::check() && $request->is('update*')) {
            try {
                $updateUserId = Cache::get('update_auth_user_id');
                if ($updateUserId) {
                    $user = User::find($updateUserId);
                    if ($user && $user->role === 'admin') {
                        Auth::login($user);
                    }
                }
            } catch (\Exception $e) {
                // If re-authentication fails, continue with normal authentication flow
            }
        }

        // Call parent authentication check
        parent::authenticate($request, $guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}