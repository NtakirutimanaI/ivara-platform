<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'agriculture_environment_reports';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
