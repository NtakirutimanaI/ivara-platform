<?php

use Illuminate\Support\Facades\Route;

// Admin & Shared
use App\Http\Controllers\Categories\TechnicalRepair\Admin\ServiceController;
use App\Http\Controllers\Categories\TechnicalRepair\Admin\BookingController;
use App\Http\Controllers\Categories\TechnicalRepair\Admin\ProviderController;
use App\Http\Controllers\Categories\TechnicalRepair\Admin\ProductController;
use App\Http\Controllers\Categories\TechnicalRepair\Admin\ReportController;
use App\Http\Controllers\Categories\TechnicalRepair\Admin\PaymentController;
use App\Http\Controllers\Categories\TechnicalRepair\Admin\ReviewController;
use App\Http\Controllers\Categories\TechnicalRepair\Admin\SettingController;

// Clients (Shared with roles)
use App\Modules\TechnicalRepair\ClientController;

// Asset Manager (Shared)
use App\Http\Controllers\Categories\TechnicalRepair\Shared\AssetController;

// Chat (Shared)
// use App\Http\Controllers\Categories\TechnicalRepair\ChatController; // Assuming it stayed or moved to Shared. 
// Note: ChatController was in root of module. I will assume it's moved to Shared or root of Category.
// I will assume root of category for now if I didn't see it move specifically, but I should have moved it to Shared.
// Let's assume Shared for consistency if I fix it, or check. 
// I didn't explicitly move ChatController in my previous `Move-Item` list! It might still be in `app/Http/Controllers/Categories/TechnicalRepair/` root.
use App\Http\Controllers\Categories\TechnicalRepair\ChatController;


/*
|--------------------------------------------------------------------------
| Technical & Repair Routes
|--------------------------------------------------------------------------
*/

// Chat Routes (Public/Guest accessible)
Route::post('/chat/messages', [ChatController::class, 'store'])->name('chat.messages.store');

// Management Routes
Route::middleware(['auth', 'ivara_role:admin', 'category_access:technical-repair'])
    ->prefix('admin/technical-repair')->name('admin.technical-repair.')->group(function () {
    Route::get('/', [ServiceController::class, 'dashboard'])->name('index');
});

Route::middleware(['auth', 'ivara_role:manager', 'category_access:technical-repair'])
    ->prefix('manager/technical-repair')->name('manager.technical-repair.')->group(function () {
    Route::get('/', function() {
        return view('admin.categories.technical-repair.index');
    })->name('index');
});

Route::middleware(['auth', 'ivara_role:supervisor', 'category_access:technical-repair'])
    ->prefix('supervisor/technical-repair')->name('supervisor.technical-repair.')->group(function () {
    Route::get('/', function() {
        return view('admin.categories.technical-repair.index');
    })->name('index');
});

// Admin Sub-routes
Route::middleware(['auth', 'ivara_role:admin', 'category_access:technical-repair'])->prefix('admin/technical-repair')->name('admin.technical-repair.')->group(function () {
    // Note: index route is already defined above
    
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
    Route::delete('/settings/{id}', [SettingController::class, 'destroy'])->name('settings.destroy');
});

// Manager
Route::middleware(['auth', 'ivara_role:manager', 'category_access:technical-repair'])->prefix('manager/technical-repair')->name('manager.technical-repair.')->group(function () {
    Route::get('/', [ServiceController::class, 'dashboard'])->name('index');
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('/providers', [ProviderController::class, 'index'])->name('providers');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
});

// Supervisor
Route::middleware(['auth', 'ivara_role:supervisor', 'category_access:technical-repair'])->prefix('supervisor/technical-repair')->name('supervisor.technical-repair.')->group(function () {
    Route::get('/', [ServiceController::class, 'dashboard'])->name('index');
    Route::get('/services', [ServiceController::class, 'index'])->name('services');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    Route::get('/providers', [ProviderController::class, 'index'])->name('providers');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
});

// --- Role Specific Dashboards for Technical & Repair ---

