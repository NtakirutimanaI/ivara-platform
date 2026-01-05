<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Device;

class DeviceRepair extends Model
{
    use HasFactory;

    protected $table = 'device_repairs';

    protected $fillable = [
        'device_id',
        'technician',
        'problem_description',
        'solved_problems',
        'recommendations',
        'estimated_cost',
        'repair_status',
    ];

    protected $attributes = [
        'technician' => '-',
        'solved_problems' => '-',
        'recommendations' => '-',
        'repair_status' => 'Pending',
    ];

    protected $casts = [
        'estimated_cost' => 'decimal:2',
    ];

    // Relationship: each repair belongs to one device
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('repair_status', 'Completed');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('repair_status', ['Pending', 'In Progress']);
    }
}
