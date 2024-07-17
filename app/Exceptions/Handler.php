<?php

namespace App\Exceptions;

use App\Helpers\Helpers;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (Throwable $e,$request){
            return $this->handleException($request,$e);
        });
    }

    public function handleException($request, $e){

        if(Str::contains($request->path(),'api')){

            // 406
            if ($e instanceof ValidationException)
            {
                return Helpers::validationResponse($e->validator->errors()->unique());
            }
            // 404
            if ($e instanceof NotFoundHttpException)
            {
                return Helpers::unauthResponse('Resource not found');
            }
            // 401
            if ($e instanceof UnauthorizedHttpException || $e instanceof AuthenticationException)
            {
                return Helpers::unauthResponse($e->getMessage());
            }// 403
            if ($e instanceof AuthorizationException)
            {
                return Helpers::forbiddenResponse($e->getMessage());
            }
            // if Guzzel time out
            if ($e instanceof ConnectException)
            {
                return Helpers::validationResponse('Server Gateway Time Out');
            }

            DB::rollBack();

        }

    }
}
