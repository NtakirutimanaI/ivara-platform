<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'agriculture_environment_settings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
