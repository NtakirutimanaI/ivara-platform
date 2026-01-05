<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'creative_lifestyle_settings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
