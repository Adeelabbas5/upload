<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
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
        // Leave empty or add your custom exception handlers here
    })
    ->booting(function ($app) {
        // Force Laravel to look at the writable /tmp partition for view rendering
        if (isset($_ENV['VERCEL_JOB_ID']) || isset($_SERVER['VERCEL_COMMIT_ID'])) {
            $app->useStoragePath('/tmp/storage');
            
            // Set the explicitly bound path into the view config builder dynamically
            $app['config']->set('view.compiled', '/tmp/storage/framework/views');
        }
    })
    ->create();