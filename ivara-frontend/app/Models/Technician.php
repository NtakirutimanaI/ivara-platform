<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'expertise', 'experience_years',
        'certifications', 'status', 'location', 'notes',
        'registered_on', 'received_by', 'position'
    ];

    // A technician can be assigned many devices
    public function devices()
    {
        return $this->hasMany(Device::class, 'assigned_technician_id');
    }
}
