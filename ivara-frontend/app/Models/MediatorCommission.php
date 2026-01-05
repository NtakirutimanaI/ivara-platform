<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediatorCommission extends Model
{
    protected $fillable = [
        'mediator_id',
        'client_id',
        'activity_type',
        'amount',
        'commission_amount',
        'paid_at'
    ];

    public function mediator()
    {
        return $this->belongsTo(Mediator::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
