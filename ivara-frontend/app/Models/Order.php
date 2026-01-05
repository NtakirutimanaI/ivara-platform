<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id', 'product_id', 'quantity',
        'payment_method', 'status', 'total', 'amount', 'total_amount'
    ];

    // Relationship to Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
