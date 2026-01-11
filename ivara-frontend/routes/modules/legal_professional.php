<?php

use Illuminate\Support\Facades\Route;
use App\Modules\LegalProfessional\LegalDashboardController;

/*
|--------------------------------------------------------------------------
| Legal & Professional Services Routes
|--------------------------------------------------------------------------
*/

// --- Management (Shared - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:admin', 'category_access:legal-professional'])
    ->prefix('admin/legal-professional')->name('admin.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:manager', 'category_access:legal-professional'])
    ->prefix('manager/legal-professional')->name('manager.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'ivara_role:supervisor', 'category_access:legal-professional'])
    ->prefix('supervisor/legal-professional')->name('supervisor.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'index'])->name('index');
});


// Legal Client
Route::middleware(['auth', 'ivara_role:legal_client', 'category_access:legal-professional'])
    ->prefix('legal-client/dashboard')->name('legal_client.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'client'])->name('index');
});

// Legal Professional (e.g. Individual Lawyer)
Route::middleware(['auth', 'ivara_role:legal_pro', 'category_access:legal-professional'])
    ->prefix('legal-pro/dashboard')->name('legal_pro.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'legalPro'])->name('index');
});

// Professional Consultant
Route::middleware(['auth', 'ivara_role:professional_consultant', 'category_access:legal-professional'])
    ->prefix('consultant/dashboard')->name('professional_consultant.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'consultant'])->name('index');
});

// Legal Firm
Route::middleware(['auth', 'ivara_role:legal_firm', 'category_access:legal-professional'])
    ->prefix('legal-firm/dashboard')->name('legal_firm.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'legalFirm'])->name('index');
});

// Legal Regulator
Route::middleware(['auth', 'ivara_role:legal_regulator', 'category_access:legal-professional'])
    ->prefix('regulator/dashboard')->name('legal_regulator.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'regulator'])->name('index');
});

// Legal Admin (Specific Role)
Route::middleware(['auth', 'ivara_role:legal_admin', 'category_access:legal-professional'])
    ->prefix('legal-admin/dashboard')->name('legal_admin.legal-professional.')->group(function () {
    Route::get('/', [LegalDashboardController::class, 'admin'])->name('index');
});
