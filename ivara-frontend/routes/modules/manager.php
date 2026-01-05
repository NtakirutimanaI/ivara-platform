<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TechnicalRepair\ManagerController;
use App\Modules\TechnicalRepair\ManagerClientsController;

use App\Modules\TechnicalRepair\ManagerDeviceController;
use App\Modules\TechnicalRepair\ManagerCreateProductController;
use App\Modules\TechnicalRepair\ManagerBookingController;
use App\Modules\TechnicalRepair\ManagerBookingServiceController;

/*
|--------------------------------------------------------------------------
| Manager Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    // Dashboard
    Route::get('/', [ManagerController::class, 'index'])->name('index');
    Route::get('/dashboard', [ManagerController::class, 'index'])->name('dashboard');
    
    // Repairs
    Route::get('/register-repair', [ManagerController::class, 'registerRepair'])->name('register_repair');
    Route::get('/register-view-data', [ManagerController::class, 'registerViewData'])->name('register_view_data');
    Route::get('/repair-device', [ManagerController::class, 'repairDevice'])->name('repair_device');
    
    // Devices
    Route::get('/devices', [ManagerDeviceController::class, 'index'])->name('devices.index');
    Route::get('/device', [ManagerController::class, 'device'])->name('device');
    Route::get('/register-device', [ManagerController::class, 'registerDevice'])->name('register_device');
    
    // Technicians
    Route::get('/technicians', [ManagerController::class, 'technicians'])->name('technicians');
    
    // Clients
    Route::get('/clients', [ManagerClientsController::class, 'index'])->name('clients.index');
    Route::post('/clients/store', [ManagerController::class, 'store'])->name('clients.store');
    Route::put('/clients/{id}', [ManagerController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [ManagerController::class, 'destroy'])->name('clients.destroy');
    Route::post('/clients/{id}/change-status', [ManagerController::class, 'changeStatus'])->name('clients.changeStatus');
    Route::post('/clients/{id}/send-notification', [ManagerController::class, 'sendNotification'])->name('clients.sendNotification');
    Route::post('/clients/{id}/generate-invoice', [ManagerController::class, 'generateInvoice'])->name('clients.generateInvoice');
    
    // Bookings
    Route::get('/bookings', [ManagerBookingController::class, 'index'])->name('bookings.index');
    Route::resource('booking-services', ManagerBookingServiceController::class);
    
    // Reports
    Route::get('/reports', [ManagerController::class, 'reports'])->name('reports');
    Route::get('/reports/pdf', [ManagerController::class, 'downloadPdf'])->name('reports.pdf');
    Route::get('/reports/excel', [ManagerController::class, 'downloadExcel'])->name('reports.excel');
    Route::get('/report', [ManagerController::class, 'report'])->name('report');
    
    // Stock & Sales
    Route::get('/stock', [ManagerController::class, 'stock'])->name('stock');
    Route::get('/sales', [ManagerController::class, 'managerSales'])->name('sales');
    // Placeholder routes for new manager menu items
    Route::get('/dashboard/overview', fn() => 'Dashboard Overview')->name('dashboard.overview');
    Route::get('/dashboard/branch-map', fn() => 'Branch Map')->name('dashboard.branch_map');
    Route::get('/dashboard/todays-activities', fn() => "Today's Activities")->name('dashboard.todays_activities');
    // Devices
    Route::get('/devices/register', fn() => 'Register Device')->name('devices.register');
    Route::get('/devices/branch', fn() => 'Branch Devices')->name('devices.branch');
    Route::get('/devices/verify', fn() => 'Device Verification')->name('devices.verify');
    Route::get('/devices/stolen', fn() => 'Stolen Devices (View Only)')->name('devices.stolen');
    // Repairs
    Route::get('/repairs/requests', fn() => 'Repair Requests')->name('repairs.requests');
    Route::get('/repairs/assign-technicians', fn() => 'Assign Technicians')->name('repairs.assign_technicians');
    Route::get('/repairs/progress', fn() => 'Repair Progress')->name('repairs.progress');
    Route::get('/repairs/completed', fn() => 'Completed Repairs')->name('repairs.completed');
    Route::get('/repairs/warranty', fn() => 'Warranty Records')->name('repairs.warranty');
    // Products & Inventory
    Route::get('/products', fn() => 'Products')->name('products.index');
    Route::get('/spare-parts', fn() => 'Spare Parts')->name('spare_parts.index');
    Route::get('/stock/monitor', fn() => 'Stock Monitoring')->name('stock.monitor');
    Route::get('/stock/reorder', fn() => 'Reorder Requests')->name('stock.reorder');
    // Marketplace
    Route::get('/marketplace/products', fn() => 'Marketplace Products')->name('marketplace.products');
    Route::get('/marketplace/orders', fn() => 'Marketplace Orders')->name('marketplace.orders');
    Route::get('/marketplace/returns', fn() => 'Marketplace Returns')->name('marketplace.returns');
    // Branches
    Route::get('/branches/my', fn() => 'My Branches')->name('branches.my');
    Route::get('/branches/staff', fn() => 'Branch Staff')->name('branches.staff');
    Route::get('/branches/inventory', fn() => 'Branch Inventory')->name('branches.inventory');
    Route::get('/branches/performance', fn() => 'Branch Performance')->name('branches.performance');
    // Staff Management
    Route::get('/staff/technicians', fn() => 'Technicians')->name('staff.technicians');
    Route::get('/staff/mechanics', fn() => 'Mechanics')->name('staff.mechanics');
    Route::get('/staff/electricians', fn() => 'Electricians')->name('staff.electricians');
    Route::get('/staff/craftspersons', fn() => 'Craftspersons')->name('staff.craftspersons');
    Route::get('/staff/tailors', fn() => 'Tailors')->name('staff.tailors');
    Route::get('/staff/builders', fn() => 'Builders')->name('staff.builders');
    Route::get('/staff/attendance', fn() => 'Attendance')->name('staff.attendance');
    Route::get('/staff/performance', fn() => 'Performance')->name('staff.performance');
    // Reports
    Route::get('/reports/sales', fn() => 'Sales Reports')->name('reports.sales');
    Route::get('/reports/repairs', fn() => 'Repair Reports')->name('reports.repairs');
    Route::get('/reports/inventory', fn() => 'Inventory Reports')->name('reports.inventory');
    Route::get('/reports/branch', fn() => 'Branch Reports')->name('reports.branch');
    // Invoices & Payments
    Route::get('/invoices/generate', fn() => 'Generate Invoice')->name('invoices.generate');
    Route::get('/invoices/view', fn() => 'View Invoices')->name('invoices.view');
    Route::get('/payments', fn() => 'Payments')->name('payments');
    // Notifications
    Route::get('/notifications/alerts', fn() => 'Alerts')->name('notifications.alerts');
    Route::get('/notifications/messages', fn() => 'Messages')->name('notifications.messages');
    // Settings
    Route::get('/settings/branch', fn() => 'Branch Settings')->name('settings.branch');
    Route::get('/profile', fn() => 'Profile')->name('profile.show');
    
    // Products
    Route::get('/create-products', [ManagerCreateProductController::class, 'index'])->name('create_products.index');
    Route::get('/products', [ManagerController::class, 'createProducts'])->name('products.index');
    
    // Team & Updates
    Route::get('/create-team', [ManagerController::class, 'createTeam'])->name('create_team');
    Route::get('/create-updates', [ManagerController::class, 'createUpdates'])->name('create_updates');
    
    // Notifications & Communication
    Route::get('/notifications', [ManagerController::class, 'notifications'])->name('notifications');
    Route::get('/connections', [ManagerController::class, 'connections'])->name('connections');
    Route::get('/meetings', [ManagerController::class, 'meetings'])->name('meetings');
    
    // E-Learning
    Route::get('/e-learning', [ManagerController::class, 'eLearning'])->name('e-learning');
    
    // Feedback
    Route::get('/feedback', [ManagerController::class, 'feedback'])->name('feedback');
});
