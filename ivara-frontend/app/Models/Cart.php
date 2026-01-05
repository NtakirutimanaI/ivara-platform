<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts'; // optional if your table name is 'carts'

    // Fillable fields
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductService::class, 'product_id');
    }
}
