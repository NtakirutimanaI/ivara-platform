<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'available_time',
        'is_active',
        'category',
        'created_by',
    ];

    // Optional: define relationship to the user who created the service
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
      public function technician()
    {
        return $this->belongsTo(Technician::class, 'technician_id');
    }
    public function clients()
{
    return $this->belongsToMany(Client::class, 'client_services')
                ->withPivot('status', 'notes', 'assigned_at', 'completed_at')
                ->withTimestamps();
}

}
