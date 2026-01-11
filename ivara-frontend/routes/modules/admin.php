<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Core\Admin\AdminController;
use App\Modules\Core\Admin\SettingsController;
use App\Modules\Core\Admin\PermissionController;
use App\Modules\Core\Admin\FeedbackController;
use App\Modules\Core\Admin\ReportController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('index');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Placeholder routes for new admin sidebar items
    // Dashboard
    Route::get('/dashboard/overview', fn() => 'Dashboard Overview')->name('dashboard.overview');
    Route::get('/dashboard/live-map', fn() => 'Live Map')->name('dashboard.live_map');
    Route::get('/dashboard/system-alerts', fn() => 'System Alerts')->name('dashboard.system_alerts');

    // Devices & Security
    Route::get('/devices/register', fn() => 'Register Device')->name('devices.register');
    Route::get('/devices/all', fn() => 'All Registered Devices')->name('devices.all');
    Route::get('/devices/ownership-history', fn() => 'Device Ownership History')->name('devices.ownership_history');
    Route::get('/devices/stolen', fn() => 'Stolen Devices')->name('devices.stolen');
    Route::get('/devices/recovered', fn() => 'Recovered Devices')->name('devices.recovered');
    Route::get('/devices/tracking', fn() => 'Device Tracking')->name('devices.tracking');
    Route::get('/devices/blocked', fn() => 'Blocked Devices')->name('devices.blocked');
    Route::get('/devices/qr-verify', fn() => 'QR Verification')->name('devices.qr_verify');

    // Repairs Management
    Route::get('/repairs/all', fn() => 'All Repairs')->name('repairs.all');
    Route::get('/repairs/requests', fn() => 'Repair Requests')->name('repairs.requests');
    Route::get('/repairs/assign-technicians', fn() => 'Assign Technicians')->name('repairs.assign_technicians');
    Route::get('/repairs/progress', fn() => 'Repair Progress')->name('repairs.progress');
    Route::get('/repairs/completed', fn() => 'Completed Repairs')->name('repairs.completed');
    Route::get('/repairs/history', fn() => 'Repair History')->name('repairs.history');
    Route::get('/repairs/warranty', fn() => 'Warranty Records')->name('repairs.warranty');

    // Products & Spare Parts
    Route::get('/products/imported', fn() => 'Imported Products')->name('products.imported');
    Route::get('/spare-parts/inventory', fn() => 'Spare Parts Inventory')->name('spare_parts.inventory');
    Route::get('/stock/levels', fn() => 'Stock Levels')->name('stock.levels');
    Route::get('/products/pricing', fn() => 'Product Pricing')->name('products.pricing');
    Route::get('/suppliers/imports', fn() => 'Suppliers & Imports')->name('suppliers.imports');
    Route::get('/products/damaged', fn() => 'Damaged Items')->name('products.damaged');

    // Marketplace
    Route::get('/marketplace/products', fn() => 'Marketplace Products')->name('marketplace.products');
    Route::get('/marketplace/services', fn() => 'Marketplace Services')->name('marketplace.services');
    Route::get('/marketplace/orders', fn() => 'Marketplace Orders')->name('marketplace.orders');
    Route::get('/marketplace/returns', fn() => 'Marketplace Returns')->name('marketplace.returns');
    Route::get('/marketplace/featured', fn() => 'Featured Listings')->name('marketplace.featured');

    // Branches & Operations
    Route::get('/branches', fn() => 'Branches')->name('branches.index');
    Route::get('/branches/performance', fn() => 'Branch Performance')->name('branches.performance');
    Route::get('/branches/inventory', fn() => 'Branch Inventory')->name('branches.inventory');
    Route::get('/branches/service-zones', fn() => 'Service Zones')->name('branches.service_zones');

    // Staff & Users
    Route::get('/staff/admins', fn() => 'Admins')->name('staff.admins');
    Route::get('/staff/managers', fn() => 'Managers')->name('staff.managers');
    Route::get('/staff/supervisors', fn() => 'Supervisors')->name('staff.supervisors');
    Route::get('/staff/technicians', fn() => 'Technicians')->name('staff.technicians');
    Route::get('/staff/mechanics', fn() => 'Mechanics')->name('staff.mechanics');
    Route::get('/staff/electricians', fn() => 'Electricians')->name('staff.electricians');
    Route::get('/staff/craftspersons', fn() => 'Craftspersons')->name('staff.craftspersons');
    Route::get('/staff/tailors', fn() => 'Tailors')->name('staff.tailors');
    Route::get('/staff/builders', fn() => 'Builders')->name('staff.builders');
    Route::get('/staff/business-accounts', fn() => 'Business Accounts')->name('staff.business_accounts');
    Route::get('/staff/clients', fn() => 'Clients')->name('staff.clients');

    // Subscriptions & Revenue
    Route::get('/subscriptions/business', fn() => 'Business Subscriptions')->name('subscriptions.business');
    Route::get('/subscriptions/plans', fn() => 'Subscription Plans')->name('subscriptions.plans');
    Route::get('/revenue/commissions', fn() => 'Commissions')->name('revenue.commissions');
    Route::get('/revenue/platform', fn() => 'Platform Revenue')->name('revenue.platform');
    Route::get('/revenue/payouts', fn() => 'Payouts')->name('revenue.payouts');

    // Reports & Analytics
    Route::get('/reports/sales', fn() => 'Sales Reports')->name('reports.sales');
    Route::get('/reports/repairs', fn() => 'Repair Reports')->name('reports.repairs');
    Route::get('/reports/devices', fn() => 'Device Reports')->name('reports.devices');
    Route::get('/reports/theft', fn() => 'Theft Reports')->name('reports.theft');
    Route::get('/reports/technician-performance', fn() => 'Technician Performance')->name('reports.technician_performance');
    Route::get('/reports/branch', fn() => 'Branch Reports')->name('reports.branch');
    Route::get('/reports/financial', fn() => 'Financial Reports')->name('reports.financial');

    // Invoices & Payments
    Route::get('/invoices/sales', fn() => 'Sales Invoices')->name('invoices.sales');
    Route::get('/invoices/repairs', fn() => 'Repair Invoices')->name('invoices.repairs');
    Route::get('/payments', fn() => 'Payments')->name('payments');
    Route::get('/refunds', fn() => 'Refunds')->name('refunds');

    // Notifications & Logs
    Route::get('/notifications/system', fn() => 'System Notifications')->name('notifications.system');
    Route::get('/logs/activity', fn() => 'Activity Logs')->name('logs.activity');
    Route::get('/logs/audit', fn() => 'Audit Logs')->name('logs.audit');

    // Additional Technical & Repair Admin Routes
    Route::get('/profile', fn() => 'Business Profile')->name('profile');
    Route::get('/suppliers', fn() => 'Suppliers')->name('suppliers.index');
    Route::get('/sales/products', fn() => 'Product Sales')->name('sales.products');
    Route::get('/sales/parts', fn() => 'Spare Parts Sales')->name('sales.parts');
    Route::get('/services', fn() => 'Services Registry')->name('services.index');
    Route::get('/finance/expenses', fn() => 'Expenses')->name('expenses.index');
    Route::get('/finance/income', fn() => 'Income')->name('income.index');
    Route::get('/courses', fn() => 'Courses & Training')->name('courses.index');
    Route::get('/subscriptions', fn() => 'Subscriptions & Licenses')->name('subscriptions.index');

    // Settings
    Route::get('/settings/category', fn() => 'Category Settings')->name('settings.category');
    Route::get('/settings/roles-permissions', fn() => 'Roles & Permissions')->name('settings.roles_permissions');
    Route::get('/settings/notification-rules', fn() => 'Notification Rules')->name('settings.notification_rules');
    Route::get('/settings/security', fn() => 'Security Settings')->name('settings.security');
    Route::get('/settings/api-integrations', fn() => 'API & Integrations')->name('settings.api_integrations');
    
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/roles-permissions', [PermissionController::class, 'index'])->name('roles_permissions');
    Route::post('/roles-permissions/assign', [PermissionController::class, 'assignRole'])->name('users.assign_role');
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    
// Route::get('/clients', [App\Modules\TechnicalRepair\ManagerClientsController::class, 'index'])->name('clients');
// Route::get('/devices', [App\Modules\TechnicalRepair\AdminDeviceController::class, 'index'])->name('devices.index');
    // Route::get('/meetings', [App\Modules\TechnicalRepair\MeetingController::class, 'index'])->name('meetings');
    // Route::get('/create-updates', [App\Modules\TechnicalRepair\UpdateController::class, 'create_updates'])->name('create_updates');
    // Route::get('/create-team', [App\Modules\TechnicalRepair\TeamController::class, 'adminIndex'])->name('create_team');
    // Route::get('/create-products', [App\Modules\TechnicalRepair\ProductController::class, 'create'])->name('create_products');
    // Route::get('/stock', [App\Modules\TechnicalRepair\StockController::class, 'displayStock'])->name('stock');
    // Route::get('/invoices-payments', [App\Modules\TechnicalRepair\InvoiceController::class, 'index'])->name('invoices_payments');
    // Route::get('/bookings', [App\Modules\TechnicalRepair\BookingController::class, 'adminBooking'])->name('bookings');
    // Route::get('/learning', [App\Modules\TechnicalRepair\LearningController::class, 'index'])->name('learning');
    // Route::get('/connections', [App\Modules\TechnicalRepair\ConnectionController::class, 'adminConnections'])->name('connections');
    // Route::get('/subscriptions', [App\Modules\TechnicalRepair\AdminSubscriptionController::class, 'index'])->name('subscriptions');
    // Route::get('/tracking', [App\Modules\TechnicalRepair\DeviceTrackingsController::class, 'indexPage'])->name('tracking');
        // Other admin specific routes can follow here
});
