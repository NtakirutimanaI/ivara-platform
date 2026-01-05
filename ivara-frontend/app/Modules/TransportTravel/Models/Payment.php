<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'transport_travel_payments';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
