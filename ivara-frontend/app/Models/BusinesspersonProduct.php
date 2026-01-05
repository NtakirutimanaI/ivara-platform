<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinesspersonProduct extends Model
{
    // Table name (optional if following Laravel convention)
    protected $table = 'businessperson_products';

    // Primary key (optional if 'id')
    protected $primaryKey = 'id';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'category',
        'price',
        'quantity',
        'unit',
        'status',
        'image'
    ];

    // Disable incrementing if using non-standard primary key type
    // public $incrementing = true;

    // Data type of primary key (optional)
    protected $keyType = 'int';

    // Automatically cast total_value to decimal
    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'decimal:2',
        'total_value' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Optional: If you want total_value calculated in model (if DB doesn't support generated column)
    // public function getTotalValueAttribute()
    // {
    //     return $this->price * $this->quantity;
    // }
}
