<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'creative_lifestyle_products';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