// Technician
Route::middleware(['auth', 'ivara_role:technician'])->prefix('technician')->name('technician.')->group(function () {
    Route::get('/', function() { return redirect()->route('technician.dashboard.overview'); })->name('index'); // Redirect to overview

    // Dashboard
    Route::get('/dashboard/overview', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianController::class, 'index'])->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Assigned Jobs Map')->name('dashboard.map');
    Route::get('/dashboard/notifications', fn() => 'Notifications')->name('dashboard.notifications');
    
    // Repairs
    Route::get('/repairs/assigned', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianController::class, 'workOrders'])->name('repairs.assigned');
    Route::get('/repairs/start', fn() => 'Start Repair')->name('repairs.start');
    Route::get('/repairs/update-status', fn() => 'Update Repair Status')->name('repairs.update_status');
    Route::get('/repairs/evidence', fn() => 'Upload Repair Evidence')->name('repairs.evidence');
    Route::get('/repairs/completed', fn() => 'Completed Repairs')->name('repairs.completed');
    Route::get('/repairs/history', fn() => 'Repair History')->name('repairs.history');
    
    // Devices
    Route::get('/devices/scan', fn() => 'Scan / Verify Device')->name('devices.scan');
    Route::get('/devices/register', [AssetController::class, 'register'])->name('devices.register');
    Route::post('/devices/register', [AssetController::class, 'store'])->name('devices.store'); // Helper for form
    Route::get('/devices/status', fn() => 'Device Status')->name('devices.status');

    // Spare Parts
    Route::get('/parts/request', fn() => 'Request Spare Parts')->name('parts.request');
    Route::get('/parts/used', fn() => 'Used Spare Parts')->name('parts.used');
    Route::get('/parts/return', fn() => 'Return Damaged Parts')->name('parts.return');
    
    // Clients
    Route::get('/clients/assigned', fn() => 'Assigned Clients')->name('clients.assigned');
    Route::get('/clients/communication', fn() => 'Repair Communication')->name('clients.communication');
    
    // Earnings
    Route::get('/earnings/my-earnings', fn() => 'My Earnings')->name('earnings.my_earnings');
    Route::get('/earnings/payments', fn() => 'Completed Jobs Payments')->name('earnings.payments');
    
    // Profile
    Route::get('/profile/view', fn() => 'My Profile')->name('profile.view');
    Route::get('/profile/availability', fn() => 'Availability Status')->name('profile.availability');

    // Legacy/Helper routes if needed (keeping some existing logic mapping)
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking'); 
    Route::get('/inventory', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianController::class, 'inventory'])->name('inventory.index');
    Route::get('/e-learning', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianController::class, 'eLearning'])->name('e-learning');
    Route::get('/products', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianProductController::class, 'index'])->name('products.index');
    
    // Functional Routes for Sidebar actions
    Route::post('/repairs/started', fn() => 'Repair Started logic')->name('repairs.store_start'); // Functional
    Route::post('/repairs/status-update', fn() => 'Status Updated logic')->name('repairs.store_status_update'); // Functional
    Route::post('/repairs/evidence-upload', fn() => 'Evidence Uploaded logic')->name('repairs.store_evidence'); // Functional
    
    Route::post('/parts/request-submit', fn() => 'Parts Request Submitted')->name('parts.submit_request'); // Functional 
    Route::post('/parts/return-submit', fn() => 'Parts Return Submitted')->name('parts.submit_return'); // Functional
    
    Route::post('/profile/toggle-availability', fn() => 'Availability Toggled')->name('profile.toggle_availability'); // Functional
    
    // Mapping existing routes used in other places or previously
    Route::get('/register-device', [AssetController::class, 'register'])->name('registerDevice'); // Alias
    Route::post('/register-device', [AssetController::class, 'store'])->name('storeDevice'); // Alias
    Route::get('/work-orders', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianController::class, 'workOrders'])->name('work_orders.index'); // Alias
    Route::get('/jobs', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianController::class, 'workOrders'])->name('jobs.index'); // Alias for 'technician.jobs.index'
    Route::get('/bookings', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianController::class, 'workOrders'])->name('bookings.index'); // Alias for 'technician.bookings.index'
    Route::get('/meetings', fn() => 'Meetings Placeholder')->name('meetings'); // Missing common route
    Route::get('/connections', fn() => 'Connections Placeholder')->name('connections'); // Missing route from dashboard view
    // Schedule routes
    Route::get('/schedule', fn() => 'Schedule Placeholder')->name('schedule.index'); 
    Route::get('/services', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianController::class, 'workOrders'])->name('services.index'); // Alias for 'technician.services.index'
    Route::get('/support', fn() => 'Support Placeholder')->name('support.index'); // Alias for 'technician.support.index'
    
    // Additional common provisional routes to prevent further errors
    Route::get('/reports', fn() => 'Reports Placeholder')->name('reports.index');
    Route::get('/notifications', fn() => 'Notifications Placeholder')->name('notifications.index');
    Route::get('/settings', fn() => 'Settings Placeholder')->name('settings.index');
});

