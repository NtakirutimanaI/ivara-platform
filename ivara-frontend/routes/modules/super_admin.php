<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;

Route::middleware(['auth', 'admin'])->prefix('super_admin')->name('super_admin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('index');
    Route::get('/credentials', [SuperAdminController::class, 'credentials'])->name('credentials');
    Route::get('/users', [SuperAdminController::class, 'users'])->name('users.index');

    // Sidebar Pages
    Route::get('/marketplace', [SuperAdminController::class, 'marketplace'])->name('marketplace.index');
    Route::get('/businesses', [SuperAdminController::class, 'businesses'])->name('businesses.index');

    // Subscriptions
    Route::prefix('subscriptions')->name('subscriptions.')->group(function() {
        Route::get('/plans', [SuperAdminController::class, 'subPlans'])->name('plans');
        Route::get('/active', [SuperAdminController::class, 'subActive'])->name('active');
        Route::get('/payments', [SuperAdminController::class, 'subPayments'])->name('payments');
    });

    Route::get('/licenses', [SuperAdminController::class, 'licenses'])->name('licenses.index');
    Route::get('/roles', [SuperAdminController::class, 'roles'])->name('roles.index');
    Route::get('/services', [SuperAdminController::class, 'services'])->name('services.index');
    Route::get('/courses', [SuperAdminController::class, 'courses'])->name('courses.index');
    Route::get('/payments', [SuperAdminController::class, 'payments'])->name('payments.index');
    Route::get('/invoices', [SuperAdminController::class, 'invoices'])->name('invoices.index');
    
    // Logs
    Route::prefix('logs')->name('logs.')->group(function() {
        Route::get('/audit', [SuperAdminController::class, 'auditLogs'])->name('audit');
    });

    Route::get('/reports', [SuperAdminController::class, 'analytics'])->name('reports.index');
    Route::get('/support', [SuperAdminController::class, 'support'])->name('support.index');
    
    // --- New Sidebar Routes ---
    // Admin Management
    Route::get('/admins', [SuperAdminController::class, 'indexAdmins'])->name('admins.index');
    Route::post('/admins', [SuperAdminController::class, 'storeAdmin'])->name('admins.store');
    Route::get('/admins/assign', [SuperAdminController::class, 'assignAdmins'])->name('admins.assign');
    
    // Admin Actions
    // Redirect legacy create route to index
    Route::get('/admins/create', function() {
        return redirect()->route('super_admin.admins.index');
    });

    // Admin Actions
    Route::post('/admins/{id}/message', [SuperAdminController::class, 'messageAdmin'])->name('admins.message')->where('id', '[0-9]+');
    Route::post('/admins/{id}/suspend', [SuperAdminController::class, 'suspendAdmin'])->name('admins.suspend')->where('id', '[0-9]+');
    Route::get('/admins/{id}/edit', [SuperAdminController::class, 'editAdmin'])->name('admins.edit')->where('id', '[0-9]+');
    Route::put('/admins/{id}', [SuperAdminController::class, 'updateAdmin'])->name('admins.update')->where('id', '[0-9]+');
    Route::get('/admins/{id}', [SuperAdminController::class, 'showAdmin'])->name('admins.show')->where('id', '[0-9]+');

    // Category Management
    Route::get('/categories/create', [SuperAdminController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories/create', [SuperAdminController::class, 'storeCategory']); // Fallback for stale forms
    Route::post('/categories', [SuperAdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{slug}/dashboard', [SuperAdminController::class, 'showCategory'])->name('categories.show');
    Route::get('/categories/{slug}/edit', [SuperAdminController::class, 'editCategory'])->name('categories.edit');
    Route::get('/categories/manage', [SuperAdminController::class, 'manageCategories'])->name('categories.manage');
    Route::get('/categories', [SuperAdminController::class, 'categories'])->name('categories.index');

    // Analytics
    Route::get('/analytics', [SuperAdminController::class, 'analytics'])->name('analytics.index');

    // Billing
    Route::get('/billing/rules', [SuperAdminController::class, 'billingRules'])->name('billing.rules');

    // Settings
    Route::get('/settings', [SuperAdminController::class, 'settings'])->name('settings.index');
});
