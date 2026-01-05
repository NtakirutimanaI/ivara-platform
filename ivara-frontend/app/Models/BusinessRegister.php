<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessRegister extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'type',
        'name',
        'serial_number',
        'description',
        'category',
        'quantity',
        'location',
        'status',
    ];

    // Optional: relation to the business person
    public function business()
    {
        return $this->belongsTo(User::class, 'business_id');
    }
}
