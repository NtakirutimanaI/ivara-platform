<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',   // optional
        'status',  // optional
        'stock',   // optional
    ];

    // Product can appear in many invoice items
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // Product can appear in many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Product belongs to many clients (many-to-many)
    public function clients()
    {
        return $this->belongsToMany(Client::class)
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
