<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'education_knowledge_courses';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
