<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',       // e.g. credit_card, mobile_money
        'last_four',  // last 4 digits of card
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
