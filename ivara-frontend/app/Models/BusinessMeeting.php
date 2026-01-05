<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessMeeting extends Model
{
    use HasFactory;

    // Explicit table name (if not following Laravel plural naming convention)
    protected $table = 'meetings';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'time',
        'link',
        'description',
        'status',
        'roles',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'time' => 'datetime:H:i',  // formats time
        'roles' => 'array',        // roles stored as JSON or serialized
    ];
}
