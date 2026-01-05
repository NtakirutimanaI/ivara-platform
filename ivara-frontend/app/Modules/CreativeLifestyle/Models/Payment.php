<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'creative_lifestyle_payments';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
