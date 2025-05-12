<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    protected function context()
    {
        return array_merge(parent::context(), [
            'user_id' => auth()->id(),
            'request_url' => request()->fullUrl(),
        ]);
    }

    public function render($request, Throwable $exception)
    {
        // ModelNotFoundException　findOrFail() でモデルが見つからない場合 Illuminate\Database\Eloquent\ModelNotFoundException
        // ValidationException　リクエストのバリデーションエラーが発生した場合 Illuminate\Validation\ValidationException
        // AuthenticationException　認証されていないユーザーがアクセスしようとした場合 Illuminate\Auth\AuthenticationException
        // AuthorizationException　ユーザーが許可されていないアクションを実行しようとした場合 Illuminate\Auth\Access\AuthorizationException
        // HttpException　任意のHTTPエラー（例: abort(403) など） Symfony\Component\HttpKernel\Exception\HttpException
        // ThrottleRequestsException　レートリミットを超えた場合（APIなど） Illuminate\Routing\Exceptions\ThrottleRequestsExceptionまたはIlluminate\Http\Exceptions\ThrottleRequestsException
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            // exceptionがModelNotFoundExceptionの場合
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $exception);
    }
}
