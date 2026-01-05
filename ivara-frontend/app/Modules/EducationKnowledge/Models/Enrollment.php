<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'education_knowledge_enrollments';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
