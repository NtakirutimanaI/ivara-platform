<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'description',
        'qty',
        'unit_price',
        'line_total',
    ];

    // Each item belongs to an invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // Optional: item belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
