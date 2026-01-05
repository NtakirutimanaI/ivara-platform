<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'food_fashion_bookings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
