<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;


// Ensure the writable serverless view paths exist inside /tmp
if (isset($_ENV['VERCEL_JOB_ID']) || isset($_SERVER['VERCEL_COMMIT_ID'])) {
    $viewPath = '/tmp/storage/framework/views';
    if (!is_dir($viewPath)) {
        mkdir($viewPath, 0755, true);
    }
}

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
