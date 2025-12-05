<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\LivewireServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware) {
        // Global middleware
        $middleware->use([
            \App\Http\Middleware\TrustHosts::class,
            \App\Http\Middleware\TrustProxies::class,
            \Illuminate\Http\Middleware\HandleCors::class,
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            \App\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            \App\Http\Middleware\Headers::class,
        ]);

        // Web middleware group
        $middleware->web(append: [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // Route middleware aliases
        $middleware->alias([
            'disableCookies' => \App\Http\Middleware\DisableCookies::class,
            'auth' => \App\Http\Middleware\Authenticate::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'link-id' => \App\Http\Middleware\LinkId::class,
            'admin' => \App\Http\Middleware\admin::class,
            'blocked' => \App\Http\Middleware\CheckBlockedUser::class,
            'max.users' => \App\Http\Middleware\MaxUsers::class,
            'impersonate' => \App\Http\Middleware\Impersonate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (\Throwable $e, Request $request) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->route('login')->withErrors(['email' => 'Your session has expired. Please log in again.']);
            }

            try {
                $patterns = ['dashboard', 'dashboard/*', 'admin/*', 'studio/*'];

                if (collect($patterns)->contains(fn($pattern) => $request->is($pattern))) {
                    if ($e instanceof NotFoundHttpException) {
                        $message = "The page you are looking for was not found.";
                        return response()->view('errors.dashboard-error', compact('message'), 404);
                    }

                    $error = $e;
                    $message = $e->getMessage();

                    return response()->view('errors.dashboard-error', compact(['error', 'message']), 500);
                }
            } catch (\Throwable $e) {}
        });
    })
    ->withBindings([
        'path.public' => fn() => dirname(__DIR__),
    ])
    ->create();
