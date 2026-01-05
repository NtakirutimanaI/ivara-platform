<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'food_fashion_payments';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
