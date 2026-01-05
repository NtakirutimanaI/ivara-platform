<?php

namespace App\Modules\FoodFashion\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'food_fashion_reports';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
