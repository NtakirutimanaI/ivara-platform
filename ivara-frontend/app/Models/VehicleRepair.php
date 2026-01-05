<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleRepair extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'technician',
        'problem_description',
        'solved_problems',
        'recommendations',
        'repair_status',
        'repair_price', // <-- added price
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function payment()
    {
        return $this->hasOne(\App\Models\Payment::class, 'invoice_id');
    }
}