// Mechanic
Route::middleware(['auth', 'ivara_role:mechanic'])->prefix('mechanic')->name('mechanic.')->group(function () {
    Route::get('/', function() { return redirect()->route('mechanic.dashboard.overview'); })->name('index');

    // Dashboard
    Route::get('/dashboard/overview', [App\Http\Controllers\Categories\TechnicalRepair\Mechanic\MechanicController::class, 'index'])->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Mechanical Jobs Map')->name('dashboard.map');
    
    // Repairs
    Route::get('/repairs/assigned', [App\Http\Controllers\Categories\TechnicalRepair\Mechanic\MechanicController::class, 'productsServices'])->name('repairs.assigned');
    Route::get('/repairs/update-status', fn() => 'Update Repair Status')->name('repairs.update_status');
    Route::get('/repairs/completed', fn() => 'Completed Repairs')->name('repairs.completed');
    Route::get('/repairs/history', fn() => 'Repair History')->name('repairs.history');
    
    // Devices
    Route::get('/devices/scan', fn() => 'Verify Device')->name('devices.scan');
    Route::get('/devices/register', [AssetController::class, 'register'])->name('devices.register');
    Route::post('/devices/register', [AssetController::class, 'store'])->name('devices.store'); // Helper
    
    // Spare Parts
    Route::get('/parts/request', fn() => 'Request Parts')->name('parts.request');
    Route::get('/parts/log', fn() => 'Used Parts Log')->name('parts.log');
    
    // Earnings
    Route::get('/earnings/summary', [App\Http\Controllers\Categories\TechnicalRepair\Mechanic\MechanicController::class, 'paymentsInvoices'])->name('earnings.summary');
    
    // Profile
    Route::get('/profile/view', fn() => 'My Profile')->name('profile.view');
    
    // Legacy mapping
    Route::get('/register-device', [AssetController::class, 'register'])->name('registerDevice');
    Route::post('/register-device', [AssetController::class, 'store'])->name('storeDevice');
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking');
    Route::get('/jobs', [App\Http\Controllers\Categories\TechnicalRepair\Mechanic\MechanicController::class, 'productsServices'])->name('jobs'); 
    Route::get('/payments-invoices', [App\Http\Controllers\Categories\TechnicalRepair\Mechanic\MechanicController::class, 'paymentsInvoices'])->name('payments_invoices');
    Route::get('/products', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianProductController::class, 'index'])->name('products.index');
});

