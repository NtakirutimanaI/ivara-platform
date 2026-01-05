<?php

namespace App\Models;
use App\Models\Service;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'mediator_id',
        'name',
        'phone',
        'email',
        'address',
        'city',
        'country',
        'national_id',
        'gender',
        'date_of_birth',
        'notes',
    ];

    // ===== Relationships =====

    /**
     * Repairs associated with the client
     */
    public function repairs()
    {
        // Assuming 'device_owner' column in repairs table references client name
        return $this->hasMany(Repair::class, 'device_owner', 'name');
    }

    /**
     * Bookings made by the client (one-to-many)
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Payments made by the client (one-to-many)
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Notifications for the client (one-to-many)
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Products purchased by the client (many-to-many)
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    /**
     * Orders made by the client (one-to-many)
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * The user who manages or created this client (optional)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Devices owned by the client
     */
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
    public function mediator()
     {
    return $this->belongsTo(Mediator::class);
     }

   

    public function services()
    {
    return $this->belongsToMany(Service::class, 'client_services')
                ->withPivot('status', 'notes', 'assigned_at', 'completed_at')
                ->withTimestamps();
    }

    public function commissions()
    {
        return $this->hasMany(MediatorCommission::class);
    }
}
