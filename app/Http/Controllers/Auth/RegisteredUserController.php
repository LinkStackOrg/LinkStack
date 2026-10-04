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
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    public function validateHandle(Request $request)
    {
        $pattern = validation_disallowed_regex();
        $min = validation_handle_min();
        $max = validation_handle_max();
        $validator = Validator::make($request->all(), [
            'littlelink_name' => 'required|string|min:'.$min.'|max:'.$max.'|unique:users|regex:/^[\\p{L}0-9-_]+$/u|not_regex:'.$pattern,
        ]);
    
        if ($validator->fails()) {
            return response()->json(['valid' => false]);
        }
    
        return response()->json(['valid' => true]);
    }

    public function store(Request $request)
    {
        $pattern = validation_disallowed_regex();
        $nameMin = validation_name_min();
        $nameMax = validation_name_max();
        $handleMin = validation_handle_min();
        $handleMax = validation_handle_max();
        $emailMax = validation_email_max();
        $passwordMin = validation_password_min();
        $passwordMax = validation_password_max();

        $request->validate([
            'name' => 'required|string|min:'.$nameMin.'|max:'.$nameMax.'|not_regex:'.$pattern,
            'littlelink_name' => 'required|string|min:'.$handleMin.'|max:'.$handleMax.'|unique:users|regex:/^[\\p{L}0-9-_]+$/u|not_regex:'.$pattern,
            'email' => 'required|string|email|max:'.$emailMax.'|unique:users|not_regex:'.$pattern,
            'password' => 'required|string|min:'.$passwordMin.'|max:'.$passwordMax,
        ]);

        $name = $request->input('name');

        if(env('MANUAL_USER_VERIFICATION') == true){
            $block = 'yes';
        } else {
            $block = 'no';
        }

        Auth::login($user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'littlelink_name' => $request->littlelink_name,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]));

        $user->block = $block;
        $user->save();


            $user = $request->name;
            $email = $request->email;
            
            if(env('REGISTER_AUTH') == 'verified'){
                if(env('MANUAL_USER_VERIFICATION') == true){
                try {
                Mail::send('auth.user-confirmation', ['user' => $user, 'email' => $email], function ($message) use ($user) {
                    $message->to(env('ADMIN_EMAIL'))
                            ->subject('New user registration');
                });
            } catch (\Exception $e) {}
        }
    
            try {
            $request->user()->sendEmailVerificationNotification();
            } catch (\Exception $e) {}
        }

        event(new Registered($user));

        return redirect(url('dashboard'));
    }
}
