<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    use HasFactory;

    protected $table = 'updates';

    protected $fillable = [
        'event_name',
        'date',
        'location',
        'image',
        'description',
    ];
}
