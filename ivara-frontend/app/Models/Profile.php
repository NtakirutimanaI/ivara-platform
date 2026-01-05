<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'profile_photo',
        'subscription_plan',
        'next_billing_date',
    ];

    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'next_billing_date' => 'datetime',
    ];

    /**
     * Optional: Define relation to user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
