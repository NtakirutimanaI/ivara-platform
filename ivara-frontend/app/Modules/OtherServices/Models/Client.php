<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'other_services_clients';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
