<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'other_services_payments';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
