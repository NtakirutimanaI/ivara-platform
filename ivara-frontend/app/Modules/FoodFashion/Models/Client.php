<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'food_fashion_clients';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
