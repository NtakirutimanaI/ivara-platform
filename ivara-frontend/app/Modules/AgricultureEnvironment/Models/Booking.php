<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'agriculture_environment_bookings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
