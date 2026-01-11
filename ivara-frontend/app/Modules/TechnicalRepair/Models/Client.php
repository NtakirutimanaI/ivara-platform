<?php

namespace App\Modules\TechnicalRepair\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    protected $table = 'technical_repair_clients';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
