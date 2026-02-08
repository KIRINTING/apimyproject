<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// หากมีไฟล์หรือโฟลเดอร์อยู่จริงใน public ให้ดึงไฟล์นั้นมาแสดง (เช่น รูปตราครุฑ หรือไฟล์ CSS)
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// หากไม่ใช่ไฟล์จริง ให้ส่งไปที่ index.php เพื่อให้ Laravel จัดการเรื่อง Routing
require_once __DIR__.'/public/index.php';