<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'mediator_id',
        'client_id',
        'amount',
        'activity_type',
        'commission_percentage',
        'commission_amount',
        'status',
    ];

    /**
     * Each transaction belongs to a mediator.
     */
    public function mediator()
    {
        return $this->belongsTo(Mediator::class);
    }

    /**
     * Each transaction belongs to a client (User or separate Client model).
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id'); 
        // 👉 if you have a separate Client model, change this accordingly
    }
}
