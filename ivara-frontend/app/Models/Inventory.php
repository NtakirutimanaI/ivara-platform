<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Specify table name since Laravel's convention would expect 'inventories'
    protected $table = 'inventory';

    // Fillable fields for mass assignment
    protected $fillable = [
        'product_name',
        'stock_level',
        'status',
    ];
}
