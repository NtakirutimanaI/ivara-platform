<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'food_fashion_settings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
