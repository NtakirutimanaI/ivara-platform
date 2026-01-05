<?php

namespace App\Modules\AgricultureEnvironment\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'agriculture_environment_reviews';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
