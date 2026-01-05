<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterRepair extends Model
{
    protected $fillable = [
        'device_name',
        'device_model',
        'serial_number',
        'issue_description',
        'customer_name',
        'customer_contact',
        'customer_email',
        'date_received',
        'expected_completion_date',
        'diagnosis',
        'repair_actions',
        'repair_status',
        'repair_cost',
        'technician_id', // assuming you store technician_id in DB
        'client_id',     // assuming you store client_id
        'device_id',     // assuming you store device_id
        'warranty_status',
        'notes',
    ];

    protected $casts = [
        'date_received' => 'datetime',
        'expected_completion_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
