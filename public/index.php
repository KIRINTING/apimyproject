<?php

define('LARAVEL_START', microtime(true));

// 1. ค้นหา Autoloader
if (file_exists($a = __DIR__.'/vendor/autoload.php')) {
    require $a;
} elseif (file_exists($b = __DIR__.'/../vendor/autoload.php')) {
    require $b;
} else {
    die("Error: ไม่พบโฟลเดอร์ vendor โปรดตรวจสอบว่าการ Build (Composer) สำเร็จหรือไม่");
}

// 2. ค้นหา Application Instance
if (file_exists($c = __DIR__.'/bootstrap/app.php')) {
    $app = require_once $c;
} elseif (file_exists($d = __DIR__.'/../bootstrap/app.php')) {
    $app = require_once $d;
} else {
    die("Error: ไม่พบ bootstrap/app.php");
}

// 3. รันระบบ Laravel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);