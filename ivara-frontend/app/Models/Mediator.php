<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediator extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'location',
        'user_id',
        'mediator_id',
        'total_clients',
        'total_transactions',
        'level',
        'approved_by_admin',
        'status',
    ];

    /**
     * Each mediator belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A mediator can have many transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
        public function clients()
    {
        return $this->belongsToMany(Client::class, 'mediators', 'mediator_id', 'client_id')
                    ->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

     public function commissions()
    {
        return $this->hasMany(MediatorCommission::class);
    }
}
