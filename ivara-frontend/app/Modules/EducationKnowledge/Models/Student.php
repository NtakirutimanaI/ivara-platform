<?php

namespace App\Modules\EducationKnowledge\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'education_knowledge_students';
    protected $fillable = ['name', 'description', 'price', 'status'];
}
