<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'food_fashion_services';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
