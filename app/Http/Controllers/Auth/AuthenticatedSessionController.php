<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GeoSot\EnvEditor\Facades\EnvEditor;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if (EnvEditor::keyExists('UPDATER_USER_ID')) {
            $userId = EnvEditor::getKey('UPDATER_USER_ID');

            // Optional: one-time use
            EnvEditor::deleteKey('UPDATER_USER_ID');

            $user = User::find($userId);

            if ($user) {
                Auth::login($user);
                request()->session()->regenerate();

                return redirect('/update?finishing');
            }
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
