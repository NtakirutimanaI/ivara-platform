<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'other_services_reports';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
