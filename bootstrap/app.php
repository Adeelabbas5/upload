<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Initialize the Application
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();

// 2. Early-bind storage paths for Vercel
if (isset($_ENV['VERCEL_JOB_ID']) || isset($_SERVER['VERCEL_COMMIT_ID'])) {
    $app->useStoragePath('/tmp/storage');
    $app['config']->set('view.compiled', '/tmp/storage/framework/views');
}

return $app;