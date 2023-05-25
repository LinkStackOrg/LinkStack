<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $name = $request->input('name');

        if(env('MANUAL_USER_VERIFICATION') == true){
            $block = 'yes';
        } else {
            $block = 'no';
        }

        if(DB::table('users')->where('littlelink_name', $request->name)->exists())
        {
            Auth::login($user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]));
        } else {
            Auth::login($user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'littlelink_name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]));
        }

        $user->block = $block;
        $user->save();


            $user = $request->name;
            $email = $request->email;
            
            try {
            Mail::send('auth.user-confirmation', ['user' => $user, 'email' => $email], function ($message) use ($user) {
                $message->to(env('ADMIN_EMAIL'))
                        ->subject('New user registration');
            });
        } catch (\Exception $e) {}

        try {
        $request->user()->sendEmailVerificationNotification();
        } catch (\Exception $e) {}

        event(new Registered($user));

        return redirect(url('dashboard'));
    }
}
