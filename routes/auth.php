<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

if(config('advanced-config.register_url') != '') {
    $register = config('advanced-config.register_url');
} else {
    $register = "/register";
}

if(config('advanced-config.login_url') != '') {
    $login = config('advanced-config.login_url');
} else {
    $login = "/login";
}

if(config('advanced-config.forgot_password_url') != '') {
    $forgot_password = config('advanced-config.forgot_password_url');
} else {
    $forgot_password = "/forgot-password";
}

Route::post('/validate-handle', [RegisteredUserController::class, 'validateHandle']);
    if(env('ALLOW_REGISTRATION') or $register !== '/register') {
        Route::get($register, [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->middleware('max.users')
            ->name('register');

        Route::post($register, [RegisteredUserController::class, 'store'])
            ->middleware('guest')
            ->middleware('max.users');
    } else {
        Route::get($register, function () {
            abort(404);
        })->name('register');

        Route::post($register, function () {
            abort(404);
        });
    }

Route::get($login, [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post($login, [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get( $forgot_password, [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post( $forgot_password, [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

Route::get('/blocked', function () {
                    $user = Auth::user();
                    if ($user && $user->block == 'yes') {
                        return view('auth.blocked');
                    } else {
                        return redirect(url('dashboard'));
                    }
                })->name('blocked');
                