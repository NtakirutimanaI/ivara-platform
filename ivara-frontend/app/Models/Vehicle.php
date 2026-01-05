<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles'; // optional, Laravel infers automatically

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'owner_name',
        'owner_phone',
        'owner_email',
        'registration_number',
        'vin',
        'chassis_number',
        'engine_number',
        'make',
        'model',
        'variant',
        'year',
        'color',
        'fuel_type',
        'transmission',
        'engine_capacity',
        'vehicle_type',
        'seating_capacity',
        'mileage',
        'registration_date',
        'insurance_expiry',
        'road_worthiness_expiry',
        'status',
    ];

    /**
     * Example relationships (optional, define if needed later)
     */
    // A vehicle may belong to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // A vehicle can have many services or repairs
    public function services()
    {
        return $this->hasMany(Service::class, 'vehicle_id');
    }
    public function repairs()
{
    return $this->hasMany(VehicleRepair::class);
}

}
