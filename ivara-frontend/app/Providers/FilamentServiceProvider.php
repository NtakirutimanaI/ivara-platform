<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Admin',
            ]);
        });

        // Add admin middleware to Filament routes
        Route::middleware(['auth', 'admin'])->group(function () {
            Filament::routes();
        });
    }
}
