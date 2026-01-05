<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'transport_travel_providers';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
