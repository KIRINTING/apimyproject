<?php

return [
    /*
    | ระบุ Path ที่ต้องการให้ใช้ CORS (ปกติคือ api ทุกตัว)
    */
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout'],

    'allowed_methods' => ['*'],

    /*
    | ใส่ URL ของ Angular ที่ Vercel ของคุณที่นี่
    | หรือใช้ '*' เพื่อทดสอบ (ถ้าใช้ '*' ต้องตั้ง supports_credentials เป็น false)
    */
    'allowed_origins' => [
        'https://internproject-front-es1pmhbjf-kirintings-projects.vercel.app',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // ถ้ามีการใช้ Token หรือ Session ต้องเป็น true
];