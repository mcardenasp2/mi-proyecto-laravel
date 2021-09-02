<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Stringable;
class Handler extends ExceptionHandler
{
    use ApiResponse;
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

    public function render($request, Throwable $exception)
    {
        // echo 'Hola';
        // if ($exception instanceof NotFoundHttpException) {
            // return $this->errorResponse("Página no encontrada", $code = 404, $msj = 'Página no encontrada');
        // }
        // dd($exception);
        // return parent::render($request, $exception);

        // return $this->errorResponse("Página no encontrada", $code = 404, $msj = 'Página no encontrada');
 
        // if (env('APP_ENV') == 'local' || !Str::contains($request->path(),'api/')) {
        if (env('APP_ENV') == 'local') {
   
            return parent::render($request, $exception);
        }
 
        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse("Página no encontrada", $code = 404, $msj = 'Página no encontrada');
        }
 
        if ($exception instanceof ModelNotFoundException) {
            return $this->errorResponse("Recurso no encontrado", $code = 404, $msj = 'Recurso no encontrado');
        }
 
        return parent::render($request, $exception);
    }
}
