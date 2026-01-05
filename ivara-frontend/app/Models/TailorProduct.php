<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TailorProduct extends Model
{
    use HasFactory;

    protected $table = 'tailor_products';

    protected $fillable = [
        'tailor_id',
        'name',
        'category',
        'price',
        'quantity',
        'unit',
        'status',
        'image'
    ];
}
