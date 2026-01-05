<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MechanicProduct extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel convention)
    protected $table = 'mechanic_products';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'brand',
        'category',
        'type',
        'image',
        'mechanic_id',
        'is_published',
    ];

    // Casts
    protected $casts = [
        'price' => 'decimal:2',
        'is_published' => 'boolean',
    ];

    // Relationship to User (mechanic)
    public function mechanic()
    {
        return $this->belongsTo(User::class, 'mechanic_id');
    }
}
