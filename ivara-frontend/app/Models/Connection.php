<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    // Make sure these match your database columns exactly
    protected $fillable = [
        'technician_id',
        'client_id',
        'service_id',
        'location',
        'status',          // Pending / Completed / Paid
        'payment_method',  // cash / mtn_momo / airtel_money / card / bank
    ];

    /**
     * Relationship: Connection belongs to a Technician
     */
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    /**
     * Relationship: Connection belongs to a Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relationship: Connection belongs to a Service
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