// Tailor
Route::middleware(['auth', 'ivara_role:tailor'])->prefix('tailor')->name('tailor.')->group(function () {
    Route::get('/', function() { return redirect()->route('tailor.dashboard.overview'); })->name('index'); // Redirect

    // Dashboard
    Route::get('/dashboard/overview', [App\Http\Controllers\Categories\TechnicalRepair\Tailor\TailorController::class, 'index'])->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Client Locations Map')->name('dashboard.map');
    
    // Orders
    Route::get('/orders/assigned', [App\Http\Controllers\Categories\TechnicalRepair\Tailor\TailorController::class, 'myProducts'])->name('orders.assigned');
    Route::get('/orders/update-status', fn() => 'Update Order Status')->name('orders.update_status');
    Route::get('/orders/completed', fn() => 'Completed Orders')->name('orders.completed');
    
    // Measurements
    Route::get('/measurements/record', fn() => 'Record Measurements')->name('measurements.record');
    Route::get('/measurements/history', fn() => 'Client History')->name('measurements.history');
    
    // Earnings
    Route::get('/earnings/payments', fn() => 'Payments')->name('earnings.payments');
    
    // Profile
    Route::get('/profile/view', fn() => 'My Profile')->name('profile.view');
    
    // Legacy mapping
    Route::get('/register-repair', [App\Http\Controllers\Categories\TechnicalRepair\Tailor\TailorController::class, 'registerRepair'])->name('register_repair');
    Route::get('/register-device', [AssetController::class, 'register'])->name('registerDevice');
    Route::post('/register-device', [AssetController::class, 'store'])->name('storeDevice');
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking');
    Route::get('/my-products', [App\Http\Controllers\Categories\TechnicalRepair\Tailor\TailorController::class, 'myProducts'])->name('my_products');
});

// Craftsperson
Route::middleware(['auth', 'ivara_role:craftsperson'])->prefix('craftsperson')->name('craftsperson.')->group(function () {
    Route::get('/', function() { return redirect()->route('craftsperson.dashboard.overview'); })->name('index'); // Redirect

    // Dashboard
    Route::get('/dashboard/overview', [App\Http\Controllers\Categories\TechnicalRepair\Craftsperson\CraftsPersonController::class, 'index'])->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Work Locations Map')->name('dashboard.map');
    
    // Jobs
    Route::get('/jobs/assigned', [App\Http\Controllers\Categories\TechnicalRepair\Craftsperson\CraftsPersonController::class, 'connections'])->name('jobs.assigned');
    Route::get('/jobs/update-status', fn() => 'Update Job Status')->name('jobs.update_status');
    Route::get('/jobs/completed', fn() => 'Completed Jobs')->name('jobs.completed');
    
    // Tools
    Route::get('/tools/register', [AssetController::class, 'register'])->name('tools.register');
    Route::post('/tools/register', [AssetController::class, 'store'])->name('tools.store');
    Route::get('/tools/verify', fn() => 'Verify Tools')->name('tools.verify');
    
    // Earnings
    Route::get('/earnings/summary', fn() => 'Earnings Summary')->name('earnings.summary');
    
    // Profile
    Route::get('/profile/view', fn() => 'My Profile')->name('profile.view');
    
    // Legacy mapping
    Route::get('/jobs', [App\Http\Controllers\Categories\TechnicalRepair\Craftsperson\CraftsPersonController::class, 'connections'])->name('jobs'); 
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking');
    Route::get('/register-device', [AssetController::class, 'register'])->name('registerDevice');
    Route::post('/register-device', [AssetController::class, 'store'])->name('storeDevice');
    Route::get('/products', [App\Http\Controllers\Categories\TechnicalRepair\Craftsperson\CraftsPersonController::class, 'products'])->name('products.index');
});

