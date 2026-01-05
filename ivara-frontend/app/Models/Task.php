<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',       // assigned user for Blade page
        'agent_id',      // optional agent relation
        'employee_id',   // optional employee relation
        'due_date',
        'focus_time',
        'completed_at',
    ];

    // Relationship to the assigned user (used in Blade as $task->user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Optional: agent relationship
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    // Optional: employee relationship
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
