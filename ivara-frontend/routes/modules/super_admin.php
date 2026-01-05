<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdminController;

Route::middleware(['auth', 'admin'])->prefix('super_admin')->name('super_admin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('index');
    Route::get('/credentials', [SuperAdminController::class, 'credentials'])->name('credentials');
    
    // Additional direct controls
});