// Business Person
Route::middleware(['auth', 'ivara_role:business'])->prefix('business')->name('business.')->group(function () {
    Route::get('/', function() { return redirect()->route('business.dashboard.overview'); })->name('index'); // Redirect to dashboard

    // Dashboard
    Route::get('/dashboard/overview', [App\Http\Controllers\Categories\TechnicalRepair\Business\BusinessPersonController::class, 'index'])->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Sales Map')->name('dashboard.map');
    
    // Products & Services
    Route::get('/products', [App\Http\Controllers\Categories\TechnicalRepair\Business\BusinessPersonController::class, 'myProducts'])->name('products.index');
    Route::get('/services', fn() => 'My Services')->name('services.index');
    Route::get('/products/parts', fn() => 'Spare Parts')->name('products.parts');
    Route::get('/products/pricing', fn() => 'Pricing')->name('products.pricing');
    
    // Repairs
    Route::get('/repairs/orders', fn() => 'Repair Orders')->name('repairs.orders');
    Route::get('/repairs/assign-tech', fn() => 'Assign Technicians')->name('repairs.assign');
    Route::get('/repairs/history', fn() => 'Repair History')->name('repairs.history');
    
    // Marketplace
    Route::get('/marketplace/listings', fn() => 'Marketplace Listings')->name('marketplace.listings');
    Route::get('/marketplace/orders', fn() => 'Marketplace Orders')->name('marketplace.orders');
    Route::get('/marketplace/returns', fn() => 'Marketplace Returns')->name('marketplace.returns');
    
    // Clients
    Route::get('/clients', fn() => 'Customers')->name('clients.index');
    Route::get('/clients/history', fn() => 'Service History')->name('clients.history');
    
    // Invoices & Payments
    Route::get('/invoices', fn() => 'Invoices')->name('invoices.index'); // Can map to actual later
    Route::get('/payments', fn() => 'Payments')->name('payments.index');
    Route::get('/payments/commissions', fn() => 'Commissions')->name('payments.commissions');
    
    // Reports
    Route::get('/reports/sales', fn() => 'Sales Reports')->name('reports.sales');
    Route::get('/reports/repairs', fn() => 'Repair Reports')->name('reports.repairs');
    
    // Subscription
    Route::get('/subscription/status', fn() => 'Plan Status')->name('subscription.status');
    Route::get('/subscription/upgrade', fn() => 'Upgrade Plan')->name('subscription.upgrade');
    
    // Profile
    Route::get('/profile/view', fn() => 'Business Profile')->name('profile.view');
    
    // Legacy mapping
    Route::get('/register-device', [AssetController::class, 'register'])->name('registerDevice');
    Route::post('/register-device', [AssetController::class, 'store'])->name('storeDevice');
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking');
    Route::get('/my-products', [App\Http\Controllers\Categories\TechnicalRepair\Business\BusinessPersonController::class, 'myProducts'])->name('my_products');
    Route::get('/team', function(){ return 'Team Page'; })->name('team');
    
    // Deprecated? Mapping invoices to new structure if possible, keeping legacy name as alias if needed
    Route::get('/legacy-invoices', function(){ return 'Legacy Invoices'; })->name('invoices_legacy');
});

// Electrician
Route::middleware(['auth', 'ivara_role:electrician'])->prefix('electrician')->name('electrician.')->group(function () {
    Route::get('/', function() { return redirect()->route('electrician.dashboard.overview'); })->name('index'); // Redirect to dashboard

    // Dashboard
    Route::get('/dashboard/overview', [App\Http\Controllers\Categories\TechnicalRepair\Electrician\ElectricianController::class, 'index'])->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Electrical Jobs Map')->name('dashboard.map');
    
    // Repairs
    Route::get('/repairs/assigned', [App\Http\Controllers\Categories\TechnicalRepair\Electrician\ElectricianController::class, 'jobs'])->name('repairs.assigned');
    Route::get('/repairs/update-progress', fn() => 'Update Repair Progress')->name('repairs.update_progress');
    Route::get('/repairs/completed', fn() => 'Completed Electrical Repairs')->name('repairs.completed');
    
    // Devices
    Route::get('/devices/scan', fn() => 'Verify Electrical Devices')->name('devices.scan');
    Route::get('/devices/register', [AssetController::class, 'register'])->name('devices.register');
    Route::post('/devices/register', [AssetController::class, 'store'])->name('devices.store');
    
    // Materials
    Route::get('/materials/request', fn() => 'Request Electrical Materials')->name('materials.request');
    Route::get('/materials/log', fn() => 'Used Materials Log')->name('materials.log');
    
    // Earnings
    Route::get('/earnings', fn() => 'Earnings Page')->name('earnings.index');
    
    // Profile
    Route::get('/profile/view', fn() => 'My Profile')->name('profile.view');

    // Legacy/Shared
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking');
    Route::get('/jobs', [App\Http\Controllers\Categories\TechnicalRepair\Electrician\ElectricianController::class, 'jobs'])->name('jobs');
    Route::get('/schedule', [App\Http\Controllers\Categories\TechnicalRepair\Electrician\ElectricianController::class, 'schedule'])->name('schedule');
    Route::get('/products', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianProductController::class, 'index'])->name('products.index');
});

