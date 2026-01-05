<?php

use Illuminate\Support\Facades\Route;
use App\Modules\CreativeLifestyle\CreativeLifestyleController;
use App\Modules\CreativeLifestyle\Controllers\ServiceController;
use App\Modules\CreativeLifestyle\Controllers\BookingController;
use App\Modules\CreativeLifestyle\Controllers\ProviderController;
use App\Modules\CreativeLifestyle\Controllers\ProductController;
use App\Modules\CreativeLifestyle\Controllers\ClientController;
use App\Modules\CreativeLifestyle\Controllers\ReportController;
use App\Modules\CreativeLifestyle\Controllers\PaymentController;
use App\Modules\CreativeLifestyle\Controllers\ReviewController;
use App\Modules\CreativeLifestyle\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Creative & Lifestyle Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'ivara_role:admin,manager,supervisor', 'category_access:creative-lifestyle'])->prefix('admin/creative-lifestyle')->name('admin.creative-lifestyle.')->group(function () {
    // Dashboard
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');

    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // Providers
    Route::get('/providers', [ProviderController::class, 'index'])->name('providers');
    Route::get('/providers/create', [ProviderController::class, 'create'])->name('providers.create');
    Route::post('/providers', [ProviderController::class, 'store'])->name('providers.store');
    Route::get('/providers/{id}/edit', [ProviderController::class, 'edit'])->name('providers.edit');
    Route::put('/providers/{id}', [ProviderController::class, 'update'])->name('providers.update');
    Route::delete('/providers/{id}', [ProviderController::class, 'destroy'])->name('providers.destroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{id}/edit', [ReportController::class, 'edit'])->name('reports.edit');
    Route::put('/reports/{id}', [ReportController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');

    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    // Reviews
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::get('/settings/{id}/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/{id}', [SettingController::class, 'update'])->name('settings.update');
    Route::delete('/settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy');
});

// Wellness Professional Dashboards
Route::middleware(['auth'])->group(function () {
    Route::get('/gym_trainer', [App\Modules\CreativeLifestyle\WellnessController::class, 'gym'])->middleware('ivara_role:gym_trainer')->name('gym_trainer.index');
    Route::get('/yoga_trainer', [App\Modules\CreativeLifestyle\WellnessController::class, 'yoga'])->middleware('ivara_role:yoga_trainer')->name('yoga_trainer.index');
    Route::get('/multi_sports_academics', [App\Modules\CreativeLifestyle\WellnessController::class, 'sports'])->middleware('ivara_role:multi_sports_academics')->name('multi_sports_academics.index');
    Route::get('/fitness_coach', [App\Modules\CreativeLifestyle\WellnessController::class, 'fitness'])->middleware('ivara_role:fitness_coach')->name('fitness_coach.index');
    Route::get('/aerobics_instructor', [App\Modules\CreativeLifestyle\WellnessController::class, 'aerobics'])->middleware('ivara_role:aerobics_instructor')->name('aerobics_instructor.index');
    Route::get('/martial_arts_trainer', [App\Modules\CreativeLifestyle\WellnessController::class, 'martialArts'])->middleware('ivara_role:martial_arts_trainer')->name('martial_arts_trainer.index');
    Route::get('/pilates_instructor', [App\Modules\CreativeLifestyle\WellnessController::class, 'pilates'])->middleware('ivara_role:pilates_instructor')->name('pilates_instructor.index');
});

// Manager Routes
Route::middleware(['auth', 'ivara_role:manager,admin', 'category_access:creative-lifestyle'])->prefix('manager/creative-lifestyle')->name('manager.creative-lifestyle.')->group(function () {
    Route::get('/', function() {
        return view('admin.categories.creative-lifestyle.index'); // Reuse admin view or specific manager view
    })->name('index');
});

// Supervisor Routes
Route::middleware(['auth', 'ivara_role:supervisor,admin', 'category_access:creative-lifestyle'])->prefix('supervisor/creative-lifestyle')->name('supervisor.creative-lifestyle.')->group(function () {
    Route::get('/', function() {
        return view('admin.categories.creative-lifestyle.index'); // Reuse admin view or specific supervisor view
    })->name('index');
});

// ==========================================
// Creative Roles
// ==========================================

// Influencer
Route::middleware(['auth', 'ivara_role:influencer', 'category_access:creative-lifestyle'])
    ->prefix('influencer/dashboard')->name('influencer.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

// Musician
Route::middleware(['auth', 'ivara_role:musician', 'category_access:creative-lifestyle'])
    ->prefix('musician/dashboard')->name('musician.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

// Photographer
Route::middleware(['auth', 'ivara_role:photographer', 'category_access:creative-lifestyle'])
    ->prefix('photographer/dashboard')->name('photographer.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

// Artist
Route::middleware(['auth', 'ivara_role:artist', 'category_access:creative-lifestyle'])
    ->prefix('artist/dashboard')->name('artist.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

// ==========================================
// Wellness Providers
// ==========================================

Route::middleware(['auth', 'ivara_role:massage_therapist', 'category_access:creative-lifestyle'])
    ->prefix('massage-therapist/dashboard')->name('massage_therapist.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:spa_specialist', 'category_access:creative-lifestyle'])
    ->prefix('spa-specialist/dashboard')->name('spa_specialist.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:fitness_trainer', 'category_access:creative-lifestyle'])
    ->prefix('fitness-trainer/dashboard')->name('fitness_trainer.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:yoga_instructor', 'category_access:creative-lifestyle'])
    ->prefix('yoga-instructor/dashboard')->name('yoga_instructor.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:wellness_coach', 'category_access:creative-lifestyle'])
    ->prefix('wellness-coach/dashboard')->name('wellness_coach.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:life_coach', 'category_access:creative-lifestyle'])
    ->prefix('life-coach/dashboard')->name('life_coach.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:nutritionist', 'category_access:creative-lifestyle'])
    ->prefix('nutritionist/dashboard')->name('nutritionist.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:therapist', 'category_access:creative-lifestyle'])
    ->prefix('therapist/dashboard')->name('therapist.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

// ==========================================
// Business Roles
// ==========================================

Route::middleware(['auth', 'ivara_role:studio_owner', 'category_access:creative-lifestyle'])
    ->prefix('studio-owner/dashboard')->name('studio_owner.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:brand_agency', 'category_access:creative-lifestyle'])
    ->prefix('brand-agency/dashboard')->name('brand_agency.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:event_organizer', 'category_access:creative-lifestyle'])
    ->prefix('event-organizer/dashboard')->name('event_organizer.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:talent_manager', 'category_access:creative-lifestyle'])
    ->prefix('talent-manager/dashboard')->name('talent_manager.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

// ==========================================
// Special Roles
// ==========================================

Route::middleware(['auth', 'ivara_role:mediator', 'category_access:creative-lifestyle'])
    ->prefix('mediator/dashboard')->name('mediator.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:moderator', 'category_access:creative-lifestyle'])
    ->prefix('moderator/dashboard')->name('moderator.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

// ==========================================
// Client
// ==========================================

 Route::middleware(['auth', 'ivara_role:client', 'category_access:creative-lifestyle'])
    ->prefix('client/clw-dashboard')->name('client.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

// Fashion Designer Routes
Route::middleware(['auth', 'ivara_role:fashion_designer', 'category_access:creative-lifestyle'])->prefix('designer/creative-lifestyle')->name('designer.creative-lifestyle.')->group(function () {
    Route::get('/', [CreativeLifestyleController::class, 'index'])->name('index');
});

