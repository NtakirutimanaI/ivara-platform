<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'creative_lifestyle_clients';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
