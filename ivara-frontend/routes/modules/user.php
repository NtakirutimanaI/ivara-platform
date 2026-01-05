<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Core\User\UserController;
use App\Modules\Core\User\ProfileController;
use App\Modules\Core\User\SwitchAccountController;
use App\Modules\Core\User\SelfRegisterController;
use App\Modules\Core\Auth\AccountSelectionController;

Route::middleware('auth')->group(function () {
    // Universal Dashboard - Redirects based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if (!$user) return redirect()->route('login');
        
        $role = strtolower($user->role);
        $activeCategory = session('user_category', $user->category ?? null);

        // 1. Handle Super Admin
        if (in_array($role, ['super_admin', 'super-admin'])) {
            return redirect()->route('super_admin.index');
        }

        // 2. Handle Admin/Manager/Supervisor Category Dashboards
        if (in_array($role, ['admin', 'manager', 'supervisor'])) {
            if ($activeCategory) {
                // Ensure we use hyphens for the route names as defined in modules
                $routeSlug = str_replace('_', '-', $activeCategory);
                return redirect()->route("admin.{$routeSlug}.index");
            }
            return redirect()->route('auth.select-category');
        }

        // 3. Handle specific professional roles (mapped in sidebar)
        $roleRoutes = [
            'technician' => 'technician.index',
            'mechanic' => 'mechanic.index',
            'tailor' => 'tailor.index',
            'craftsperson' => 'craftsperson.index',
            'taxi_driver' => 'taxi_driver.index',
            'motorcycle_taxi' => 'motorcycle_taxi.index',
            'bus_driver' => 'bus_driver.index',
            'tour_driver' => 'tour_driver.index',
            'delivery_driver' => 'delivery_driver.index',
            'food_vendor' => 'food_vendor.index',
            'fashion_vendor' => 'fashion_vendor.index',
            'gym_trainer' => 'gym_trainer.index',
            'student' => 'student.index',
            'farmer' => 'farmer.index',
            'legal_pro' => 'legal_pro.index',
        ];

        if (isset($roleRoutes[$role]) && Route::has($roleRoutes[$role])) {
            return redirect()->route($roleRoutes[$role]);
        }

        // 4. Default for regular users or unknown roles
        return redirect()->route('marketplace.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Account/Service Selection Flow
    Route::get('/select-category', [AccountSelectionController::class, 'selectCategory'])->name('auth.select-category');
    Route::get('/select-user', [AccountSelectionController::class, 'selectUser'])->name('auth.select-user');
    Route::post('/enter-dashboard', [AccountSelectionController::class, 'enterDashboard'])->name('auth.enter-dashboard');

    Route::get('/switch-account/{role}', [SwitchAccountController::class, 'switchAccount'])->name('switch-account');
    Route::get('/admin/switch-account', [SwitchAccountController::class, 'showSwitchPage'])->name('admin.switch-account');
});

// Admin User Management
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
    Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');
    Route::post('/users/bulk-status', [UserController::class, 'bulkStatus'])->name('users.bulkStatus');
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
});

// Self Registration
Route::prefix('self-register')->group(function() {
    Route::get('/', [SelfRegisterController::class, 'index'])->name('self-register.index');
    Route::get('/access-link', [SelfRegisterController::class, 'accessLink'])->name('self-register.access-link');
});
