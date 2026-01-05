<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'creative_lifestyle_bookings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
