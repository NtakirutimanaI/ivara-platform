<?php

namespace App\Modules\TechnicalRepair\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'technical_repair_bookings';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
