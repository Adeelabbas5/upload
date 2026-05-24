<?php

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

// Use a writable storage path when running under Vercel / serverless.
// This keeps Laravel from trying to write into the read-only project tree.
if (isset($_ENV['VERCEL']) || isset($_ENV['VERCEL_JOB_ID']) || isset($_SERVER['VERCEL_COMMIT_ID'])) {
    $storagePath = '/tmp/storage';
    
    // Ensure directories exist
    @mkdir($storagePath, 0755, true);
    @mkdir("$storagePath/framework", 0755, true);
    @mkdir("$storagePath/framework/views", 0755, true);
    @mkdir("$storagePath/framework/cache", 0755, true);
    @mkdir("$storagePath/logs", 0755, true);
    @mkdir("$storagePath/app", 0755, true);
    
    $app->useStoragePath($storagePath);
}

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

return $app;