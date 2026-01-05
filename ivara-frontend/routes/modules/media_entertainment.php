<?php

use Illuminate\Support\Facades\Route;
use App\Modules\MediaEntertainment\MediaDashboardController;

/*
|--------------------------------------------------------------------------
| Media & Entertainment Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'ivara_role:admin,manager,supervisor', 'category_access:media-entertainment'])->prefix('admin/media-entertainment')->name('admin.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'index'])->name('index');
    Route::get('/services', [MediaDashboardController::class, 'generic'])->name('services');
    Route::get('/bookings', [MediaDashboardController::class, 'generic'])->name('bookings');
    Route::get('/providers', [MediaDashboardController::class, 'generic'])->name('providers');
    Route::get('/products', [MediaDashboardController::class, 'generic'])->name('products');
    Route::get('/clients', [MediaDashboardController::class, 'generic'])->name('clients');
    Route::get('/payments', [MediaDashboardController::class, 'generic'])->name('payments');
    Route::get('/settings', [MediaDashboardController::class, 'generic'])->name('settings');
});


// Media Consumer
Route::middleware(['auth', 'ivara_role:media_consumer', 'category_access:media-entertainment'])
    ->prefix('media-consumer/dashboard')->name('media_consumer.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'consumer'])->name('index');
});

// Media Creator
Route::middleware(['auth', 'ivara_role:media_creator', 'category_access:media-entertainment'])
    ->prefix('media-creator/dashboard')->name('media_creator.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'creator'])->name('index');
});

// Media Producer
Route::middleware(['auth', 'ivara_role:media_producer', 'category_access:media-entertainment'])
    ->prefix('media-producer/dashboard')->name('media_producer.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'producer'])->name('index');
});

// Media Advertiser
Route::middleware(['auth', 'ivara_role:media_advertiser', 'category_access:media-entertainment'])
    ->prefix('media-advertiser/dashboard')->name('media_advertiser.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'advertiser'])->name('index');
});

// Media Distributor
Route::middleware(['auth', 'ivara_role:media_distributor', 'category_access:media-entertainment'])
    ->prefix('media-distributor/dashboard')->name('media_distributor.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'distributor'])->name('index');
});

// Media Admin (Specific Role, distinct from Generic Admin)
Route::middleware(['auth', 'ivara_role:media_admin', 'category_access:media-entertainment'])
    ->prefix('media-admin/dashboard')->name('media_admin.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'admin'])->name('index');
});
