<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'transport_travel_services';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
