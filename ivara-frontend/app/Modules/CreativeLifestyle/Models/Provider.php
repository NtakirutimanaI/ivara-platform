<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'creative_lifestyle_providers';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
