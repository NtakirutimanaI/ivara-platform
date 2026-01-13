<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;

Route::middleware(['auth', 'admin'])->prefix('super_admin')->name('super_admin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('index');
    Route::get('/credentials', [SuperAdminController::class, 'credentials'])->name('credentials');
    Route::get('/users', [SuperAdminController::class, 'users'])->name('users.index');
    Route::get('/users/{id}', [SuperAdminController::class, 'showUser'])->name('users.show')->where('id', '[0-9]+');
    Route::put('/users/{id}', [SuperAdminController::class, 'updateGeneralUser'])->name('users.update')->where('id', '[0-9]+');
    Route::delete('/users/{id}', [SuperAdminController::class, 'deleteGeneralUser'])->name('users.delete')->where('id', '[0-9]+');
    Route::post('/users/{id}/ban', [SuperAdminController::class, 'banUser'])->name('users.ban')->where('id', '[0-9]+');

    // Sidebar Pages
    Route::get('/marketplace', [SuperAdminController::class, 'marketplace'])->name('marketplace.index');
    Route::post('/marketplace/product/{id}', [SuperAdminController::class, 'productAction'])->name('marketplace.product.action');
    Route::get('/businesses', [SuperAdminController::class, 'businesses'])->name('businesses.index');

    // Subscriptions
    Route::prefix('subscriptions')->name('subscriptions.')->group(function() {
        Route::get('/plans', [SuperAdminController::class, 'subPlans'])->name('plans');
        Route::get('/active', [SuperAdminController::class, 'subActive'])->name('active');
        Route::post('/active', [SuperAdminController::class, 'storeSub'])->name('active.store');
        Route::put('/active/{id}', [SuperAdminController::class, 'updateSub'])->name('active.update');
        Route::patch('/active/{id}/status', [SuperAdminController::class, 'updateSubStatus'])->name('active.status');
        Route::delete('/active/{id}', [SuperAdminController::class, 'deleteSub'])->name('active.delete');
        Route::get('/payments', [SuperAdminController::class, 'subPayments'])->name('payments');
        Route::get('/payments/export', [SuperAdminController::class, 'exportPayments'])->name('payments.export');
        Route::patch('/payments/{id}/status', [SuperAdminController::class, 'updatePayStatus'])->name('payments.status');
        Route::delete('/payments/{id}', [SuperAdminController::class, 'deletePay'])->name('payments.delete');
    });

    Route::get('/licenses', [SuperAdminController::class, 'licenses'])->name('licenses.index');
    Route::put('/licenses/{id}', [SuperAdminController::class, 'updateLicense'])->name('licenses.update');
    Route::delete('/licenses/{id}', [SuperAdminController::class, 'deleteLicense'])->name('licenses.delete');
    
    // Roles Management
    Route::get('/roles', [SuperAdminController::class, 'roles'])->name('roles.index');
    Route::post('/roles', [SuperAdminController::class, 'storeRole'])->name('roles.store');
    Route::put('/roles/{slug}', [SuperAdminController::class, 'updateRole'])->name('roles.update');
    Route::delete('/roles/{slug}', [SuperAdminController::class, 'deleteRole'])->name('roles.delete');
    Route::post('/roles/{slug}/permissions', [SuperAdminController::class, 'syncPermissions'])->name('roles.permissions');

    Route::get('/services', [SuperAdminController::class, 'services'])->name('services.index');
    Route::post('/services', [SuperAdminController::class, 'storeService'])->name('services.store');
    Route::put('/services/{id}', [SuperAdminController::class, 'updateServiceAction'])->name('services.update');
    Route::delete('/services/{id}', [SuperAdminController::class, 'deleteServiceAction'])->name('services.delete');
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
    // --- Team Management ---

    // Admins
    Route::get('/admins', [SuperAdminController::class, 'indexAdmins'])->name('admins.index');
    Route::post('/admins', [SuperAdminController::class, 'storeAdmin'])->name('admins.store');
    Route::get('/admins/create', function() { return redirect()->route('super_admin.admins.index'); });
    Route::post('/admins/{id}/message', [SuperAdminController::class, 'messageAdmin'])->name('admins.message')->where('id', '[0-9]+');
    Route::post('/admins/{id}/suspend', [SuperAdminController::class, 'suspendAdmin'])->name('admins.suspend')->where('id', '[0-9]+');
    Route::get('/admins/{id}/edit', [SuperAdminController::class, 'editAdmin'])->name('admins.edit')->where('id', '[0-9]+');
    Route::put('/admins/{id}', [SuperAdminController::class, 'updateAdmin'])->name('admins.update')->where('id', '[0-9]+');
    Route::get('/admins/{id}', [SuperAdminController::class, 'showAdmin'])->name('admins.show')->where('id', '[0-9]+');

    // Managers
    Route::get('/managers', [SuperAdminController::class, 'indexManagers'])->name('managers.index');
    Route::post('/managers', [SuperAdminController::class, 'storeManager'])->name('managers.store');
    Route::get('/managers/{id}/edit', [SuperAdminController::class, 'editManager'])->name('managers.edit')->where('id', '[0-9]+');
    // Reusing Admin update/show logic or creating new ones. For simplicity, we might reuse or create specific ones. 
    // Let's create specific to be clean.
    Route::put('/managers/{id}', [SuperAdminController::class, 'updateManager'])->name('managers.update')->where('id', '[0-9]+');
    Route::get('/managers/{id}', [SuperAdminController::class, 'showManager'])->name('managers.show')->where('id', '[0-9]+');

    // Supervisors
    Route::get('/supervisors', [SuperAdminController::class, 'indexSupervisors'])->name('supervisors.index');
    Route::post('/supervisors', [SuperAdminController::class, 'storeSupervisor'])->name('supervisors.store');
    Route::get('/supervisors/{id}/edit', [SuperAdminController::class, 'editSupervisor'])->name('supervisors.edit')->where('id', '[0-9]+');
    Route::put('/supervisors/{id}', [SuperAdminController::class, 'updateSupervisor'])->name('supervisors.update')->where('id', '[0-9]+');
    Route::get('/supervisors/{id}', [SuperAdminController::class, 'showSupervisor'])->name('supervisors.show')->where('id', '[0-9]+');

    // Performance Matrix
    Route::prefix('performance')->group(function () {
        Route::get('/', [SuperAdminController::class, 'performanceMatrix'])->name('performance.index');
        Route::post('/review/store', [SuperAdminController::class, 'storeReview'])->name('performance.review.store');
    });
    // Mapping old assign route to new performance route for safe keeping if needed, else just remove
    Route::get('/admins/assign', function() { return redirect()->route('super_admin.performance.index'); })->name('admins.assign');

    // Category Management
    Route::get('/categories/create', [SuperAdminController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories/create', [SuperAdminController::class, 'storeCategory']); // Fallback for stale forms
    Route::post('/categories', [SuperAdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{slug}/dashboard', [SuperAdminController::class, 'showCategory'])->name('categories.show');
    Route::get('/categories/{slug}/edit', [SuperAdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('/categories/{slug}', [SuperAdminController::class, 'updateCategory'])->name('categories.update');
    Route::get('/categories/manage', [SuperAdminController::class, 'manageCategories'])->name('categories.manage');
    Route::get('/categories', [SuperAdminController::class, 'categories'])->name('categories.index');

    // Analytics
    Route::get('/analytics', [SuperAdminController::class, 'analytics'])->name('analytics.index');

    // Billing
    Route::get('/billing/rules', [SuperAdminController::class, 'billingRules'])->name('billing.rules');
    Route::post('/billing/rules/commission', [SuperAdminController::class, 'updateCommissionRates'])->name('billing.rules.commission');
    Route::post('/billing/rules/tax', [SuperAdminController::class, 'updateTaxPolicies'])->name('billing.rules.tax');

    // Marketplace
    Route::get('/marketplace', [SuperAdminController::class, 'marketplace'])->name('marketplace.index');
    Route::post('/marketplace/product/{id}', [SuperAdminController::class, 'productAction'])->name('marketplace.product.action');
    Route::post('/marketplace/seller/upgrade', [SuperAdminController::class, 'upgradeSeller'])->name('marketplace.seller.upgrade');
    Route::post('/marketplace/settlement/generate', [SuperAdminController::class, 'generateSettlementReport'])->name('marketplace.settlement.generate');
    Route::post('/marketplace/mediator/audit', [SuperAdminController::class, 'auditMediator'])->name('marketplace.mediator.audit');

    // Settings
    Route::get('/settings', [SuperAdminController::class, 'settings'])->name('settings.index');
});
