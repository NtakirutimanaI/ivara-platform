<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CraftspersonProduct extends Model
{
    use HasFactory;

    // Table name (optional if following Laravel conventions)
    protected $table = 'craftsperson_products';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'craftsperson_id',
        'name',
        'category',
        'price',
        'quantity',
        'unit',
        'status',
        'image',
        'total_value',
    ];

    /**
     * Automatically cast price and total_value to float.
     */
    protected $casts = [
        'price' => 'float',
        'total_value' => 'float',
    ];
}
