<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title', 'description', 'user_id', 'status', 'message', 'icon'
    ];
}
