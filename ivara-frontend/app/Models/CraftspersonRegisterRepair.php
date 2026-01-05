<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CraftspersonRegisterRepair extends Model
{
    use HasFactory;

    // Table name (optional if your table follows Laravel naming convention)
    protected $table = 'craftsperson_register_repair';

    // Mass assignable fields
    protected $fillable = [
        'craftsperson_name',
        'craft_type',
        'repair_item',
        'repair_description',
        'repair_date',
        'repair_cost',
        'status',
        'client_name',
        'client_contact',
    ];

    // Optional: if you want to handle dates as Carbon instances
    protected $dates = [
        'repair_date',
        'created_at',
        'updated_at',
    ];
}
