<?php
namespace App\Events;

use App\Models\Activity;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $activity;

    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }

    public function broadcastOn()
    {
        return new Channel('dashboard-activities');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->activity->id,
            'message' => $this->activity->message,
            'icon' => $this->activity->icon ?? 'fas fa-info-circle',
            'created_at' => $this->activity->created_at->diffForHumans(),
        ];
    }
}
