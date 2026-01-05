<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'creative_lifestyle_services';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
