<?php

namespace App\Providers;

use App\Filament\Pages\Auth\Login;
use Filament\Facades\Filament;
use Filament\Panel;
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
    public function boot(): void
    {

    }
    // public function panel(Panel $panel): Panel
    // {
    //     return $panel
    //         ->login(Login::class); // ✅ Gunakan custom login page kamu
    // }
}
