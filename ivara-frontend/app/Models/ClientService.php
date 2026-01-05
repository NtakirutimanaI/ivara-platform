<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientService extends Model
{
    use HasFactory;

    protected $table = 'client_services';

    protected $fillable = [
        'client_id',
        'service_id',
        'status',
        'notes',
        'assigned_at',
        'completed_at',
    ];

    /**
     * A client service belongs to a client.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * A client service is linked to one service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
