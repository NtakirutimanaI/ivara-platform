<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'transport_travel_reports';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
