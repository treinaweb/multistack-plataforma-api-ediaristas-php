<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use ApiHandler;

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
    }

    /**
     * Faz o tratamento de exceções no laravel
     *
     * @param [type] $request
     * @param Throwable $e
     * @return void
     */
    public function render($request, Throwable $e)
    {
        if ($request->is('api/*') || $request->is('auth/*')) {
            return $this->getJsonException($e);
        }


        return parent::render($request, $e);
    }
}