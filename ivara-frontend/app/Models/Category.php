<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'status',
        'microservice_endpoint',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Get the admins assigned to this category.
     * Assuming a Pivot table exists or using a polymorphic relation.
     * For now, we stub this relationship.
     */
    public function admins()
    {
        // Example: return $this->belongsToMany(User::class, 'category_admins');
    }
}
