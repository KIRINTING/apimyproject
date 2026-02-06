<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    // ปิดการแจ้งเตือน Deprecated เพื่อไม่ให้ไปรบกวน API Response
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
}
}
