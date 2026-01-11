<?php

namespace App\Modules\TechnicalRepair\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'technical_repair_payments';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
