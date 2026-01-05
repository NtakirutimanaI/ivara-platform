<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'food_fashion_reviews';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
