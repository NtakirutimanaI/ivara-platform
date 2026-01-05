<?php

use Illuminate\Support\Facades\Route;
use App\Modules\FoodFashion\FoodFashionController;
use App\Modules\FoodFashion\Controllers\ServiceController;
use App\Modules\FoodFashion\Controllers\BookingController;
use App\Modules\FoodFashion\Controllers\ProviderController;
use App\Modules\FoodFashion\Controllers\ProductController;
use App\Modules\FoodFashion\Controllers\ClientController;
use App\Modules\FoodFashion\Controllers\ReportController;
use App\Modules\FoodFashion\Controllers\PaymentController;
use App\Modules\FoodFashion\Controllers\ReviewController;
use App\Modules\FoodFashion\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Food & Fashion Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'ivara_role:admin,manager,supervisor', 'category_access:food-fashion'])->prefix('admin/food-fashion')->name('admin.food-fashion.')->group(function () {
    // Dashboard
    Route::get('/', [FoodFashionController::class, 'index'])->name('index');

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

// Role-Specific Dashboards
Route::middleware(['auth'])->group(function () {
    Route::get('/food-customer', [App\Modules\FoodFashion\FoodFashionDashboardController::class, 'customer'])->middleware('ivara_role:food_customer')->name('food_customer.index');
    Route::get('/food-vendor', [App\Modules\FoodFashion\FoodFashionDashboardController::class, 'vendor'])->middleware('ivara_role:food_vendor')->name('food_vendor.index');
    Route::get('/event-organizer', [App\Modules\FoodFashion\FoodFashionDashboardController::class, 'organizer'])->middleware('ivara_role:event_organizer')->name('event_organizer.index');
    Route::get('/fashion-vendor', [App\Modules\FoodFashion\FoodFashionDashboardController::class, 'fashion'])->middleware('ivara_role:fashion_vendor')->name('fashion_vendor.index');
    Route::get('/food-delivery', [App\Modules\FoodFashion\FoodFashionDashboardController::class, 'delivery'])->middleware('ivara_role:food_delivery')->name('food_delivery.index');
    Route::get('/food-admin', [App\Modules\FoodFashion\FoodFashionDashboardController::class, 'admin'])->middleware('ivara_role:food_admin')->name('food_admin.index');
});

