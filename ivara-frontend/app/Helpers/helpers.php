<?php

use App\Models\Notification;

if (!function_exists('createNotification')) {
    function createNotification($type, $message, $recipientId, $relatedId = null, $relatedType = null) {
        return Notification::create([
            'type' => $type,
            'message' => $message,
            'user_id' => $recipientId,
            'related_id' => $relatedId,
            'related_type' => $relatedType,
            'is_read' => 0,
            'sent_at' => now(),
        ]);
    }
}
