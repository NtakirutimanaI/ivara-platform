<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'agriculture_environment_products';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
