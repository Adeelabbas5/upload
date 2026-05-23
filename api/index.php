<?php

require __DIR__ . '/../vendor/autoload.php';

// 1. Boot the application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 2. Handle the request directly using the Laravel 11 bootstrapper
$response = $app->handleRequest(
    Illuminate\Http\Request::capture()
);

// 3. Send the response
$response->send();