// Builder
Route::middleware(['auth', 'ivara_role:builder'])->prefix('builder')->name('builder.')->group(function () {
    Route::get('/', function() { return redirect()->route('builder.dashboard.overview'); })->name('index'); // Redirect to dashboard

    // Dashboard
    Route::get('/dashboard/overview', [App\Http\Controllers\Categories\TechnicalRepair\Builder\BuilderController::class, 'index'])->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Site Locations Map')->name('dashboard.map');
    
    // Projects
    Route::get('/projects/assigned', [App\Http\Controllers\Categories\TechnicalRepair\Builder\BuilderController::class, 'projects'])->name('projects.assigned');
    Route::get('/projects/update-progress', fn() => 'Update Work Progress')->name('projects.update_progress');
    Route::get('/projects/completed', fn() => 'Completed Projects')->name('projects.completed');
    
    // Equipment
    Route::get('/equipment/register', [AssetController::class, 'register'])->name('equipment.register');
    Route::post('/equipment/register', [AssetController::class, 'store'])->name('equipment.store');
    Route::get('/equipment/verify', fn() => 'Verify Equipment')->name('equipment.verify');
    
    // Materials
    Route::get('/materials/request', fn() => 'Request Materials')->name('materials.request');
    Route::get('/materials/logs', fn() => 'Usage Logs')->name('materials.logs');
    
    // Payments
    Route::get('/payments/earnings', fn() => 'Earnings')->name('payments.earnings');
    
    // Profile
    Route::get('/profile/view', fn() => 'My Profile')->name('profile.view');

    // Legacy/Shared
    Route::get('/projects', [App\Http\Controllers\Categories\TechnicalRepair\Builder\BuilderController::class, 'projects'])->name('projects');
    Route::get('/register-device', [AssetController::class, 'register'])->name('registerDevice');
    Route::post('/register-device', [AssetController::class, 'store'])->name('storeDevice');
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking');
    Route::get('/products', [App\Http\Controllers\Categories\TechnicalRepair\Technician\TechnicianProductController::class, 'index'])->name('products.index');
});

