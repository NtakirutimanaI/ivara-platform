<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TransportTravel\TransportTravelController;
use App\Modules\TransportTravel\Controllers\ServiceController;
use App\Modules\TransportTravel\Controllers\BookingController;
use App\Modules\TransportTravel\Controllers\ProviderController;
use App\Modules\TransportTravel\Controllers\VehicleController;
use App\Modules\TransportTravel\Controllers\ClientController;
use App\Modules\TransportTravel\Controllers\ReportController;
use App\Modules\TransportTravel\Controllers\PaymentController;
use App\Modules\TransportTravel\Controllers\ReviewController;
use App\Modules\TransportTravel\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Transport & Travel Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'ivara_role:admin,manager,supervisor', 'category_access:transport-travel'])->prefix('admin/transport-travel')->name('admin.transport-travel.')->group(function () {
    // Dashboard
    Route::get('/', [TransportTravelController::class, 'index'])->name('index');

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

    // Vehicles (Products equivalent for Transport)
    Route::get('/products', [VehicleController::class, 'index'])->name('products');
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    // Note: Destroy route might conflict with existing 'admin.clients' so using ID prefix
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

// Manager Routes
Route::middleware(['auth', 'ivara_role:manager,admin', 'category_access:transport-travel'])->prefix('manager/transport-travel')->name('manager.transport-travel.')->group(function () {
    Route::get('/', function() {
        return view('categories.transport-travel-hospitality.manager.index');
    })->name('index');
});

// Supervisor Routes
Route::middleware(['auth', 'ivara_role:supervisor,admin', 'category_access:transport-travel'])->prefix('supervisor/transport-travel')->name('supervisor.transport-travel.')->group(function () {
    Route::get('/', function() {
        return view('categories.transport-travel-hospitality.supervisor.index');
    })->name('index');
});

// --- Role Specific Dashboards for Transport & Travel ---

// Taxi Driver (Transport Services)
Route::middleware(['auth', 'ivara_role:taxi_driver', 'category_access:transport-travel'])
    ->prefix('taxi-driver/dashboard')->name('taxi_driver.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.transport-services.taxi-driver.index';
    
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/bookings', function() use ($view) { return view($view); })->name('bookings');
    Route::get('/vehicle', function() use ($view) { return view($view); })->name('vehicle');
    Route::get('/earnings', function() use ($view) { return view($view); })->name('earnings');
    Route::get('/notifications', function() use ($view) { return view($view); })->name('notifications');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Moto Driver
Route::middleware(['auth', 'ivara_role:moto_driver', 'category_access:transport-travel'])
    ->prefix('moto-driver/dashboard')->name('moto_driver.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.transport-services.moto-driver.index';
    
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/trips', function() use ($view) { return view($view); })->name('trips');
    Route::get('/vehicle', function() use ($view) { return view($view); })->name('vehicle');
    Route::get('/earnings', function() use ($view) { return view($view); })->name('earnings');
    Route::get('/notifications', function() use ($view) { return view($view); })->name('notifications');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Bus Driver
Route::middleware(['auth', 'ivara_role:bus_driver', 'category_access:transport-travel'])
    ->prefix('bus-driver/dashboard')->name('bus_driver.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.transport-services.bus-driver.index';
    
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/schedule', function() use ($view) { return view($view); })->name('schedule');
    Route::get('/tickets', function() use ($view) { return view($view); })->name('tickets');
    Route::get('/vehicle', function() use ($view) { return view($view); })->name('vehicle');
    Route::get('/earnings', function() use ($view) { return view($view); })->name('earnings');
    Route::get('/notifications', function() use ($view) { return view($view); })->name('notifications');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Truck Driver
Route::middleware(['auth', 'ivara_role:truck_driver', 'category_access:transport-travel'])
    ->prefix('truck-driver/dashboard')->name('truck_driver.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.transport-services.truck-driver.index';
    
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/shipments', function() use ($view) { return view($view); })->name('shipments');
    Route::get('/logs', function() use ($view) { return view($view); })->name('logs');
    Route::get('/vehicle', function() use ($view) { return view($view); })->name('vehicle');
    Route::get('/earnings', function() use ($view) { return view($view); })->name('earnings');
    Route::get('/notifications', function() use ($view) { return view($view); })->name('notifications');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Tour Driver
Route::middleware(['auth', 'ivara_role:tour_driver', 'category_access:transport-travel'])
    ->prefix('tour-driver/dashboard')->name('tour_driver.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.transport-services.tour-driver.index';
    
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/bookings', function() use ($view) { return view($view); })->name('bookings');
    Route::get('/destinations', function() use ($view) { return view($view); })->name('destinations');
    Route::get('/earnings', function() use ($view) { return view($view); })->name('earnings');
    Route::get('/notifications', function() use ($view) { return view($view); })->name('notifications');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Delivery Driver
Route::middleware(['auth', 'ivara_role:delivery_driver', 'category_access:transport-travel'])
    ->prefix('delivery-driver/dashboard')->name('delivery_driver.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.transport-services.delivery-driver.index';
    
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/orders', function() use ($view) { return view($view); })->name('orders');
    Route::get('/map', function() use ($view) { return view($view); })->name('map');
    Route::get('/earnings', function() use ($view) { return view($view); })->name('earnings');
    Route::get('/notifications', function() use ($view) { return view($view); })->name('notifications');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Ambulance Driver
Route::middleware(['auth', 'ivara_role:ambulance_driver', 'category_access:transport-travel'])
    ->prefix('ambulance/dashboard')->name('ambulance_driver.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.special-transport.ambulance-driver.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/dispatches', function() use ($view) { return view($view); })->name('dispatches');
    Route::get('/patients', function() use ($view) { return view($view); })->name('patients');
    Route::get('/equipment', function() use ($view) { return view($view); })->name('equipment');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Special Needs Transport
Route::middleware(['auth', 'ivara_role:special_needs_transport', 'category_access:transport-travel'])
    ->prefix('special-needs/dashboard')->name('special_needs_transport.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.special-transport.special-needs-transport.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/schedules', function() use ($view) { return view($view); })->name('schedules');
    Route::get('/accessibility-logs', function() use ($view) { return view($view); })->name('logs');
    Route::get('/vehicle', function() use ($view) { return view($view); })->name('vehicle');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// VIP Driver
Route::middleware(['auth', 'ivara_role:vip_executive_driver', 'category_access:transport-travel'])
    ->prefix('vip-driver/dashboard')->name('vip_executive_driver.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.service-provider.special-transport.vip-executive-driver.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/reservations', function() use ($view) { return view($view); })->name('reservations');
    Route::get('/client-preferences', function() use ($view) { return view($view); })->name('clients');
    Route::get('/vehicle-amenities', function() use ($view) { return view($view); })->name('vehicle');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Vehicle Servicing
Route::middleware(['auth', 'ivara_role:vehicle_servicing', 'category_access:transport-travel'])
    ->prefix('vehicle-servicing/dashboard')->name('vehicle_servicing.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.support-provider.vehicle-servicing-inspection.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/jobs', function() use ($view) { return view($view); })->name('jobs');
    Route::get('/inspections', function() use ($view) { return view($view); })->name('inspections');
    Route::get('/inventory', function() use ($view) { return view($view); })->name('inventory');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Customer Care
Route::middleware(['auth', 'ivara_role:customer_care', 'category_access:transport-travel'])
    ->prefix('customer-care/dashboard')->name('customer_care.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.support-provider.customer-care-travel-assistance.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/tickets', function() use ($view) { return view($view); })->name('tickets');
    Route::get('/live-chat', function() use ($view) { return view($view); })->name('chat');
    Route::get('/feedback', function() use ($view) { return view($view); })->name('feedback');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Roadside Assistance
Route::middleware(['auth', 'ivara_role:roadside_assistance', 'category_access:transport-travel'])
    ->prefix('roadside-assistance/dashboard')->name('roadside_assistance.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.support-provider.roadside-assistance-breakdown.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/SOS-calls', function() use ($view) { return view($view); })->name('sos');
    Route::get('/dispatches', function() use ($view) { return view($view); })->name('dispatches');
    Route::get('/tow-truck', function() use ($view) { return view($view); })->name('vehicle');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Safety Compliance
Route::middleware(['auth', 'ivara_role:safety_compliance', 'category_access:transport-travel'])
    ->prefix('safety-compliance/dashboard')->name('safety_compliance.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.support-provider.safety-compliance.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/audits', function() use ($view) { return view($view); })->name('audits');
    Route::get('/incident-reports', function() use ($view) { return view($view); })->name('incidents');
    Route::get('/training', function() use ($view) { return view($view); })->name('training');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Business Person
Route::middleware(['auth', 'ivara_role:businessperson', 'category_access:transport-travel'])
    ->prefix('business/dashboard')->name('businessperson.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.businessperson.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/fleet', function() use ($view) { return view($view); })->name('fleet');
    Route::get('/financials', function() use ($view) { return view($view); })->name('financials');
    Route::get('/employees', function() use ($view) { return view($view); })->name('employees');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Mediator
Route::middleware(['auth', 'ivara_role:mediator', 'category_access:transport-travel'])
    ->prefix('mediator/dashboard')->name('mediator.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.mediator.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/cases', function() use ($view) { return view($view); })->name('cases');
    Route::get('/disputes', function() use ($view) { return view($view); })->name('disputes');
    Route::get('/calendar', function() use ($view) { return view($view); })->name('calendar');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Moderator
Route::middleware(['auth', 'ivara_role:moderator', 'category_access:transport-travel'])
    ->prefix('moderator/dashboard')->name('moderator.transport-travel.')->group(function () {
    $view = 'categories.transport-travel-hospitality.moderator.index';
    Route::get('/', function() use ($view) { return view($view); })->name('index');
    Route::get('/content-review', function() use ($view) { return view($view); })->name('review');
    Route::get('/user-flags', function() use ($view) { return view($view); })->name('flags');
    Route::get('/reports', function() use ($view) { return view($view); })->name('reports');
    Route::get('/profile', function() use ($view) { return view($view); })->name('profile');
});

// Client
Route::middleware(['auth', 'ivara_role:client', 'category_access:transport-travel'])
    ->prefix('client/tth-dashboard')->name('client.transport-travel.')->group(function () {
    Route::get('/', function() {
        return view('categories.transport-travel-hospitality.client.index');
    })->name('index');
});

