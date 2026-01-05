<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'creative_lifestyle_reports';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
