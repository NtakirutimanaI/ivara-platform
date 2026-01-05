<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'other_services_providers';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
