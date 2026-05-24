<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Detect Vercel environment
$isVercel = isset($_ENV['VERCEL']) || isset($_ENV['VERCEL_JOB_ID']) || isset($_SERVER['VERCEL_COMMIT_ID']);

// 1. Ensure the writable serverless paths exist inside /tmp on Vercel
if ($isVercel) {
    $storagePath = '/tmp/storage';
    $tmpDirs = [
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache',
        '/tmp/storage/logs',
    ];
    
    foreach ($tmpDirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }
    
    // Create database in tmp if it doesn't exist
    $dbPath = '/tmp/database.sqlite';
    if (!file_exists($dbPath)) {
        @touch($dbPath);
    }
}

// 2. Set error/exception handling to output errors for debugging
set_error_handler(function ($severity, $message, $file, $line) use ($isVercel) {
    // Silence tempnam() warnings
    if ($severity === E_NOTICE && str_contains($message, 'tempnam()')) {
        return true;
    }
    if ($severity === E_WARNING && str_contains($message, 'mkdir')) {
        return true;
    }
    return false;
});

set_exception_handler(function ($exception) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Internal Server Error',
        'message' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
    ], JSON_PRETTY_PRINT);
});

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Fatal Error',
            'message' => $error['message'],
            'file' => $error['file'],
            'line' => $error['line'],
        ], JSON_PRETTY_PRINT);
    }
});

define('LARAVEL_START', microtime(true));

try {
    // Determine if the application is in maintenance mode...
    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    // Register the Composer autoloader...
    require __DIR__.'/../vendor/autoload.php';

    // Bootstrap Laravel...
    $app = require_once __DIR__.'/../bootstrap/app.php';

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $request = Request::capture();

    $response = $kernel->handle($request);

    $response->send();

    $kernel->terminate($request, $response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Application Error',
        'message' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
    ], JSON_PRETTY_PRINT);
}