<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
    'client_id', 'plan', 'method', 'payment_amount',
    'transaction_id', 'status', 'paid_at'
];


    protected $casts = [
        'meta' => 'array',
        'paid_at' => 'datetime',
    ];

    // Payment belongs to an invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // Payment belongs to a client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
