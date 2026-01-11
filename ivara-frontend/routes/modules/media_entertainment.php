<?php

use Illuminate\Support\Facades\Route;
use App\Modules\MediaEntertainment\MediaDashboardController;

/*
|--------------------------------------------------------------------------
| Media & Entertainment Routes
|--------------------------------------------------------------------------
*/

// --- Management (Shared - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:admin', 'category_access:media-entertainment'])
    ->prefix('admin/media-entertainment')->name('admin.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:manager', 'category_access:media-entertainment'])
    ->prefix('manager/media-entertainment')->name('manager.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:supervisor', 'category_access:media-entertainment'])
    ->prefix('supervisor/media-entertainment')->name('supervisor.media-entertainment.')->group(function () {
    Route::get('/', [MediaDashboardController::class, 'index'])->name('index');
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
