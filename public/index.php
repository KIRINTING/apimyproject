<?php

header('Access-Control-Allow-Origin: https://internproject-front.vercel.app');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

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