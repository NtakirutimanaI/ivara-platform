<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'transport_travel_clients';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
