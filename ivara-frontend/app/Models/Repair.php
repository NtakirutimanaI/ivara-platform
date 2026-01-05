<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
    'device_type',
    'device_name',
    'serial_number',
    'brand',
    'model',
    'operating_system',
    'device_owner',
    'contact_number',
    'received_date',
    'warranty_status',
    'problem_description',
    'technician',
    'estimated_cost',
    'repair_status',
    'solved_problems',
    'recommendations',
];


    // Relationships (optional if you have related models)
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
