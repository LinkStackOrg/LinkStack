<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
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
        // Before checking authentication, try to re-authenticate from cookie if user is not logged in
        // This is specifically for the update process where sessions may be lost due to Laravel version changes
        if (!Auth::check() && $request->is('update*')) {
            try {
                // Check for update authentication token cookie
                $updateToken = $request->cookie('update_auth_token');
                
                if ($updateToken) {
                    // Verify and decode the token
                    $tokenData = $this->verifyUpdateToken($updateToken);
                    if ($tokenData && isset($tokenData['user_id'])) {
                        $user = User::find($tokenData['user_id']);
                        if ($user && $user->role === 'admin') {
                            Auth::login($user);
                        }
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
     * Verify the update authentication token
     * 
     * @param string $token
     * @return array|null
     */
    protected function verifyUpdateToken($token)
    {
        try {
            // Validate and decode base64
            $decoded = base64_decode($token, true);
            if ($decoded === false) {
                return null;
            }
            
            // Token format: user_id:timestamp:hash
            $parts = explode(':', $decoded);
            if (count($parts) !== 3) {
                return null;
            }
            
            [$userId, $timestamp, $hash] = $parts;
            
            // Validate userId is a positive integer
            if (!ctype_digit($userId) || (int)$userId <= 0) {
                return null;
            }
            
            // Validate timestamp is numeric
            if (!ctype_digit($timestamp)) {
                return null;
            }
            
            // Check if token is not older than 2 hours
            if ((time() - (int)$timestamp) > 7200) {
                return null;
            }
            
            // Verify hash using APP_KEY
            $expectedHash = hash_hmac('sha256', $userId . ':' . $timestamp, config('app.key'));
            if (!hash_equals($expectedHash, $hash)) {
                return null;
            }
            
            return ['user_id' => (int)$userId, 'timestamp' => (int)$timestamp];
        } catch (\Exception $e) {
            return null;
        }
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