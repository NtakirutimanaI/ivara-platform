<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'team';

    protected $fillable = [
        'full_name',
        'position',
        'contact',
        'email',
        'image',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'status', // use 'status' instead of 'published'
    ];

    // Cast status to string
    protected $casts = [
        'status' => 'string',
    ];

    // Accessor to allow $member->published in Blade
    public function getPublishedAttribute()
    {
        return $this->status === 'published';
    }
}
