<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\CompanyAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api/v1/api.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "authAdmin"=>AdminAuthMiddleware::class,
            "authCompany"=>CompanyAuthMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

    })->create();
