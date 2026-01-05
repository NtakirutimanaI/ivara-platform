<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'other_services_bookings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
