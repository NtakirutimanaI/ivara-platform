<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'food_fashion_providers';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