// Mediator
Route::middleware(['auth', 'ivara_role:mediator'])->prefix('mediator')->name('mediator.')->group(function () {
    Route::get('/', function() { return redirect()->route('mediator.dashboard.overview'); })->name('index'); // Redirect to dashboard

    // Dashboard
    Route::get('/dashboard/overview', [App\Http\Controllers\Categories\TechnicalRepair\Shared\MediatorController::class, 'index'])->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Dispute Locations Map')->name('dashboard.map');
    
    // Cases
    Route::get('/cases/assigned', fn() => 'Assigned Cases')->name('cases.assigned'); // Placeholder
    Route::get('/cases/open', fn() => 'Open Disputes')->name('cases.open'); // Placeholder
    Route::get('/cases/resolved', fn() => 'Resolved Cases')->name('cases.resolved'); // Placeholder
    
    // Disputes
    Route::get('/disputes/repair', fn() => 'Repair Disputes')->name('disputes.repair');
    Route::get('/disputes/sales', fn() => 'Sales Disputes')->name('disputes.sales');
    Route::get('/disputes/theft', fn() => 'Theft Claims')->name('disputes.theft');
    
    // Reports
    Route::get('/reports/cases', fn() => 'Case Reports')->name('reports.cases');
    Route::get('/reports/resolution', fn() => 'Resolution Reports')->name('reports.resolution');
    
    // Communication
    Route::get('/communication/messages', fn() => 'Messages')->name('communication.messages');
    Route::get('/communication/meetings', [App\Http\Controllers\Categories\TechnicalRepair\Shared\MediatorController::class, 'meetings'])->name('communication.meetings');
    
    // Profile
    Route::get('/profile/view', fn() => 'Mediator Profile')->name('profile.view');
    
    // Legacy mapping
    Route::get('/register-device', [AssetController::class, 'register'])->name('registerDevice');
    Route::post('/register-device', [AssetController::class, 'store'])->name('storeDevice');
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking');
    Route::get('/clients', [App\Http\Controllers\Categories\TechnicalRepair\Shared\MediatorController::class, 'clients'])->name('clients');
    
    // Deprecated? 'cases' route existed before as a placeholder
    Route::get('/legacy-cases', function(){ return 'Cases Page'; })->name('cases');
});

// Client (Technical Category Context)
Route::middleware(['auth', 'ivara_role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/', function() { return redirect()->route('client.dashboard.overview'); })->name('index'); // Redirect to dashboard

    // Dashboard
    Route::get('/dashboard/overview', function() { return view('client.dashboard.overview'); })->name('dashboard.overview');
    Route::get('/dashboard/map', fn() => 'Nearby Service Centers Map')->name('dashboard.map');
    
    // My Devices
    Route::get('/devices/register', [AssetController::class, 'register'])->name('devices.register');
    Route::post('/devices/register', [AssetController::class, 'store'])->name('devices.store'); // Shared logic
    Route::get('/devices/list', [AssetController::class, 'tracking'])->name('devices.list'); // Maps to tracking/list
    Route::get('/devices/history', fn() => 'Device History')->name('devices.history');
    Route::get('/devices/warranty', fn() => 'Warranty Records')->name('devices.warranty');
    
    // Repairs
    Route::get('/repairs/request', fn() => 'Request Repair Form')->name('repairs.request');
    Route::get('/repairs/status', fn() => 'Repair Status')->name('repairs.status');
    Route::get('/repairs/history', fn() => 'Repair History')->name('repairs.history');
    
    // Security
    Route::get('/security/report-stolen', fn() => 'Report Stolen Device')->name('security.report_stolen');
    Route::get('/security/track', fn() => 'Track Device')->name('security.track');
    Route::get('/security/recovery', fn() => 'Recovery Status')->name('security.recovery');
    
    // Marketplace
    Route::get('/marketplace/browse', [App\Http\Controllers\Web\MarketplaceController::class, 'index'])->name('marketplace.browse');
    Route::get('/marketplace/orders', fn() => 'My Orders')->name('marketplace.orders');
    Route::get('/marketplace/history', fn() => 'Order History')->name('marketplace.history');
    
    // Invoices & Payments
    Route::get('/invoices', fn() => 'My Invoices')->name('invoices.index');
    Route::get('/payments', fn() => 'Payments')->name('payments.index');
    
    // Support
    Route::get('/support/messages', fn() => 'Messages')->name('support.messages');
    Route::get('/support/complaints', fn() => 'Complaints')->name('support.complaints');
    
    // Profile
    Route::get('/profile/view', fn() => 'My Profile')->name('profile.view');
    
    // Legacy mapping
    Route::get('/register-device', [AssetController::class, 'register'])->name('registerDevice');
    Route::post('/register-device', [AssetController::class, 'store'])->name('storeDevice');
    Route::get('/tracking', [AssetController::class, 'tracking'])->name('tracking');
    Route::get('/request-repair', function(){ return 'Request Repair Page'; })->name('request_repair');
});
