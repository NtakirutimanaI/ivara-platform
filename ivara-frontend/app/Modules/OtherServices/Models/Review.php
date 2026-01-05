<?php

namespace App\Modules\OtherServices\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'other_services_reviews';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
