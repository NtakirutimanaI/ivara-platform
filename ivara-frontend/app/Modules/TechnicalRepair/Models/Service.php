<?php

namespace App\Modules\TechnicalRepair\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
        'category',
        'image',
        'duration',
        'features'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get services by category
     */
    public static function byCategory($category)
    {
        return static::where('category', $category)->get();
    }

    /**
     * Get active services
     */
    public static function active()
    {
        return static::where('status', 'active')->get();
    }
}
