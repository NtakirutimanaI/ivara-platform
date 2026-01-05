<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductService extends Model
{
    use HasFactory;

    protected $table = 'products_services';

    protected $fillable = [
        'client_id',
        'type',
        'title',
        'description',
        'price',
        'status',
        'image',
    ];

    /**
     * Optional: Accessor to get full image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return null; // or placeholder URL
    }

    /**
     * Relationship: Product/Service belongs to a Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * Scope: Active products/services
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
    public function likes()
{
    return $this->hasMany(ProductLike::class, 'product_service_id');
}

public function isLikedByAuth()
{
    return $this->likes()->where('user_id', auth()->id())->exists();
}

}
