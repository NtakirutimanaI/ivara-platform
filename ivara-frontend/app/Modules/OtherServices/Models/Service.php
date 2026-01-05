<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'other_services_services';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
