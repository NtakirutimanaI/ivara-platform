<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = 'education_knowledge_instructors';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
