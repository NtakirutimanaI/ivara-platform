<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    public $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'username',
        'country_code',
        'phone',
        'email',
        'location',
        'password',
        'role',
        'category', // Added for sync
        'status',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get all enrollments for the user.
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get all bookings for the user (as client).
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'client_id');
    }

    /**
     * Get all transactions for this client.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'client_id');
    }

    /**
     * Get the mediator profile for the user.
     */
    public function mediator(): HasOne
    {
        return $this->hasOne(Mediator::class);
    }

    /**
     * Get all devices owned by the client.
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class, 'client_id');
    }

    /**
     * Get all invoices for the user.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'user_id');
    }

    /**
     * Get all payment methods for the user.
     */
    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class, 'user_id');
    }

    /**
     * Get the subscription for the user.
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class, 'user_id');
    }

    // app/Models/User.php


// Get the last booking
public function last_booking()
{
    return $this->hasOne(Booking::class, 'client_id')->latestOfMany();
}

    // Messages sent by this user
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Messages received by this user
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    // App\Models\User.php



public function notifications()
{
    return $this->hasMany(Notification::class, 'client_id');
}
// Client has many products via pivot table
public function products()
{
    return $this->belongsToMany(Product::class, 'client_product')
                ->withPivot('quantity', 'price')
                ->withTimestamps();
}

// Client has many orders
public function orders()
{
    return $this->hasMany(Order::class, 'client_id');
}

// Client has many payments
public function payments()
{
    return $this->hasMany(Payment::class, 'client_id');
}


}
