<?php

require __DIR__ . '/../vendor/autoload.php';

// Boot the application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// FORCE: Ensure the application is fully booted
// This is critical for Serverless to initialize the View service
$app->boot();

$response = $app->handleRequest(
    Illuminate\Http\Request::capture()
);

$response->send();