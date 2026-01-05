<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'time',
        'link',
        'description',
        'status',
        'roles',
        'client_id', // added for the client relationship
    ];

    // Automatically cast 'roles' to array when retrieved
    protected $casts = [
        'roles' => 'array', // store selected roles as JSON
    ];

    /**
     * Relationship to User (client)
     * Each meeting belongs to one client (user)
     */
  
    // In Meeting.php model
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

}
