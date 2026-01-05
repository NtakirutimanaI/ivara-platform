<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TechnicalRepair\SupervisorController;

/*
|--------------------------------------------------------------------------
| Supervisor Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:supervisor'])->prefix('supervisor')->name('supervisor.')->group(function () {
    // Dashboard
    Route::get('/', [SupervisorController::class, 'task_oversight'])->name('index');
    Route::get('/dashboard', [SupervisorController::class, 'task_oversight'])->name('dashboard');
    Route::get('/task-oversight', [SupervisorController::class, 'task_oversight'])->name('task_oversight');
    
    // Tasks
    // Tasks Index
    Route::get('/tasks', [SupervisorController::class, 'tasks'])->name('tasks');

    
    // Devices
    Route::post('/devices', [SupervisorController::class, 'storeDevice'])->name('devices.store');
    Route::put('/devices/{id}', [SupervisorController::class, 'updateDevice'])->name('devices.update');
    Route::delete('/devices/{id}', [SupervisorController::class, 'destroyDevice'])->name('devices.destroy');
    
    // Repairs
    Route::post('/repairs', [SupervisorController::class, 'storeRepair'])->name('repairs.store');
    Route::put('/repairs/{id}', [SupervisorController::class, 'updateRepair'])->name('repairs.update');
    Route::delete('/repairs/{id}', [SupervisorController::class, 'destroyRepair'])->name('repairs.destroy');
    
    // Transactions
    Route::get('/transactions', [SupervisorController::class, 'supervisorTransactions'])->name('transactions');
    
    // Bookings
    Route::get('/bookings', [SupervisorController::class, 'supervisorBookings'])->name('bookings');
    Route::get('/view-bookings', [SupervisorController::class, 'viewBookings'])->name('view_bookings');
    Route::post('/bookings/{id}/assign-technician', [SupervisorController::class, 'assignTechnician'])->name('bookings.assign_technician');
    Route::post('/bookings/{booking}/send-notification', [SupervisorController::class, 'sendNotification'])->name('bookings.send_notification');
    Route::delete('/bookings/{booking}', [SupervisorController::class, 'deleteBooking'])->name('bookings.destroy');
    Route::put('/bookings/{booking}/status', [SupervisorController::class, 'updateStatus'])->name('bookings.update_status');
    Route::put('/bookings/{booking}/update-status', [SupervisorController::class, 'updateBookingStatus'])->name('bookings.update_booking_status');
    
    // Reports
    Route::get('/reports', [SupervisorController::class, 'reports'])->name('reports');
    Route::get('/bookings/export/pdf', [SupervisorController::class, 'exportPdf'])->name('bookings.export_pdf');
    Route::get('/bookings/export/excel', [SupervisorController::class, 'exportExcel'])->name('bookings.export_excel');

    // Others
    Route::get('/clients', [SupervisorController::class, 'clients'])->name('clients');
    Route::get('/meetings', [SupervisorController::class, 'meetings'])->name('meetings');
    Route::get('/stock', [SupervisorController::class, 'stock'])->name('stock');
    // Placeholder routes for new sidebar items
    Route::get('/dashboard/overview', fn() => 'Dashboard Overview')->name('dashboard.overview');
    Route::get('/dashboard/branch-map', fn() => 'Branch Map')->name('dashboard.branch_map');
    Route::get('/dashboard/live-status', fn() => 'Live Repair Status')->name('dashboard.live_status');
    Route::get('/devices/register', fn() => 'Register Device')->name('devices.register');
    Route::get('/devices/verify', fn() => 'Verify Device')->name('devices.verify');
    Route::get('/devices/status', fn() => 'Device Status')->name('devices.status');
    Route::get('/repairs/assigned', fn() => 'Assigned Repairs')->name('repairs.assigned');
    Route::get('/repairs/monitor', fn() => 'Monitor Repair Progress')->name('repairs.monitor');
    Route::get('/repairs/approve', fn() => 'Approve Completed Repairs')->name('repairs.approve');
    Route::get('/repairs/issues', fn() => 'Repair Issues')->name('repairs.issues');
    Route::get('/spare-parts/availability', fn() => 'Spare Parts Availability')->name('spare_parts.availability');
    Route::get('/spare-parts/issue', fn() => 'Issue Spare Parts')->name('spare_parts.issue');
    Route::get('/spare-parts/damaged', fn() => 'Damaged Parts')->name('spare_parts.damaged');
    Route::get('/staff/technicians', fn() => 'Technicians')->name('staff.technicians');
    Route::get('/staff/mechanics', fn() => 'Mechanics')->name('staff.mechanics');
    Route::get('/staff/electricians', fn() => 'Electricians')->name('staff.electricians');
    Route::get('/staff/craftspersons', fn() => 'Craftspersons')->name('staff.craftspersons');
    Route::get('/staff/tailors', fn() => 'Tailors')->name('staff.tailors');
    Route::get('/staff/builders', fn() => 'Builders')->name('staff.builders');
    Route::get('/staff/task-assignments', fn() => 'Task Assignments')->name('staff.task_assignments');
    Route::get('/clients/repair-requests', fn() => 'Client Repair Requests')->name('clients.repair_requests');
    Route::get('/clients/complaints', fn() => 'Client Complaints')->name('clients.complaints');
    Route::get('/reports/daily', fn() => 'Daily Repair Report')->name('reports.daily');
    Route::get('/reports/tech-activity', fn() => 'Technician Activity Report')->name('reports.tech_activity');
    Route::get('/reports/branch-summary', fn() => 'Branch Summary')->name('reports.branch_summary');
    Route::get('/notifications/alerts', fn() => 'Alerts')->name('notifications.alerts');
    Route::get('/notifications/messages', fn() => 'Messages')->name('notifications.messages');
    // Placeholder routes for new sidebar items
    Route::get('/dashboard/overview', fn() => 'Dashboard Overview')->name('dashboard.overview');
    Route::get('/dashboard/branch-map', fn() => 'Branch Map')->name('dashboard.branch_map');
    Route::get('/dashboard/live-status', fn() => 'Live Repair Status')->name('dashboard.live_status');
    Route::get('/devices/register', fn() => 'Register Device')->name('devices.register');
    Route::get('/devices/verify', fn() => 'Verify Device')->name('devices.verify');
    Route::get('/devices/status', fn() => 'Device Status')->name('devices.status');
    Route::get('/repairs/assigned', fn() => 'Assigned Repairs')->name('repairs.assigned');
    Route::get('/repairs/monitor', fn() => 'Monitor Repair Progress')->name('repairs.monitor');
    Route::get('/repairs/approve', fn() => 'Approve Completed Repairs')->name('repairs.approve');
    Route::get('/repairs/issues', fn() => 'Repair Issues')->name('repairs.issues');
    Route::get('/spare-parts/availability', fn() => 'Spare Parts Availability')->name('spare_parts.availability');
    Route::get('/spare-parts/issue', fn() => 'Issue Spare Parts')->name('spare_parts.issue');
    Route::get('/spare-parts/damaged', fn() => 'Damaged Parts')->name('spare_parts.damaged');
    Route::get('/staff/technicians', fn() => 'Technicians')->name('staff.technicians');
    Route::get('/staff/mechanics', fn() => 'Mechanics')->name('staff.mechanics');
    Route::get('/staff/electricians', fn() => 'Electricians')->name('staff.electricians');
    Route::get('/staff/craftspersons', fn() => 'Craftspersons')->name('staff.craftspersons');
    Route::get('/staff/tailors', fn() => 'Tailors')->name('staff.tailors');
    Route::get('/staff/builders', fn() => 'Builders')->name('staff.builders');
    Route::get('/staff/task-assignments', fn() => 'Task Assignments')->name('staff.task_assignments');
    Route::get('/clients/repair-requests', fn() => 'Client Repair Requests')->name('clients.repair_requests');
    Route::get('/clients/complaints', fn() => 'Client Complaints')->name('clients.complaints');
    Route::get('/reports/daily', fn() => 'Daily Repair Report')->name('reports.daily');
    Route::get('/reports/tech-activity', fn() => 'Technician Activity Report')->name('reports.tech_activity');
    Route::get('/reports/branch-summary', fn() => 'Branch Summary')->name('reports.branch_summary');
    Route::get('/notifications/alerts', fn() => 'Alerts')->name('notifications.alerts');
    Route::get('/notifications/messages', fn() => 'Messages')->name('notifications.messages');
});
