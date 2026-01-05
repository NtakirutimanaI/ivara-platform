<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Core\Notification\NotificationController;
use App\Modules\Core\Notification\SmsController;

Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/mark-read/{id}', [NotificationController::class, 'markRead'])->name('notifications.markRead');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/notifications-sms', [NotificationController::class, 'notificationsSms'])->name('notifications_sms');
});
