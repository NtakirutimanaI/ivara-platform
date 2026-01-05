<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'transport_travel_vehicles';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
