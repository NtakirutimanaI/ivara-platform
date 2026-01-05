<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'food_fashion_products';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
