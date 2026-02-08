<?php

define('LARAVEL_START', microtime(true));

// โหลด Autoloader (ใส่ / เพิ่มเข้าไปหลัง __DIR__)
// โหลด Autoloader (ใส่ / เพิ่มเข้าไปหลัง __DIR__)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo "<h1>Error: Autoload not found</h1>";
    echo "<p>Checked paths:</p>";
    echo "<ul>";
    echo "<li>" . htmlspecialchars(__DIR__ . '/vendor/autoload.php') . "</li>";
    echo "<li>" . htmlspecialchars(__DIR__ . '/../vendor/autoload.php') . "</li>";
    echo "</ul>";
    echo "<p>Please run <code>composer install</code> in the application root.</p>";
    exit(1);
}

// โหลด Application Instance (ใส่ / เพิ่มเข้าไปหลัง __DIR__)
// โหลด Application Instance (ใส่ / เพิ่มเข้าไปหลัง __DIR__)
if (file_exists(__DIR__ . '/bootstrap/app.php')) {
    $app = require_once __DIR__ . '/bootstrap/app.php';
} elseif (file_exists(__DIR__ . '/../bootstrap/app.php')) {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
} else {
    header('HTTP/1.1 500 Internal Server Error');
    echo "<h1>Error: bootstrap/app.php not found</h1>";
}

// รันตัว Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);