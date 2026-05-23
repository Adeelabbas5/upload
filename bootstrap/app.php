<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Disable custom error view rendering to stop the "Target class [view] does not exist" crash
        $exceptions->render(function (\Throwable $e) {
            return response($e->getMessage(), 500);
        });
    })->create();

return $app;