<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'other_services_settings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
