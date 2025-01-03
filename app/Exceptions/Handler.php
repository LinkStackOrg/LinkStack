<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Throwable $e, Request $request) {

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

            } catch (Throwable $e) {}

        });
    }
}
