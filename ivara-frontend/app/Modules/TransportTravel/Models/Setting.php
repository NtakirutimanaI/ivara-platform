<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'transport_travel_settings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
