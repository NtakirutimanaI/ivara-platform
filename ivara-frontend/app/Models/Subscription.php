<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_id',
        'user_id',
        'email',
        'plan',
        'price',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'price'      => 'decimal:2',
    ];

    /**
     * Optional: Define relation to user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

       // Relationship to Plan
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }
      public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'subscription_id');
    }
    
}
