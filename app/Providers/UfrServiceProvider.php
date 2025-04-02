<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UfrServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Rendre les UFRs disponibles dans toutes les vues
        view()->share('ufrs', config('ufrs.ufrs'));
    }
} 