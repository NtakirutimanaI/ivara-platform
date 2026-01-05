<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'agriculture_environment_providers';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
