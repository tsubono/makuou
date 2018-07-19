<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($this->isHttpException($exception)) {
            if ($request->is('admin/*')) {
                // 403
                if($exception->getStatusCode() == 403) {
                    return response()->view('admin.errors.403');
                }
                // 404
                if($exception->getStatusCode() == 404) {
                    return response()->view('admin.errors.404');
                }
                // 500
                return response()->view('admin.errors.500');
            } else {
                // 403
                if($exception->getStatusCode() == 403) {
                    return response()->view('front.errors.403');
                }
                // 404
                if($exception->getStatusCode() == 404) {
                    return response()->view('front.errors.404');
                }
                // 500
                return response()->view('front.errors.500');
            }
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if (in_array('admin', $exception->guards(), true)) {
            return redirect()->guest(route('admin.login'));
        }

        return redirect()->guest(route('login'));
    }
}
