<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'number',
        'status',
        'subtotal',
        'discount_total',
        'tax_total',
        'grand_total',
        'amount_due',
        'due_date',
    ];

    // Invoice belongs to a client (optional)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Invoice has many invoice items
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // Invoice has many payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function invoices(): HasMany
{
    return $this->hasMany(Invoice::class, 'client_id');
}

}
