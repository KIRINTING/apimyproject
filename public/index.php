<?php

header('Access-Control-Allow-Origin: https://internproject-front.vercel.app');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

define('LARAVEL_START', microtime(true));

// โหลด Autoloader (ใส่ / เพิ่มเข้าไปหลัง __DIR__)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} else {
    require __DIR__ . '/../vendor/autoload.php';
}

// โหลด Application Instance (ใส่ / เพิ่มเข้าไปหลัง __DIR__)
$app = require_once __DIR__ . '/../bootstrap/app.php';

// รันตัว Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);