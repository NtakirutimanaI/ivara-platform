<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'devices';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'device_type',
        'device_name',
        'serial_number',
        'brand',
        'model',
        'operating_system',
        'device_owner',
        'contact_number',
        'received_date',
        'warranty_status',
        'problem_description',
        'solved_problems',
        'recommendations',
        'technician',
        'estimated_cost',
        'repair_status',
        'status',
        'type',
        'os',
        'imei_1',
        'imei_2',
        'imei_3_or_mac_or_plate',
        'purchase_date',
        'warranty_expiry',
        'location',
        'notes',
        'assigned_technician_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'received_date' => 'datetime',
        'purchase_date' => 'datetime',
        'warranty_expiry' => 'datetime',
        'estimated_cost' => 'decimal:2',
    ];

    /**
     * Relationships
     */

    // 🔹 Each device belongs to a client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // 🔹 Each device belongs to a user (the one who registered/owns it)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔹 Each device may be assigned to a technician (by user_id or technician_id)
    public function technician()
    {
        return $this->belongsTo(Technician::class, 'assigned_technician_id');
    }

    // 🔹 Alias relationship: assigned technician as a User
    public function assignedTechnician()
    {
        return $this->belongsTo(User::class, 'assigned_technician_id');
    }

    // 🔹 A device can have many repairs
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    /**
     * 🔹 Query Scopes
     */
    public function scopePending($query)
    {
        return $query->where('repair_status', 'Pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('repair_status', 'Completed');
    }

    public function scopeRepaired($query)
    {
        return $query->where('status', 'repaired');
    }

    /**
     * 🔹 Accessors (optional: example for full device name)
     */
    public function getFullNameAttribute()
    {
        return "{$this->brand} {$this->model}";
    }
}
