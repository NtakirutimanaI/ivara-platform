<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'transport_travel_bookings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
