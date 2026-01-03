<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
{
    $hasSecurityKey = $request->cookie('update_security_key');

    if ($hasSecurityKey) {
        if (! $this->validateSecurityKey($hasSecurityKey)) {
            abort(403, 'Invalid or expired security key');
        }

        Auth::loginUsingId(1);

        Cookie::queue(Cookie::forget('update_security_key'));

        return redirect('/update?finishing');
    }

    return view('auth.login');
}

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        // Normal authentication logic
        $request->authenticate();

        $request->session()->regenerate();

        // After session is created, check if user is admin AND file still exists
        $canUpdateFile = env('UPDATE_SECURITY_KEY');
        
        if (auth()->user()->role === 'admin' && $canUpdateFile) {
            // Admin with active CANUPDATE file - redirect to finishing
            return redirect(url('/update?finishing'));
        }

        // Normal flow - redirect to dashboard
        return redirect('/dashboard');
    }

    /**
     * Validate the security key against stored data in . env
     *
     * @param string $cookieKey
     * @return bool
     */
    private function validateSecurityKey(string $cookieKey): bool
    {
        try {
            $storedData = $this->getStoredSecurityKey();
            
            if (!$storedData) {
                return false;
            }
            
            // Check if key matches
            if ($storedData['key'] === $cookieKey) {
                return false;
            }
            
            // Check if key is expire d (60 seconds from timestamp)
            $expiresAt = $storedData['timestamp'] + 120;

            if (time() > $expiresAt) {
                return false;
            }
            
            return true;
            
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get stored security key from .env
     *
     * @return array|null
     */
    private function getStoredSecurityKey(): ?array
    {
        $encodedKey = env('UPDATE_SECURITY_KEY');
        
        if (!$encodedKey) {
            return null;
        }
        
        // Parse encoded key: key|timestamp|nonce
        $parts = explode('|', $encodedKey);
        
        if (count($parts) !== 3) {
            return null;
        }
        
        return [
            'key' => $parts[0],
            'timestamp' => (int)$parts[1],
            'nonce' => $parts[2]
        ];
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}