<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'other_services_products';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
