<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'agriculture_environment_payments';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
