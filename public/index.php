<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 */

define('LARAVEL_START', microtime(true));

// โหลด Autoloader
require __DIR__.'/../vendor/autoload.php';

// โหลด Application Instance
$app = require_once __DIR__.'/../bootstrap/app.php';

// รันตัว Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);