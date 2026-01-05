<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * Fillable fields for mass assignment
     */
    protected $fillable = [
        'full_name',
        'id_number',
        'phone',
        'site',
        'preferred_date',
        'age',
        'consent',
        'status',       // Booking status (pending, confirmed, completed, canceled)
        'employee_id',  // Assigned employee (supervisor can assign)
        'client_id',    // Optional if linked to a client
        'service_id',   // Linked service
        'user_id',      // Optional for logged-in AJAX bookings
    ];

    /**
     * Relationship: Booking belongs to an employee (User)
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    /**
     * Relationship: Booking belongs to a client
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * Relationship: Booking belongs to a service
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Relationship: Booking belongs to a user (for AJAX bookings)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope for filtering bookings by status
     */
    public function scopeStatus($query, $status)
    {
        if ($status && $status !== 'all') {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Scope for filtering bookings by employee
     */
    public function scopeEmployee($query, $employeeId)
    {
        if ($employeeId) {
            return $query->where('employee_id', $employeeId);
        }
        return $query;
    }

    /**
     * Scope for filtering bookings by date range
     */
    public function scopeDateRange($query, $from = null, $to = null)
    {
        if ($from && $to) {
            return $query->whereBetween('preferred_date', [$from, $to]);
        }
        return $query;
    }
     public function technician()
    {
        return $this->belongsTo(Technician::class); // Add this
    }

     public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class);
    }
}
