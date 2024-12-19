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

            try {
            // Check if the request matches a specific route
            if ($request->is('dashboard') || 
                    $request->is('dashboard/*') || 
                    $request->is('admin/*') || 
                    $request->is('studio/*')) {
                    
                // Handle 404 errors for this specific route
                if ($e instanceof NotFoundHttpException) {
                    $message = "The page you are looking for was not found.";
                    return response()->view('errors.dashboard-error', compact('message'), 404);
                }

                // Handle general exceptions for this specific route

                $error = $e;
                $message = $e->getMessage();
                return response()->view('errors.dashboard-error', compact(['error', 'message']), 500);
            }

            // Default exception handling for other routes
            return parent::render($request, $e);
            } catch (Throwable $e) {}

        });
    }
}
