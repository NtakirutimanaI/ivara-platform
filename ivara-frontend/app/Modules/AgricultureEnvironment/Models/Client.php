<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'agriculture_environment_clients';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
