<?php

use App\Http\Responses\ApiResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: base_path('routes/api.php'),
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (NotFoundHttpException|ModelNotFoundException $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error('Recurso não encontrado', 404);
            }
        });

        $exceptions->render(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error('Erro de validação', 422, $e->errors());
            }
        });

        $exceptions->render(function (QueryException $e, $request) {
            if ($request->is('api/*')) {
                if ($e->getCode() === '23000') {
                    return ApiResponse::error('Conflito de dados (duplicado)', 409);
                }

                return ApiResponse::error('Erro de banco de dados', 500);
            }
        });

        $exceptions->render(function (\DomainException $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error($e->getMessage() ?: 'Erro de domínio', 422);
            }
        });

        $exceptions->render(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::error('Erro interno', 500);
            }
        });
    })->create();
