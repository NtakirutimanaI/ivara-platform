<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // or Technician model if you have one

class TechnicianProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock', 'image', 
        'brand', 'category', 'technician_id'
    ];

    // Add this relationship
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id'); 
        // or Technician::class if you have a separate Technician model
    }
}
