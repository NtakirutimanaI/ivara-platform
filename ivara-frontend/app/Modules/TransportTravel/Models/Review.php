<?php

namespace App\Modules\TransportTravel\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'transport_travel_reviews';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
