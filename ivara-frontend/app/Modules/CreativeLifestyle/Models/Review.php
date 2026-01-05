<?php

namespace App\Modules\CreativeLifestyle\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'creative_lifestyle_reviews';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
