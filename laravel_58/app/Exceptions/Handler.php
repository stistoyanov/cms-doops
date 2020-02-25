<?php

namespace App\Exceptions;

use App\Mail\SendExceptionReportEmail;

use Mail;

use Exception;
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
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        // Uncomment this if needed
        /*if (env('APP_ENV') == 'local') {
            $data = [
                'line' => $exception->getLine(),
                'file' => $exception->getFile(),
                'error' => (string)$exception->getMessage(),
                'traceAsString' => (string)$exception->getTraceAsString(),
            ];

            Mail::to('s.stoyanov@beluga.software')->send(new SendExceptionReportEmail($data));
        }*/

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
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->json(['User have not permission for this page access.']);
        }

        return parent::render($request, $exception);
    }
}
