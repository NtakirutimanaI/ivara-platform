<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Completion extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'lesson_id',
        'completed',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
