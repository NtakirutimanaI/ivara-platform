<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'agriculture_environment_services';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
