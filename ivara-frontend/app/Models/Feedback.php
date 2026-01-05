<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks'; 

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_type',
        'module',
        'urgency',
        'category',
        'message',
        'name',
        'email',
        'attachment',
    ];
}
