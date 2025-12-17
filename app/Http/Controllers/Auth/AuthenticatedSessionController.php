<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Jackiedo\DotenvEditor\Facades\DotenvEditor as EnvEditor;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
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
        $request->authenticate();
        $request->session()->regenerate();

        return redirect('/dashboard');
    }

    /**
     * Handle updater re-login if UPDATER_USER_ID is present.
     *
     * @return \Illuminate\Http\RedirectResponse|null
     */
    public function updaterRelogin()
    {
        if (EnvEditor::keyExists('UPDATER_USER_ID')) {
            $userId = EnvEditor::getKey('UPDATER_USER_ID');
            EnvEditor::removeKey('UPDATER_USER_ID'); // one-time use

            if ($user = User::find($userId)) {
                Auth::login($user);
                request()->session()->regenerate();

                // Redirect directly to finishing step
                return redirect('/update?finishing');
            }
        }

        return null; // No updater user ID, nothing to do
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
