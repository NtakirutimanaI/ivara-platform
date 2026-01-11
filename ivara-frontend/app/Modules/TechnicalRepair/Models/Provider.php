<?php

namespace App\Modules\TechnicalRepair\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'technical_repair_providers';


    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'category',
        'image',
        'location',
        'specialization'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
