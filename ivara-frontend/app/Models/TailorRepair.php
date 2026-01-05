<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TailorRepair extends Model
{
    use HasFactory;

    // Table name (optional if it follows Laravel convention)
    protected $table = 'tailor_repairs';

    // Fillable fields for mass assignment
    protected $fillable = [
        'customer_name',
        'customer_contact',
        'item_name',
        'item_model',
        'repair_details',
        'repair_status',
        'price',
        'date_received',
        'expected_completion_date',
        'date_completed',
    ];

    // Optional: Cast date fields to Carbon instances
    protected $dates = [
        'date_received',
        'expected_completion_date',
        'date_completed',
        'created_at',
        'updated_at',
    ];
}
